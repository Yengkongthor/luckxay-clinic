<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BasicPhysicalExamination\IndexBasicPhysicalExamination;
use App\Http\Requests\Admin\User\DestroyUser;
use App\Http\Requests\Admin\User\IndexUser;
use App\Http\Requests\Admin\User\StoreUser;
use App\Http\Requests\Admin\User\UpdateUser;
use App\Models\BasicPhysicalExamination;
use App\Models\District;
use App\Models\Package;
use App\Models\Patient;
use App\Models\PatientHistory;
use App\Models\Province;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Brackets\AdminListing\Facades\AdminListing;
use DB;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Log;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexUser $request
     * @return array|Factory|View
     */
    public function index(IndexUser $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(User::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'surname', 'phone'],

            // set columns to searchIn
            ['id', 'name', 'surname', 'phone','patients.patient_code'],
            static function (Builder $query) {
                $query->with('patient');
                $query->join('patients', 'patients.user_id','=', 'users.id');
            }
        );

        $data = collect($data);
        $data['data'] = [
            'users' => $data['data'],
            'package' => Package::all(),
        ];

        if ($request->ajax()) {
            return ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')];
        }

        return view('admin.user.index', ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('admin.user.create');

        return view('admin.user.create', [
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::all(),
            'provinces' => Province::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUser $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreUser $request)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();


        $user = DB::transaction(function () use ($request, $sanitized) {
            // Store the User
            $user = User::create($sanitized);

            $user->patient()->create($sanitized['patient']);

            // But we do have a roles, so we need to attach the roles to the user
            $user->roles()->sync(collect($request->input('roles', []))->map->id->toArray());

            return $user;
        });

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/users/' . $user->id . '/edit'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                'user' => $user,
            ];
        }

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return void
     * @throws AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('admin.user.show', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $user, IndexBasicPhysicalExamination $request)
    {
        $this->authorize('admin.user.edit', $user);

        $user->load('roles');

        $user->load('patient');
        $province = Province::where('en_name', $user->patient->province)->first();
        $districts = [];
        if ($province) {
            $districts = District::where('province_id', $province->id)->get();
        }
        $user['patient']['province'] = $province;

        $user['districts'] = $districts;

        return view('admin.user.edit', [
            'user' => $user,
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::all(),
            'data' => $this->indexBasicPhysicalExamination($request, $user->patient->id),
            'dataPatientHistory' => $this->indexPatientHistory($request, $user->patient->id),
            'provinces' => Province::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUser $request
     * @param  User $user
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateUser $request, User $user)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();
        // Update changed values User
        $user->update($sanitized);

        if ($user->patient->id > 0) {
            Patient::find($user->patient->id)->update($sanitized['patient']);
        } else {
            $user->patient()->create($sanitized['patient']);
        }


        // But we do have a roles, so we need to attach the roles to the user
        if ($request->input('roles')) {
            $user->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/users'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyUser $request
     * @param  User $user
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyUser $request, User $user)
    {
        // $patientHistory = PatientHistory::wherePatientId($user->id)->first();

        // if (isset($patientHistory)) {
        //     return response(['message' => 'User ນີ້ຖືກນຳໃຊ້ໃນ PatientHistory ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        // }

        $patient = Patient::whereUserId($user->id)->first();

        if ($patient) {
            $patient->delete();
        }

        $user->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexBasicPhysicalExamination $request
     * @return array|Factory|View
     */
    public function indexBasicPhysicalExamination(IndexBasicPhysicalExamination $request, $patientId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BasicPhysicalExamination::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_id', 'pressure', 'weight', 'temperature', 'ta', 'spo2', 'pr', 'bp', 'rr'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($patientId) {
                $query->where('patient_id', $patientId);
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

        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @param IndexBasicPhysicalExamination $request
     * @return array|Factory|View
     */
    public function indexPatientHistory(Request $request, $patientId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PatientHistory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [
                'id', 'patient_id',
                'patient_historyable_id',
                'patient_historyable_type',
                'test_at',
                'doctor_fee',
                'doctor_fee_discount',
            ],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($patientId) {
                $query->where('patient_id', $patientId);
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return $data;
    }
}
