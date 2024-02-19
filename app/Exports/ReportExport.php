<?php

namespace App\Exports;

use Carbon\Carbon;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Controllers\Controller;
use App\Models\ExaminationService;
use App\Models\Medicine;
use App\Models\MedicinePricing;
use App\Models\Patient;
use App\Models\PrescribeMedicine;
use App\Models\Queue;
use Excel;
use Illuminate\Http\Request;
use Log;


class ReportExport implements FromView
{

    public $fromDate;
    public $toDate;
    public $status;

    public function __construct($fromDate, $toDate, $status)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->status = $status;
    }

    public function view(): View
    {
        $provinceVientiane = Patient::select('province', DB::raw('count(*) as total'))
            ->groupBy('province')->having('province', 'Vientiane Prefecture')
            ->get();
        $provinceEtc = Patient::select('province', DB::raw('count(*) as total'))
            ->groupBy('province')->having('province', '!=', 'Vientiane Prefecture')
            ->get();

        $provinceTotal = 0;
        foreach ($provinceEtc as $key => $value) {
            $provinceTotal += $value->total;
        }

        $provinceName = [
            'Vientiane Prefecture',
            'ອື່ນ'
        ];
        $provinceValue = [
            $provinceVientiane[0]->total,
            $provinceTotal
        ];
        $maleAge = [];
        $femaleAge = [];
        $maleTotal = [];
        $femaleTotal = [];
        $timeName = [];
        $timeValue = [];
        $total_lab_detail = 0;
        $service_name_key = [];
        $service_name_price = [];
        $total_medicine = 0;
        $vat = 0;
        $charge = 0;
        $date = [];
        $dateTotal = [];
        $patient =   Patient::select('gender', DB::raw('TIMESTAMPDIFF(YEAR,birth_date,CURDATE()) as gender_age'), DB::raw('count(*) as total'))
            ->groupBy('gender', 'gender_age')
            ->get();

        if ($this->fromDate && $this->toDate) {
            $examinationService = ExaminationService::whereBetween('created_at', [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59'])->get();
            $prescribeMedicines = PrescribeMedicine::whereBetween('date', [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59'])->get();
            $q = Queue::whereBetween('created_at', [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59'])->get()->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('H');
            });
        } else {
            $examinationService = ExaminationService::whereMonth('created_at', now()->format('m'))->get();
            $prescribeMedicines = PrescribeMedicine::whereMonth('date', now()->format('m'))->get();
            $q = Queue::whereMonth('created_at', now()->format('m'))->get()->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('H');
            });
        }


        foreach ($prescribeMedicines as $key => $value) {
            $total_medicine += $value->total_medicine;
            $vat += ($value->price_total * $value->prescribeMedicineCharge->vat) / 100;
            $charge += $value->prescribeMedicineCharge->charge;
        }

        foreach ($examinationService->groupBy('service_name') as $key => $value) {
            $service_name_key[] = $key;

            $service_name_price[] =  $value->sum('lab_detail_price');
        }

        foreach ($q as $key => $value) {
            $timeName[] = (string) $key . ' ໂມງ';
            $timeValue[] = $value->count();
        }

        foreach ($patient->where('gender', 'female') as $key => $value) {
            $femaleAge[] = $value->gender_age;
            $femaleTotal[] = $value->total;
        }
        foreach ($patient->where('gender', 'male') as $key => $value) {
            $maleAge[] = $value->gender_age;
            $maleTotal[] = $value->total;
        }

        array_push($service_name_key, 'ຄ່າຢາ');
        array_push($service_name_price, $total_medicine);
        array_push($service_name_key, 'ຄ່າບໍລິການ');
        array_push($service_name_price, $charge);
        array_push($service_name_key, 'ອມພ10%');
        array_push($service_name_price, $vat);

        $key = array_search('', $service_name_key);

        $service_name_key[$key] = 'Package';




        foreach ($prescribeMedicines->groupBy('date') as $key => $value) {
            $dateTotal[] = $value->sum('money');
            $date[] = $key;
        }


        return view('admin.exports.report', [
            'service_name_key' => $service_name_key,
            'service_name_price' => $service_name_price,
            'date' => $date,
            'dateTotal' => $dateTotal,
            'timeName' => $timeName,
            'timeValue' => $timeValue,
            'femaleAge' => $femaleAge,
            'femaleTotal' => $femaleTotal,
            'maleAge' => $maleAge,
            'maleTotal' => $maleTotal,
            'provinceName' => $provinceName,
            'provinceValue' => $provinceValue,
            'status' => $this->status,
        ]);
    }
}
