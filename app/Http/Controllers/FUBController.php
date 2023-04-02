<?php

namespace App\Http\Controllers;

use App\Facades\FollowUpBoss;
use App\Http\Requests\StoreLeadRequest;
use Illuminate\Http\Request;

class FUBController extends Controller
{
    public function __invoke(StoreLeadRequest $request)
    {
        FollowUpBoss::makeLead($request);
    }
}
