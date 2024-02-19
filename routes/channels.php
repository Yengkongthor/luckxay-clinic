<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('employee-status-event', function ($user) {
    return true;
});

Broadcast::channel('assign-queue-to-doctor.{doctorId}', function ($user, $doctorId) {
    return $user->employee->admin_user_id ==  $doctorId;
});

Broadcast::channel('Examination', function () {
    return true;
});

Broadcast::channel('to-lab.{departmentCode}', function ($user, $departmentCode) {
    return (string) $user->employee->department_code === (string) $departmentCode;
});

Broadcast::channel('Doctor.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Reception.{receptionDepartmentCode}', function ($user, $receptionDepartmentCode) {
    return (string) $user->employee->department_code === (string) $receptionDepartmentCode;
});
