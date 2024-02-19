<?php

namespace App\Services;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Messaging;

class FirebaseService
{
    private $auth;
    private $messaging;

    public function __construct() {
        $this->auth = app('firebase.auth');
        $this->messaging = app('firebase.messaging');
    }

    public function getUser($idTokenString)
    {
        $verifiedIdToken = $this->auth->verifyIdToken($idTokenString);
        $uid = $verifiedIdToken->getClaim('sub');
        return $this->auth->getUser($uid);
    }

    public function deleteUser($uid)
    {
        return $this->auth->deleteUser($uid);
    }

    public function sendMessage()
    {

    }
}
