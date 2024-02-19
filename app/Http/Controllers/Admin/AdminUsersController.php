<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUser\DestroyAdminUser;
use App\Http\Requests\Admin\AdminUser\ImpersonalLoginAdminUser;
use App\Http\Requests\Admin\AdminUser\IndexAdminUser;
use App\Http\Requests\Admin\AdminUser\StoreAdminUser;
use App\Http\Requests\Admin\AdminUser\UpdateAdminUser;
use App\Models\AdminUser;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeStatus;
use App\Models\Lab;
use Spatie\Permission\Models\Role;
use Brackets\AdminAuth\Activation\Facades\Activation;
use Brackets\AdminAuth\Services\ActivationService;
use Brackets\AdminListing\Facades\AdminListing;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;

class AdminUsersController extends Controller
{

    /**
     * Guard used for admin user
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * AdminUsersController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guard = config('admin-auth.defaults.guard');
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexAdminUser $request
     * @return Factory|View
     */
    public function index(IndexAdminUser $request)
    {

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(AdminUser::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'first_name', 'last_name', 'email', 'activated', 'forbidden', 'language'],

            // set columns to searchIn
            ['id', 'first_name', 'last_name', 'email', 'language'],
            static function (Builder $query) use ($request) {
                $query->with(['employee']);
                if (auth()->user()->id != 1) {
                    $query->where('id', '!=', 1);
                }
            }
        );

        if ($request->ajax()) {
            return ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')];
        }

        return view('admin.admin-user.index', ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.admin-user.create');

        return view('admin.admin-user.create', [
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::where('guard_name', $this->guard)->get(),
            'departments' => Department::all(),
            'branches' => Branch::all(),
            'labs' => Lab::all()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdminUser $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAdminUser $request)
    {
        DB::transaction(function () use ($request) {
            // Sanitize input
            $sanitized = $request->getModifiedData();

            // Store the AdminUser
            $adminUser = AdminUser::create($sanitized);

            $data =  $sanitized['employee'];
            $data['admin_user_id'] = $adminUser->id;

            Employee::create($data);

            // But we do have a roles, so we need to attach the roles to the adminUser
            $adminUser->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        });

        if ($request->ajax()) {
            return ['redirect' => url('admin/admin-users'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/admin-users');
    }

    /**
     * Display the specified resource.
     *
     * @param AdminUser $adminUser
     * @throws AuthorizationException
     * @return void
     */
    public function show(AdminUser $adminUser)
    {
        $this->authorize('admin.admin-user.show', $adminUser);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AdminUser $adminUser
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(AdminUser $adminUser)
    {
        $this->authorize('admin.admin-user.edit', $adminUser);
        $adminUser->onlySuperAdmin();

        $adminUser->load('roles');
        $adminUser->load('employee');

        // return $adminUser;

        return view('admin.admin-user.edit', [
            'adminUser' => $adminUser,
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::where('guard_name', $this->guard)->get(),
            'departments' => Department::all(),
            'branches' => Branch::all(),
            'labs' => Lab::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAdminUser $request
     * @param AdminUser $adminUser
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAdminUser $request, AdminUser $adminUser)
    {
        $adminUser->onlySuperAdmin();

        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Update changed values AdminUser
        $adminUser->update($sanitized);


        $adminUser->load('employee');

        $data =  $sanitized['employee'];
        $employee = Employee::find($adminUser->employee->id);

        $employee->update($data);

        // But we do have a roles, so we need to attach the roles to the adminUser
        if ($request->input('roles')) {
            $adminUser->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/admin-users'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/admin-users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAdminUser $request
     * @param AdminUser $adminUser
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyAdminUser $request, AdminUser $adminUser)
    {
        $adminUser->onlySuperAdmin();

        $employee = Employee::where('admin_user_id', $adminUser->id)->first();
        if ($employee) {
            $employeeStatus = EmployeeStatus::where('employee_id', $employee->id)->first();
            if ($employeeStatus) {
                $employeeStatus->delete();
            }
            $employee->delete();
        }



        $adminUser->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Resend activation e-mail
     *
     * @param Request $request
     * @param ActivationService $activationService
     * @param AdminUser $adminUser
     * @return array|RedirectResponse
     */
    public function resendActivationEmail(Request $request, ActivationService $activationService, AdminUser $adminUser)
    {
        if (Config::get('admin-auth.activation_enabled')) {
            $response = $activationService->handle($adminUser);
            if ($response == Activation::ACTIVATION_LINK_SENT) {
                if ($request->ajax()) {
                    return ['message' => trans('brackets/admin-ui::admin.operation.succeeded')];
                }

                return redirect()->back();
            } else {
                if ($request->ajax()) {
                    abort(409, trans('brackets/admin-ui::admin.operation.failed'));
                }

                return redirect()->back();
            }
        } else {
            if ($request->ajax()) {
                abort(400, trans('brackets/admin-ui::admin.operation.not_allowed'));
            }

            return redirect()->back();
        }
    }

    /**
     * @param ImpersonalLoginAdminUser $request
     * @param AdminUser $adminUser
     * @return RedirectResponse
     * @throws  AuthorizationException
     */
    public function impersonalLogin(ImpersonalLoginAdminUser $request, AdminUser $adminUser)
    {
        Auth::login($adminUser);
        return redirect()->back();
    }
}
