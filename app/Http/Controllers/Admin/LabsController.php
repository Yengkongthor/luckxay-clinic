<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Lab\BulkDestroyLab;
use App\Http\Requests\Admin\Lab\DestroyLab;
use App\Http\Requests\Admin\Lab\IndexLab;
use App\Http\Requests\Admin\Lab\StoreLab;
use App\Http\Requests\Admin\Lab\UpdateLab;
use App\Http\Requests\Admin\LabDetail\IndexLabDetail;
use App\Models\Employee;
use App\Models\Lab;
use App\Models\LabDetail;
use App\Models\Upload;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LabsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexLab $request
     * @return array|Factory|View
     */
    public function index(IndexLab $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Lab::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

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

        return view('admin.lab.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.lab.create');

        return view('admin.lab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLab $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreLab $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Lab
        $lab = Lab::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/labs/' . $lab->id . '/edit'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];

        }

        return redirect('admin/labs');
    }

    /**
     * Display the specified resource.
     *
     * @param Lab $lab
     * @throws AuthorizationException
     * @return void
     */
    public function show(Lab $lab)
    {
        $this->authorize('admin.lab.show', $lab);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lab $lab
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Lab $lab, IndexLabDetail $request)
    {
        $this->authorize('admin.lab.edit', $lab);


        return view('admin.lab.edit', [
            'lab' => $lab,
            'data' => $this->indexLabDetail($request, $lab->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLab $request
     * @param Lab $lab
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateLab $request, Lab $lab)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Lab
        $lab->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/labs'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/labs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyLab $request
     * @param Lab $lab
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyLab $request, Lab $lab)
    {

        $labDetails = LabDetail::whereLabId($lab->id)->first();

        if (isset($labDetails)) {
            return response(['message' => 'Lab ນີ້ຖືກນຳໃຊ້ໃນ LabDetail ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        }

        $employee = Employee::whereLabId($lab->id)->first();

        if (isset($employee)) {
            return response(['message' => 'Lab ນີ້ຖືກນຳໃຊ້ໃນ Employee ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        }

        $upload = Upload::whereLabId($lab->id)->first();

        if (isset($upload)) {
            return response(['message' => 'Lab ນີ້ຖືກນຳໃຊ້ໃນ Upload ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        }

        $lab->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyLab $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyLab $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Lab::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function indexLabDetail(IndexLabDetail $request, $labId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(LabDetail::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'lab_id', 'name', 'unit', 'reference', 'cost', 'price'],

            // set columns to searchIn
            ['id', 'name', 'unit', 'reference'],
            static function (Builder $query) use ($labId) {
                $query->with('lab');

                $query->where('lab_id', $labId);
            }
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }

        return $data;
    }
}
