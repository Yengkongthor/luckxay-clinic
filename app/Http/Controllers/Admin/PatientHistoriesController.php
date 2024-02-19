<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PatientHistory\BulkDestroyPatientHistory;
use App\Http\Requests\Admin\PatientHistory\DestroyPatientHistory;
use App\Http\Requests\Admin\PatientHistory\IndexPatientHistory;
use App\Http\Requests\Admin\PatientHistory\StorePatientHistory;
use App\Http\Requests\Admin\PatientHistory\UpdatePatientHistory;
use App\Models\Patient;
use App\Models\PatientHistory;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;

class PatientHistoriesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.patient-history.create');

        return view('admin.patient-history.create', [
            'patients' => Patient::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePatientHistory $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePatientHistory $request)
    {
        if ($request->patient_history_id) {
            $patientHistory =  PatientHistory::find($request->patient_history_id);
            $patientHistory->update($request->all());
        } else {
            // Sanitize input
            $sanitized = $request->getSanitized();

            // Store the PatientHistory
            $patientHistory = PatientHistory::create($sanitized);
        }



        if ($request->ajax()) {

            return [
                'redirect' => url('admin/patient-histories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                'patientHistory' => PatientHistory::where('patient_id', $request->patient_id)->orderByDesc('id')->get(),
            ];
        }

        return redirect('admin/patient-histories');
    }

    /**
     * Display the specified resource.
     *
     * @param PatientHistory $patientHistory
     * @throws AuthorizationException
     * @return void
     */
    public function show(PatientHistory $patientHistory)
    {
        $this->authorize('admin.patient-history.show', $patientHistory);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PatientHistory $patientHistory
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(PatientHistory $patientHistory)
    {
        $this->authorize('admin.patient-history.edit', $patientHistory);


        return view('admin.patient-history.edit', [
            'patientHistory' => $patientHistory,
            'patients' => Patient::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePatientHistory $request
     * @param PatientHistory $patientHistory
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePatientHistory $request, PatientHistory $patientHistory)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['patient_id'] = $request->getPatientId();

        // Update changed values PatientHistory
        $patientHistory->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/patient-histories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/patient-histories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPatientHistory $request
     * @param PatientHistory $patientHistory
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPatientHistory $request, PatientHistory $patientHistory)
    {
        $patientHistory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPatientHistory $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPatientHistory $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    PatientHistory::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function getPatientHistory($patientId)
    {
        $patientHistory = PatientHistory::where('patient_id', $patientId)->orderByDesc('id')->get();

        return ['patientHistory' => $patientHistory];
    }
}
