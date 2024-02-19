<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Summary\BulkDestroySummary;
use App\Http\Requests\Admin\Summary\DestroySummary;
use App\Http\Requests\Admin\Summary\IndexSummary;
use App\Http\Requests\Admin\Summary\StoreSummary;
use App\Http\Requests\Admin\Summary\UpdateSummary;
use App\Models\PrescribeMedicine;
use App\Models\Summary;
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

class SummariesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexSummary $request
     * @return array|Factory|View
     */
    public function index(Request $request)
    {
        // $request['per_page'] = 1000;
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PrescribeMedicine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_history_id', 'price_total', 'date', 'money', 'total_lab_detail', 'total_medicine', 'employee_queue'],

            // set columns to searchIn
            ['patient_history_id', 'price_total', 'date','users.name', 'users.surname','employee_queue'],
            static function (Builder $query) use ($request) {
                if ($request->startDate && $request->endDate) {
                    $query->whereBetween('date', [$request->startDate, $request->endDate]);
                }
                $query->orderByDesc('date');

                $query->join('patient_histories', 'prescribe_medicines.patient_history_id', '=', 'patient_histories.id')
                    ->join('patients', 'patient_histories.patient_id', '=', 'patients.id')
                    ->join('users', 'patients.user_id', '=', 'users.id');
                // $query->whereBetween('date', ['2020-10-01', '2020-10-03']);
            }

        );
        $total = [];
        $includeTheActualAmount = 0;
        $totalAfterPercentage = 0;
        $totalAnalysisValue = 0;
        $totalService = 0;
        $totalMedicines  = 0;

        if ($request->startDate && $request->endDate) {
            $prescribeMedicine = PrescribeMedicine::whereBetween('date', [$request->startDate, $request->endDate])->get();
            foreach ($prescribeMedicine as $key => $item) {
                $totalAnalysisValue += $item->total_lab_detail;
                $totalMedicines += $item->total_medicine - ((($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->medicine_discount : 0)/100)*$item->total_medicine);
                $totalService += ($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->charge : 0) - (($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->charge : 0) * ($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->discounted_services : 0)/100);
                $totalAfterPercentage += $item->price_total;
                $includeTheActualAmount += $item->price_total - ((($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->discount_total_money : 0) / 100) * $item->price_total);
            }
        } else {
            $prescribeMedicine = PrescribeMedicine::get();
            foreach ($prescribeMedicine as $key => $item) {
                $totalAnalysisValue += $item->total_lab_detail;
                $totalMedicines += $item->total_medicine - ((($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->medicine_discount : 0)/100)*$item->total_medicine);
                $totalService += ($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->charge : 0) - (($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->charge : 0) * ($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->discounted_services : 0)/100);
                $totalAfterPercentage += $item->price_total;
                $includeTheActualAmount += $item->price_total - ((($item->prescribeMedicineCharge ? $item->prescribeMedicineCharge->discount_total_money : 0) / 100) * $item->price_total);
            }
        }


        $data = collect($data);
        $data['data'] = [
            'summaries' => $data['data'],
            'includeTheActualAmount' => number_format($includeTheActualAmount),
            'totalAfterPercentage' => number_format($totalAfterPercentage),
            'totalAnalysisValue' => number_format($totalAnalysisValue),
            'totalService' => number_format($totalService),
            'totalMedicines' => number_format($totalMedicines),
        ];

        // return $data;

        if ($request->ajax()) {
            return ['data' => $data];
        }
        // return $data;
        return view('admin.summary.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.summary.create');

        return view('admin.summary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSummary $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSummary $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Summary
        $summary = Summary::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/summaries'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/summaries');
    }

    /**
     * Display the specified resource.
     *
     * @param Summary $summary
     * @throws AuthorizationException
     * @return void
     */
    public function show(Summary $summary)
    {
        $this->authorize('admin.summary.show', $summary);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Summary $summary
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Summary $summary)
    {
        $this->authorize('admin.summary.edit', $summary);


        return view('admin.summary.edit', [
            'summary' => $summary,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSummary $request
     * @param Summary $summary
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSummary $request, Summary $summary)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Summary
        $summary->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/summaries'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/summaries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroySummary $request
     * @param Summary $summary
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySummary $request, Summary $summary)
    {
        $summary->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroySummary $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySummary $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Summary::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
    public function print(Request $request)
    {
        $prescribeMedicine = PrescribeMedicine::whereBetween('date', [$request->startDate, $request->endDate])->get();
        return view('admin.reports.summaries.index', ['prescribeMedicine' => $prescribeMedicine]);
    }
}
