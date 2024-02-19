<?php

namespace App\Http\Controllers\Admin;

use App\Events\CallPatient;
use App\Events\Examination;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicPhysicalExamination\IndexBasicPhysicalExamination;
use App\Http\Requests\Admin\Comment\StoreComment;
use App\Http\Requests\Admin\DoctorMedicine\IndexDoctorMedicine;
use App\Http\Requests\Admin\Queue\IndexQueue;
use App\Http\Requests\InputAgainRequest;
use App\Models\BasicPhysicalExamination;
use App\Models\DoctorMedicine;
use App\Models\ExaminationService;
use App\Models\Medicine;
use App\Models\PatientHistory;
use App\Models\Queue;
use App\Models\Upload;
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

class ExaminationResultController extends Controller
{
    public function index(Request $request)
    {
        $queue = Queue::find($request->queue_id);

        $queue->queuePatientHistory->load('examinationServicesResult');
        $queue->patient->load('basicPhysicalExamination');

        $upload = Upload::wherePatientHistoryId($queue->patient_history_last->id)->get();

        $patientHistory = PatientHistory::wherePatientId($queue->patient_id)->get()->last();

        return view('admin.examination-result.index', [
            'examinationResult' => $queue,
            'upload' => $upload,
            'informationHistoryDetail' => $patientHistory->informationHistoryDetail,
            'dataBasicPhysicalExamination' => $this->getBasicPhysicalExamination($request, $queue->patient_id),
            'medicines' => Medicine::all(),
            'data' => $this->indexDoctorMedicine($request, $patientHistory->id),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexDoctorMedicine $request
     * @return array|Factory|View
     */
    public function indexDoctorMedicine(Request $request, $patientHistoryId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(DoctorMedicine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['amount', 'cheminal_name', 'id', 'patient_history_id','use','dose','type'],

            // set columns to searchIn
            ['cheminal_name', 'id'],
            static function (Builder $query) use ($patientHistoryId) {
                $query->where('patient_history_id', $patientHistoryId);
            }
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }

        return $data;
    }


    /**
     * Display a listing of the resource.
     *
     * @param IndexBasicPhysicalExamination $request
     * @return array|Factory|View
     */
    public function getBasicPhysicalExamination(Request $request, $patientId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BasicPhysicalExamination::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_id', 'pressure', 'weight', 'temperature','ta','spo2','pr', 'created_at'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($patientId) {
                $query->where('patient_id', $patientId);

                $query->orderBy('id', 'DESC');
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return $data;
    }

    public function saveComment(StoreComment $request)
    {
        $queue = Queue::find($request->queue_id);

        if ($request->status_doctor_medicine == false) {

            $doctor = DoctorMedicine::wherePatientHistoryId($queue->patient_history_last->id)->first();
            if ($doctor) {
                $doctor->delete();
            }
        }

        $patientHistory = PatientHistory::find($queue->patient_history_last->id);

        $patientHistory->doctor_fee = $request->doctor_fee;
        $patientHistory->doctor_fee_discount = $request->doctor_fee_discount;

        $patientHistory->save();

        $comment = $queue->comments()->create($request->getSanitized());

        $queue->queues_status = 'pharmacy';

        $queue->save();

        event(new Examination('pharmacy'));

        if ($request->ajax()) {
            return ['redirect' => url('admin/examinations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/examinations');
    }



    public function printExaminationResult(Request $request)
    {
        $queue = Queue::find($request->queue_id);
        // return $queue;
        return view('admin.reports.examination.print-examination-result', [
            'queue' => $queue,
            'examinationServicesResult' => $queue->patient_history_last->examinationServicesResult,
        ]);
    }

    public function printPatientInfo(Request $request)
    {
        $queue = Queue::find($request->queue_id);
        $info = $queue->patient_history_last->infor_History_key_value;
        return view('admin.reports.examination.print-patient-info', [
            'queue' => $queue,
            'info' => $info,
        ]);
    }

    public function inputAgain(InputAgainRequest $request)
    {
        $examinationService = ExaminationService::find($request->examination_service_id);
        $examinationService->input_status = true;
        $examinationService->save();

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
