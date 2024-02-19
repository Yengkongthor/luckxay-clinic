<?php

namespace App\Http\Controllers\Admin;

use App\Events\AssignQueueToDoctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeStatus\IndexEmployeeStatus;
use App\Http\Requests\Admin\NotificationReception\IndexNotificationReception;
use App\Http\Requests\Admin\Queue\BulkDestroyQueue;
use App\Http\Requests\Admin\Queue\DestroyQueue;
use App\Http\Requests\Admin\Queue\IndexQueue;
use App\Http\Requests\Admin\Queue\StoreQueue;
use App\Http\Requests\Admin\Queue\UpdateQueue;
use App\Models\BookAnAppointment;
use App\Models\Employee;
use App\Models\EmployeeStatus;
use App\Models\NotificationReception;
use App\Models\Patient;
use App\Models\PatientHistory;
use App\Models\PrescribeMedicine;
use App\Models\PrescribeMedicineCharge;
use App\Models\Queue;
use App\Models\User;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;

class QueuesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexQueue $request
     * @return array|Factory|View
     */
    public function index(IndexQueue $request, IndexEmployeeStatus $requestEmployeeStatus, IndexNotificationReception $requestNotificationReception)
    {

        $dataEmployeeStatus = DB::table('employee_statuses')
            ->select(['employee_statuses.status', 'employee_statuses.examination_class', 'employees.position', 'employees.id', DB::raw('CONCAT(lao_first_name," ",lao_last_name) AS lao_full_name')])
            ->join('employees', 'employees.id', '=', 'employee_statuses.employee_id')
            ->where('assign', 1)
            ->where('status', true)
            ->where('employees.position', 'Doctor')
            ->get();


        // return $this->getEmployeeDoctor($requestEmployeeStatus);

        return view('admin.queue.index', [
            'patientQueue' => $this->getPatientQueue($request),
            'employeeDoctor' => $this->getEmployeeDoctor($requestEmployeeStatus),
            'dataEmployeeStatus' => $dataEmployeeStatus,
            'dataNotificationReception' => $this->indexNotificationReception($requestNotificationReception),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexNotificationReception $request
     * @return array|Factory|View
     */
    public function indexNotificationReception(IndexNotificationReception $request)
    {
        $request['per_page'] = 100;
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(NotificationReception::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['caller', 'class', 'id', 'patient'],

            // set columns to searchIn
            ['caller', 'class', 'id', 'patient']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return $data;
    }

    public function getPatientQueue(IndexQueue $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Queue::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_id', 'employee_id', 'comment', 'queue_number', 'important'],

            // set columns to searchIn
            ['id', 'queues_status', 'comment'],
            static function (Builder $query) {
                $query->where('queues_status', 'wait');

                $query->orderByDesc('important');
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return $data;
    }
    public function getEmployeeDoctor(IndexEmployeeStatus $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(EmployeeStatus::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'employee_id', 'assign', 'status',],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) {
                $query->where('status', 1);

                $query->with('employee');
            }
        );

        if ($request->ajax()) {
            return [
                'data' => $data,
            ];
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.queue.create');

        $users = User::all();
        $users->load('patient');


        return view('admin.queue.create', ['patients' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreQueue $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreQueue $request)
    {

        // Sanitize input
        $queue_number =  Queue::where('date', now()->format('Y-m-d'))->count();

        $sanitized = $request->getSanitized();
        $sanitized['patient_id'] = $request->patient;
        $sanitized['queue_number'] =  $queue_number + 1;
        $sanitized['date'] = now()->format('Y-m-d');


        $queue = Queue::where('patient_id', $request->patient)->where('queues_status', 'wait')->first();

        if (isset($queue)) {
            return response(['message' => 'already'], 403);
        }

        // Store the Queue
        $queue = Queue::create($sanitized);

        if ($request->book_id) {

            $appointment = BookAnAppointment::find($request->book_id);

            $appointment->status = 'success';

            $appointment->save();
        }




        if ($request->ajax()) {
            return ['redirect' => url('admin/queues'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/queues');
    }

    /**
     * Display the specified resource.
     *
     * @param Queue $queue
     * @throws AuthorizationException
     * @return void
     */
    public function show(Queue $queue)
    {
        $this->authorize('admin.queue.show', $queue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Queue $queue
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Queue $queue)
    {
        $this->authorize('admin.queue.edit', $queue);


        return view('admin.queue.edit', [
            'queue' => $queue,
            'patients' => Patient::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateQueue $request
     * @param Queue $queue
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateQueue $request, Queue $queue)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Queue
        $queue->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/queues'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/queues');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyQueue $request
     * @param Queue $queue
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyQueue $request, Queue $queue)
    {
        $paientHistory = PatientHistory::where('patient_historyable_id', $queue->id)->where('patient_historyable_type', Queue::class)->first();
        $prescribeMedicine = PrescribeMedicine::where('patient_history_id', $paientHistory->id);

        foreach ($prescribeMedicine->first()->prescribeMedicineDetail as $key => $value) {
            $value->delete();
        };

        $prescribeMedicineCharge = PrescribeMedicineCharge::where('prescribe_medicine_id')->first();

        if ($prescribeMedicineCharge) {
            $prescribeMedicineCharge->delete();
        }

        $prescribeMedicine->delete();

        $queue->delete();

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyQueue $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyQueue $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Queue::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function changeStatus(Request $request)
    {
        $queue =  Queue::find($request->queue_id);

        $queue->queues_status = 'examination_result';

        $queue->save();

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
