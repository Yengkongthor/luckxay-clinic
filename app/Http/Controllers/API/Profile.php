<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\ChangePassword;
use App\Http\Requests\API\UpdateProfile;
use Hash;
use Illuminate\Http\Request;

class Profile extends AppBaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        return $this->sendResponse($request->user(), null);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\API\UpdateProfile  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfile $request)
    {
        $request->user()->update($request->validated());
        
        return $this->sendResponse(null, null);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\API\ChangePassword  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePassword $request)
    {
        $user = $request->user();

        if (!Hash::check($request['old_password'], $user->password)) {
            return $this->sendError(trans('auth.current_password'), 442);
        }

        $user->update($request->getModifiedData());

        return $this->sendResponse(null, null);
    }
}
