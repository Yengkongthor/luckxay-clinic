<?php

namespace App\Http\Controllers\Admin;

use App\Events\AssignQueueToDoctor;
use App\Events\DoctorOnline;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeStatus\BulkDestroyEmployeeStatus;
use App\Http\Requests\Admin\EmployeeStatus\DestroyEmployeeStatus;
use App\Http\Requests\Admin\EmployeeStatus\IndexEmployeeStatus;
use App\Http\Requests\Admin\EmployeeStatus\StoreEmployeeStatus;
use App\Http\Requests\Admin\EmployeeStatus\UpdateEmployeeStatus;
use App\Models\CallQueue;
use App\Models\EmployeeStatus;
use App\Models\Queue;
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

class EmployeeStatusesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEmployeeStatus $request
     * @return array|Factory|View
     */
    public function index(IndexEmployeeStatus $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(EmployeeStatus::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'employee_id', 'status', 'assign'],

            // set columns to searchIn
            ['id']

        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.employee-status.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.employee-status.create');

        return view('admin.employee-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeStatus $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreEmployeeStatus $request)
    {

        $queue = Queue::find($request->queue_id);
        $data = [];
        $data['employee_id'] = $request->employee_id;
        $data['queues_status'] = 'processing';

        $employeeStatus = EmployeeStatus::whereEmployeeId($request->employee_id)->first();


        $queue->update($data);

        $employeeStatus->update($request->all());

        $callQueueData = [];
        $callQueueData['queue_id'] = $request->queue_id;
        $callQueueData['start_at'] = now();

        $callQueue = CallQueue::create($callQueueData);

        event(new AssignQueueToDoctor($request->employee_id));


        // Store the EmployeeStatus
        // $employeeStatus = EmployeeStatus::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/employee-statuses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/employee-statuses');
    }

    /**
     * Display the specified resource.
     *
     * @param EmployeeStatus $employeeStatus
     * @throws AuthorizationException
     * @return void
     */
    public function show(EmployeeStatus $employeeStatus)
    {
        $this->authorize('admin.employee-status.show', $employeeStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EmployeeStatus $employeeStatus
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(EmployeeStatus $employeeStatus)
    {
        $this->authorize('admin.employee-status.edit', $employeeStatus);


        return view('admin.employee-status.edit', [
            'employeeStatus' => $employeeStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeStatus $request
     * @param EmployeeStatus $employeeStatus
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateEmployeeStatus $request, EmployeeStatus $employeeStatus)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values EmployeeStatus
        $employeeStatus->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/employee-statuses'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/employee-statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEmployeeStatus $request
     * @param EmployeeStatus $employeeStatus
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyEmployeeStatus $request, EmployeeStatus $employeeStatus)
    {
        $employeeStatus->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyEmployeeStatus $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyEmployeeStatus $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    EmployeeStatus::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function assign(Request $request)
    {
        $employeeStatus = EmployeeStatus::whereEmployeeId($request->employee_id)->first();

        if (isset($employeeStatus)) {
            if ($employeeStatus->assign == 0) {
                $employeeStatus->assign = 1;
                $employeeStatus->save();
                event(new DoctorOnline('this is the value'));
            } else {
                $employeeStatus->assign = 0;
                $employeeStatus->save();
                event(new DoctorOnline('this is the value'));
            }
        }
    }
}
