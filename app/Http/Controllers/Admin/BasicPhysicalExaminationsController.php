<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicPhysicalExamination\BulkDestroyBasicPhysicalExamination;
use App\Http\Requests\Admin\BasicPhysicalExamination\DestroyBasicPhysicalExamination;
use App\Http\Requests\Admin\BasicPhysicalExamination\IndexBasicPhysicalExamination;
use App\Http\Requests\Admin\BasicPhysicalExamination\StoreBasicPhysicalExamination;
use App\Http\Requests\Admin\BasicPhysicalExamination\UpdateBasicPhysicalExamination;
use App\Models\BasicPhysicalExamination;
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
use Log;

class BasicPhysicalExaminationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBasicPhysicalExamination $request
     * @return array|Factory|View
     */
    public function index(IndexBasicPhysicalExamination $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BasicPhysicalExamination::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_id', 'pressure', 'weight', 'temperature', 'ta', 'spo2', 'pr'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($request) {
                $query->where('patient_id', $request->patientId);
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

        return view('admin.basic-physical-examination.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.basic-physical-examination.create');

        return view('admin.basic-physical-examination.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBasicPhysicalExamination $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBasicPhysicalExamination $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the BasicPhysicalExamination
        $basicPhysicalExamination = BasicPhysicalExamination::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('/admin/users/' . $basicPhysicalExamination->patient->user_id . '/edit'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/basic-physical-examinations');
    }

    /**
     * Display the specified resource.
     *
     * @param BasicPhysicalExamination $basicPhysicalExamination
     * @throws AuthorizationException
     * @return void
     */
    public function show(BasicPhysicalExamination $basicPhysicalExamination)
    {
        $this->authorize('admin.basic-physical-examination.show', $basicPhysicalExamination);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BasicPhysicalExamination $basicPhysicalExamination
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(BasicPhysicalExamination $basicPhysicalExamination)
    {
        $this->authorize('admin.basic-physical-examination.edit', $basicPhysicalExamination);


        return view('admin.basic-physical-examination.edit', [
            'basicPhysicalExamination' => $basicPhysicalExamination,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBasicPhysicalExamination $request
     * @param BasicPhysicalExamination $basicPhysicalExamination
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBasicPhysicalExamination $request, BasicPhysicalExamination $basicPhysicalExamination)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();


        // Update changed values BasicPhysicalExamination
        $basicPhysicalExamination->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('/admin/users/' . $basicPhysicalExamination->patient->user_id . '/edit'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/basic-physical-examinations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBasicPhysicalExamination $request
     * @param BasicPhysicalExamination $basicPhysicalExamination
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBasicPhysicalExamination $request, BasicPhysicalExamination $basicPhysicalExamination)
    {
        $basicPhysicalExamination->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyBasicPhysicalExamination $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyBasicPhysicalExamination $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    BasicPhysicalExamination::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
