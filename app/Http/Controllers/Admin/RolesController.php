<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\DestroyRole;
use App\Http\Requests\Admin\Role\IndexRole;
use App\Http\Requests\Admin\Role\StoreRole;
use App\Http\Requests\Admin\Role\UpdateRole;
use App\Models\Permission;
use App\Models\Role;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Log;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRole $request
     * @return array|Factory|View
     */
    public function index(IndexRole $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Role::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'guard_name'],

            // set columns to searchIn
            ['id', 'name', 'guard_name']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.role.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.role.create');

        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRole $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRole $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Role
        $role = Role::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/roles/' . $role->id . '/edit'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/roles' . $role->id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @throws AuthorizationException
     * @return void
     */
    public function show(Role $role)
    {
        $this->authorize('admin.role.show', $role);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Role $role)
    {
        $this->authorize('admin.role.edit', $role);

        $role->load('permissions');

        $permissions = $role['permissions']->pluck('id');
        Arr::pull($role, 'permissions');
        $role['permissions'] = $permissions;

        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => Permission::where('guard_name', 'admin')->get(),
            'permissionKeys' => Permission::getKeys()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRole $request
     * @param Role $role
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRole $request, Role $role)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Role
        $role->update($sanitized);

        $role->permissions()->sync($request->input('permissions', []));

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/roles'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRole $request
     * @param Role $role
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRole $request, Role $role)
    {
        $role->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
