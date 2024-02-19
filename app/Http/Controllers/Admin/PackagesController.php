<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Package\BulkDestroyPackage;
use App\Http\Requests\Admin\Package\DestroyPackage;
use App\Http\Requests\Admin\Package\IndexPackage;
use App\Http\Requests\Admin\Package\PackageExamination;
use App\Http\Requests\Admin\Package\StorePackage;
use App\Http\Requests\Admin\Package\UpdatePackage;
use App\Models\ExaminationService;
use App\Models\ExamPackage;
use App\Models\Lab;
use App\Models\Package;
use App\Models\PatientHistory;
use App\Models\PrescribeMedicine;
use App\Models\PrescribeMedicineDetail;
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

class PackagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPackage $request
     * @return array|Factory|View
     */
    public function index(IndexPackage $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Package::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'price'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.package.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.package.create');

        $labs = Lab::with('labDetails')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'labDetails' => $item->labDetails->map(function ($value) use ($item) {
                    return [
                        'lab_detail_id' => $value->id,
                        'name' => $value->name,
                        'lab_id' => $item->id,
                    ];
                }),
            ];
        });

        return view('admin.package.create', ['labs' => $labs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePackage $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePackage $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Package
        $package = Package::create($sanitized);

        $package->packageDetails()->sync($request->lab_detail);

        if ($request->ajax()) {
            return ['redirect' => url('admin/packages'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/packages');
    }

    /**
     * Display the specified resource.
     *
     * @param Package $package
     * @throws AuthorizationException
     * @return void
     */
    public function show(Package $package)
    {
        $this->authorize('admin.package.show', $package);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Package $package
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Package $package)
    {
        $this->authorize('admin.package.edit', $package);

        $data = [
            'id' => $package->load('packageDetails')->id,
            'name' => $package->load('packageDetails')->name,
            'price' => $package->load('packageDetails')->price,
            'created_at' => $package->load('packageDetails')->created_at,
            'updated_at' => $package->load('packageDetails')->updated_at,
            'resource_url' => $package->load('packageDetails')->resource_url,
            'lab_detail' => $package->load('packageDetails')->packageDetails->map(function ($item) {
                // return $item->id;
                return [
                    'lab_detail_id' => $item->id,
                    'lab_id' => $item->pivot->lab_id,
                ];
            })
        ];

        $labs = Lab::with('labDetails')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'labDetails' => $item->labDetails->map(function ($value) use ($item) {
                    return [
                        'lab_detail_id' => $value->id,
                        'name' => $value->name,
                        'lab_id' => $item->id,
                    ];
                }),
            ];
        });

        return view('admin.package.edit', [
            'package' => $data,
            'labs' => $labs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePackage $request
     * @param Package $package
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePackage $request, Package $package)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Package
        $package->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/packages'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/packages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPackage $request
     * @param Package $package
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPackage $request, Package $package)
    {
        $examPackage = ExamPackage::where('package_id',$package->id)->first();

        if (isset($examPackage)) {
            return response(['message' => 'Package ນີ້ຖືກນຳໃຊ້ໃນ examPackage ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        }

        $package->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPackage $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPackage $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Package::whereIn('id', $bulkChunk)->delete();


                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function packageExamination(PackageExamination $request)
    {
        $sanitized = $request->getSanitized();

        $examPackage = ExamPackage::create($sanitized);

        $data = [
            'patient_id' => $request->patient_id,
            'patient_historyable_id' => $examPackage->id,
            'patient_historyable_type' => 'App\Models\ExamPackage',
            'test_at' => now()->toDateString(),
        ];

        $package = Package::find($request->package_id);


        $patientHistory =  PatientHistory::create($data);

        $prescribeMedicines = new PrescribeMedicine();
        $prescribeMedicines->patient_history_id = $patientHistory->id;
        $prescribeMedicines->price_total = $package->price;
        $prescribeMedicines->employee_queue = '';
        $prescribeMedicines->date = now();
        $prescribeMedicines->save();

        $prescribeMedicinesDetails = new PrescribeMedicineDetail();
        $prescribeMedicinesDetails->name = $package->name;
        $prescribeMedicinesDetails->amount = 1;
        $prescribeMedicinesDetails->status = 'package';
        $prescribeMedicinesDetails->prescribe_medicine_id = $prescribeMedicines->id;
        $prescribeMedicinesDetails->price = $package->price;
        $prescribeMedicinesDetails->save();


        foreach ($package->packageDetails as $key => $value) {

            $examination_services = new ExaminationService();
            $examination_services->patient_history_id = $patientHistory->id;
            $examination_services->lab_id = $value->lab_id;
            $examination_services->lab_detail_id = $value->pivot->lab_detail_id;
            $examination_services->service_id = 0;


            $examination_services->save();
        }

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
