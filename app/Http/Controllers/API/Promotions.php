<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LimitSkip;
use App\Http\Resources\Promotion as ResourcesPromotion;
use App\Models\Promotion;
use Illuminate\Http\Request;

class Promotions extends AppBaseController
{
    public function getPromotions(LimitSkip $request)
    {
        $sanitized = $request->getSanitized();

        $promotions = Promotion::limit($sanitized['limit'])->skip($sanitized['skip'])->get();

        return ResourcesPromotion::collection($promotions);
    }

    public function getPromotionsLimit(Request $request)
    {
        $skip = 0;
        $limit = 10;
        $data = [];

        if ($request->skip) {
            $skip = $request->skip;
        }
        if ($request->limit) {
            $limit = $request->limit;
        }

        $promotions = Promotion::limit($limit)->skip($skip)->get();


        foreach ($promotions as $key => $value) {
            $data[] = [
                'id' => $value->id,
                'name' => $value->name,
                'short_desc' => $value->short_desc,
                'link' => $value->link,
                'promotion_image' => url($value->promotion_image),
            ];
        }


        return [
            'data' => $data
        ];
    }
}
