<?php

namespace App\Http\Controllers\Admin;

use App\Events\CallPatient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CallPateint\BulkDestroyCallPateint;
use App\Http\Requests\Admin\CallPateint\DestroyCallPateint;
use App\Http\Requests\Admin\CallPateint\IndexCallPateint;
use App\Http\Requests\Admin\CallPateint\StoreCallPateint;
use App\Http\Requests\Admin\CallPateint\UpdateCallPateint;
use App\Models\CallPateint;
use App\Models\EmployeeStatus;
use App\Models\Lab;
use App\Models\NotificationReception;
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

class CallPateintController extends Controller
{
    public function index($patient, $type)
    {


        if ($type == 'examination') {

            $employeeStatus =  EmployeeStatus::whereEmployeeId(auth()->user()->employee->id)->first();

            $notificationReception  = new  NotificationReception();

            $notificationReception->caller = auth()->user()->employee->lao_first_name;
            $notificationReception->class = 'ຫ້ອງ' . $employeeStatus->examination_class;
            $notificationReception->patient = $patient;

            $notificationReception->save();
        }


        if ($type == 'examination_result') {
            $notificationReception  = new  NotificationReception();

            $notificationReception->caller = auth()->user()->employee->lao_first_name;
            $notificationReception->class = 'ຫ້ອງ Examination Result';
            $notificationReception->patient = $patient;
            $notificationReception->save();
        }

        if ($type == 'lab') {

            $notificationReception  = new  NotificationReception();


            $notificationReception->caller = auth()->user()->employee->lao_first_name;
            // TODO: ຕອນນີ້ແມ່ນ User ສາມາດຢູ່ໄດ້ຫລາຍ lab
            $notificationReception->class = '';
            $notificationReception->patient = $patient;

            $notificationReception->save();
        }


        event(new CallPatient('reception', $patient));
    }
}
