<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NotificationReception\BulkDestroyNotificationReception;
use App\Http\Requests\Admin\NotificationReception\DestroyNotificationReception;
use App\Http\Requests\Admin\NotificationReception\IndexNotificationReception;
use App\Http\Requests\Admin\NotificationReception\StoreNotificationReception;
use App\Http\Requests\Admin\NotificationReception\UpdateNotificationReception;
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

class NotificationReceptionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexNotificationReception $request
     * @return array|Factory|View
     */
    public function index(IndexNotificationReception $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(NotificationReception::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['caller', 'class', 'id', 'patient'],

            // set columns to searchIn
            ['caller', 'class', 'id', 'patient']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.notification-reception.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.notification-reception.create');

        return view('admin.notification-reception.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNotificationReception $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreNotificationReception $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the NotificationReception
        $notificationReception = NotificationReception::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/notification-receptions'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/notification-receptions');
    }

    /**
     * Display the specified resource.
     *
     * @param NotificationReception $notificationReception
     * @throws AuthorizationException
     * @return void
     */
    public function show(NotificationReception $notificationReception)
    {
        $this->authorize('admin.notification-reception.show', $notificationReception);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param NotificationReception $notificationReception
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(NotificationReception $notificationReception)
    {
        $this->authorize('admin.notification-reception.edit', $notificationReception);


        return view('admin.notification-reception.edit', [
            'notificationReception' => $notificationReception,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNotificationReception $request
     * @param NotificationReception $notificationReception
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateNotificationReception $request, NotificationReception $notificationReception)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values NotificationReception
        $notificationReception->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/notification-receptions'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/notification-receptions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyNotificationReception $request
     * @param NotificationReception $notificationReception
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyNotificationReception $request, NotificationReception $notificationReception)
    {
        $notificationReception->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyNotificationReception $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyNotificationReception $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    NotificationReception::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
