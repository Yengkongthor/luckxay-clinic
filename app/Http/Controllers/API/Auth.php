<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\FindPhone;
use App\Http\Requests\API\Login;
use App\Http\Requests\API\Register;
use App\Http\Requests\ForgetPassword;
use App\Http\Resources\User as ResourcesUser;
use App\Models\FirebaseUser;
use App\Models\Patient;
use App\Models\User;
use App\Services\FirebaseService;
use DB;
use Hash;
use Illuminate\Http\Request;

class Auth extends AppBaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\API\Login  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Login $request)
    {
        //  \Log::info('Login request data:', ['request' => $request->all()]);
        $user = User::where('phone', $request->phone)->first();

        if (!$user) return $this->sendError(trans('auth.failed'), 442);

        if (!Hash::check($request['password'], $user->password)) {
            return $this->sendError(trans('auth.failed'), 442);
        }

        return new ResourcesUser($user);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\API\Register  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Register $request, FirebaseService $firebaseService)
    {
        $firebaseServiceUser = $firebaseService->getUser($request->token);

        $firebaseUser = FirebaseUser::where('f_user_uid', $firebaseServiceUser->uid)->first();

        // if firebaseUser existed and has user
        if ($firebaseUser && $firebaseUser->user) {
            return new ResourcesUser($firebaseUser->user);
        }

        // if firebaseUser existed and user was deleted then restore user
        if ($firebaseUser && $user = $firebaseUser->user()->withTrashed()->first()) {
            $user->restore();
            $user->update($request->getModifiedData());
            $user->patient()->restore();
            return new ResourcesUser($user);
        }

        // if only have firebaseUser record then delete it
        if ($firebaseUser) {
            $firebaseUser->delete();
        }

        // if no firebaseUser then create new
        $user = DB::transaction(function () use ($request, $firebaseServiceUser) {
            $user = User::wherePhone($request->getModifiedData()['phone'])->first();

            if ($user) {
                $user->update($request->getModifiedData());
            } else {
                $user = User::create($request->getModifiedData());
                Patient::create([
                    'user_id' => $user->id,
                    'lao_first_name' => $user ? $user->name : '',
                    'lao_last_name' => $user ? $user->surname : '',
                    'age' => 0,
                    'gender' => '',
                    'province' => '',
                    'district' => '',
                    'village' => '',
                    'marital_status' => '',
                    'blood_group' => '',
                    'nick_name' => '',
                    'birth_date' => '1111-11-11',
                ]);
            }

            FirebaseUser::create([
                'user_id' => $user->id,
                'f_user_uid' => $firebaseServiceUser->uid,
                'provider_id' => $firebaseServiceUser->providerData[0]->uid,
                'provider_uid' => $firebaseServiceUser->providerData[0]->providerId,
            ]);

            return $user;
        });

        return new ResourcesUser($user);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\API\FindPhone  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findPhone(FindPhone $request)
    {
        $user = User::where('phone', $request->phone)->first();
        return $this->sendResponse(['existed' => isset($user)], null);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->sendResponse(null, null);
    }

    public function fogetPassword(ForgetPassword $request, FirebaseService $firebaseService)
    {
        $firebaseServiceUser = $firebaseService->getUser($request->token);

        $user = User::where('phone', $firebaseServiceUser->providerData[0]->uid)->first();

        $user->password  =  Hash::make($request->password);

        $user->save();

        return $this->sendResponse(['status' => true], 'forget password');
    }
}
