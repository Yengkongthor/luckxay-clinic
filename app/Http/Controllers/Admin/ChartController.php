<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrescribeMedicine;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {

        // $data = [
        //     [
        //         "label" => "Apple",
        //         "value" => "810000",
        //     ],
        //     [
        //         "label" => "Apple",
        //         "value" => "810000",
        //     ],
        // ];

        $data = [];
        $patientStatisticData = [];

        $prescribeMedicine = PrescribeMedicine::select('date', DB::raw('sum(price_total) as total'))->groupBy('date')->orderByDesc('date')->limit(10)->get();
        $patientStatistics = PrescribeMedicine::select('date', DB::raw('count(*) as total'))->groupBy('date')->orderByDesc('date')->limit(10)->get();

        foreach ($prescribeMedicine as $key => $value) {
            $data[] = [
                "label" => $value->date,
                "value" => $value->total,
            ];
        }
        foreach ($patientStatistics as $key => $value) {
            $patientStatisticData[] = [
                "label" => $value->date,
                "value" => $value->total,
            ];
        }


        $response = [
            'dataSourceSummary' => $data,
            'patientStatistics' => $patientStatisticData,
        ];


        return $response;
    }
}
