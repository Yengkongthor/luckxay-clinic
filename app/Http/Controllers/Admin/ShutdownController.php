<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use anlutro\LaravelSettings\Facade as Setting;

class ShutdownController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->hasRole('Owner') && $request->user()->id != 1) abort(403);

        return view('admin.shutdown.index', [
            'data' => collect([
                'shutdown' => Setting::get('shutdown') ?? false
            ])
        ]);
    }

    public function update(Request $request)
    {
        if (!$request->user()->hasRole('Owner') && $request->user()->id != 1) abort(403);

        Setting::set('shutdown', (bool)$request->get('shutdown'));
        Setting::save();

        return response([]);
    }
}
