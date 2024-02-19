<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PatientStatistic\BulkDestroyPatientStatistic;
use App\Http\Requests\Admin\PatientStatistic\DestroyPatientStatistic;
use App\Http\Requests\Admin\PatientStatistic\IndexPatientStatistic;
use App\Http\Requests\Admin\PatientStatistic\StorePatientStatistic;
use App\Http\Requests\Admin\PatientStatistic\UpdatePatientStatistic;
use App\Models\PatientStatistic;
use App\Models\PrescribeMedicine;
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

class PatientStatisticsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPatientStatistic $request
     * @return array|Factory|View
     */
    public function index(Request $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PrescribeMedicine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [
                'prescribe_medicines.id',  'patient_history_id', 'date', 'employee_queue'
            ],

            // set columns to searchIn
            [
                'prescribe_medicines.id',  'patient_history_id', 'date', 'users.name', 'users.surname', 'employee_queue', 'patients.village', 'patients.district', 'patients.province', 'patients.patient_code'
            ],
            static function (Builder $query) use ($request) {
                $query->orderByDesc('date');
                $query->join('patient_histories', 'prescribe_medicines.patient_history_id', '=', 'patient_histories.id')
                    ->join('patients', 'patient_histories.patient_id', '=', 'patients.id')
                    ->join('users', 'patients.user_id', '=', 'users.id');

                if ($request->startDate && $request->endDate) {
                    $query->whereBetween('date', [$request->startDate, $request->endDate]);
                }
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.patient-statistic.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.patient-statistic.create');

        return view('admin.patient-statistic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePatientStatistic $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePatientStatistic $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the PatientStatistic
        $patientStatistic = PatientStatistic::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/patient-statistics'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/patient-statistics');
    }

    /**
     * Display the specified resource.
     *
     * @param PatientStatistic $patientStatistic
     * @throws AuthorizationException
     * @return void
     */
    public function show(PatientStatistic $patientStatistic)
    {
        $this->authorize('admin.patient-statistic.show', $patientStatistic);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PatientStatistic $patientStatistic
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(PatientStatistic $patientStatistic)
    {
        $this->authorize('admin.patient-statistic.edit', $patientStatistic);


        return view('admin.patient-statistic.edit', [
            'patientStatistic' => $patientStatistic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePatientStatistic $request
     * @param PatientStatistic $patientStatistic
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePatientStatistic $request, PatientStatistic $patientStatistic)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values PatientStatistic
        $patientStatistic->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/patient-statistics'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/patient-statistics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPatientStatistic $request
     * @param PatientStatistic $patientStatistic
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPatientStatistic $request, PatientStatistic $patientStatistic)
    {
        $patientStatistic->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPatientStatistic $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPatientStatistic $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    PatientStatistic::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
