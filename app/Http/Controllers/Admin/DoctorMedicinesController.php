<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorMedicine\BulkDestroyDoctorMedicine;
use App\Http\Requests\Admin\DoctorMedicine\DestroyDoctorMedicine;
use App\Http\Requests\Admin\DoctorMedicine\IndexDoctorMedicine;
use App\Http\Requests\Admin\DoctorMedicine\StoreDoctorMedicine;
use App\Http\Requests\Admin\DoctorMedicine\UpdateDoctorMedicine;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use App\Models\DoctorMedicine;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;

class DoctorMedicinesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDoctorMedicine $request
     * @return array|Factory|View
     */
    public function index(IndexDoctorMedicine $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(DoctorMedicine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['amount', 'cheminal_name', 'id', 'patient_history_id'],

            // set columns to searchIn
            ['cheminal_name', 'id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.doctor-medicine.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.doctor-medicine.create');

        return view('admin.doctor-medicine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDoctorMedicine $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDoctorMedicine $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the DoctorMedicine
        $doctorMedicine = DoctorMedicine::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/doctor-medicines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/doctor-medicines');
    }

    /**
     * Display the specified resource.
     *
     * @param DoctorMedicine $doctorMedicine
     * @throws AuthorizationException
     * @return void
     */
    public function show(DoctorMedicine $doctorMedicine)
    {
        $this->authorize('admin.doctor-medicine.show', $doctorMedicine);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DoctorMedicine $doctorMedicine
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(DoctorMedicine $doctorMedicine)
    {
        $this->authorize('admin.doctor-medicine.edit', $doctorMedicine);


        return view('admin.doctor-medicine.edit', [
            'doctorMedicine' => $doctorMedicine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDoctorMedicine $request
     * @param DoctorMedicine $doctorMedicine
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDoctorMedicine $request, DoctorMedicine $doctorMedicine)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values DoctorMedicine
        $doctorMedicine->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/doctor-medicines'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/doctor-medicines');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDoctorMedicine $request
     * @param DoctorMedicine $doctorMedicine
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyDoctorMedicine $request, DoctorMedicine $doctorMedicine)
    {
        $doctorMedicine->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDoctorMedicine $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyDoctorMedicine $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    DoctorMedicine::whereIn('id', $bulkChunk)->delete();


                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
