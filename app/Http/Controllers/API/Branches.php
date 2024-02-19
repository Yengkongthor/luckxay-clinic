<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Branch as ResourcesBranch;
use App\Models\Branch;
use Illuminate\Http\Request;

class Branches extends AppBaseController
{
    public function getBranches()
    {
        $branches = Branch::get();

        return ResourcesBranch::collection($branches);
    }
}
