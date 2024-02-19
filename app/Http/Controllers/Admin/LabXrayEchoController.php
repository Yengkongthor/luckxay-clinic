<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LabXrayEcho\BulkDestroyLabXrayEcho;
use App\Http\Requests\Admin\LabXrayEcho\DestroyLabXrayEcho;
use App\Http\Requests\Admin\LabXrayEcho\IndexLabXrayEcho;
use App\Http\Requests\Admin\LabXrayEcho\StoreLabXrayEcho;
use App\Http\Requests\Admin\LabXrayEcho\UpdateLabXrayEcho;
use App\Models\LabXrayEcho;
use App\Models\PrescribeMedicine;
use App\Models\PrescribeMedicineDetail;
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

class LabXrayEchoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexLabXrayEcho $request
     * @return array|Factory|View
     */
    public function index(Request $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PrescribeMedicineDetail::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [
                'prescribe_medicine_details.id',
                'amount',
                'name',
                'prescribe_medicine_id',
                'price',
                'medicine_id',
            ],

            // set columns to searchIn
            [
                'prescribe_medicine_details.id',
                'amount',
                'name',
                'prescribe_medicine_id',
                'price',
                'medicine_id', 'users.name', 'users.surname'
            ],
            static function (Builder $query) use ($request) {
                $query->orderByDesc('prescribe_medicine_details.created_at');
                $query->with('prescribeMedicine');

                $query->where('prescribe_medicine_details.status', 'lab_detail');

                if ($request->startDate && $request->endDate) {
                    $query->whereBetween('prescribe_medicine_details.created_at', [$request->startDate, $request->endDate . ' 23:59:59']);
                }

                $query->join('prescribe_medicines', 'prescribe_medicine_details.prescribe_medicine_id', '=', 'prescribe_medicines.id')
                    ->join('patient_histories', 'prescribe_medicines.patient_history_id', '=', 'patient_histories.id')
                    ->join('patients', 'patient_histories.patient_id', '=', 'patients.id')
                    ->join('users', 'patients.user_id', '=', 'users.id');
            }
        );

        $total = 0;

        if ($request->startDate && $request->endDate) {
            foreach (PrescribeMedicineDetail::where('status', 'lab_detail')->whereBetween('created_at', [$request->startDate, $request->endDate . ' 23:59:59'])->get() as $key => $value) {
                $total += $value->price;
            }
        } else {
            foreach (PrescribeMedicineDetail::where('status', 'lab_detail')->get() as $key => $value) {
                $total += $value->price;
            }
        }



        $data = collect($data);
        $data['data'] = [
            'PrescribeMedicineDetail' => $data['data'],
            'total' => $total,
        ];

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.lab-xray-echo.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.lab-xray-echo.create');

        return view('admin.lab-xray-echo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLabXrayEcho $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreLabXrayEcho $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the LabXrayEcho
        $labXrayEcho = LabXrayEcho::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/lab-xray-echos'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/lab-xray-echos');
    }

    /**
     * Display the specified resource.
     *
     * @param LabXrayEcho $labXrayEcho
     * @throws AuthorizationException
     * @return void
     */
    public function show(LabXrayEcho $labXrayEcho)
    {
        $this->authorize('admin.lab-xray-echo.show', $labXrayEcho);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LabXrayEcho $labXrayEcho
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(LabXrayEcho $labXrayEcho)
    {
        $this->authorize('admin.lab-xray-echo.edit', $labXrayEcho);


        return view('admin.lab-xray-echo.edit', [
            'labXrayEcho' => $labXrayEcho,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLabXrayEcho $request
     * @param LabXrayEcho $labXrayEcho
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateLabXrayEcho $request, LabXrayEcho $labXrayEcho)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values LabXrayEcho
        $labXrayEcho->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/lab-xray-echos'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/lab-xray-echos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyLabXrayEcho $request
     * @param LabXrayEcho $labXrayEcho
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyLabXrayEcho $request, LabXrayEcho $labXrayEcho)
    {
        $labXrayEcho->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyLabXrayEcho $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyLabXrayEcho $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    LabXrayEcho::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
