<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LimitSkip;
use App\Models\HealthTip;
use Illuminate\Http\Request;
use App\Http\Resources\HealthTips as ResourcesHealthTips;

class HealthtTips extends AppBaseController
{
    public function getHealthTips(LimitSkip $request)
    {
        $healthtips = HealthTip::get();
        $sanitized = $request->getSanitized();
        $healthtips = HealthTip::limit($sanitized['limit'])->skip($sanitized['skip'])->get();
        // return $this->sendResponse($healthtips,'');
        return ResourcesHealthTips::collection($healthtips);
    }

    public function getDetail(HealthTip $healthTip)
    {
        return $this->sendResponse(['detail' => $healthTip->detail], '');
    }
    
    // public function getSkipLimit($skip,$limit)
    // {


    //     $healthtips=HealthTip::skip($skip)->take($limit)->get();

    //     return $this->sendResponse($healthtips, '');
    // }
}
