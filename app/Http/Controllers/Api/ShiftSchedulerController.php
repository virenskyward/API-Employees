<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShiftSchedulerRequest\CopyShiftSchedulerRequest;
use App\Http\Requests\ShiftSchedulerRequest\SetShiftSchedulerRequest;
use App\Http\Services\ShiftSchedulerService;
use Illuminate\Http\Request;

class ShiftSchedulerController extends Controller
{
    public $shiftSchedulerService;

    public function __construct(ShiftSchedulerService $shiftSchedulerService)
    {
        $this->shiftSchedulerService = $shiftSchedulerService;
    }

    public function setShiftScheduler(SetShiftSchedulerRequest $request)
    {
        $response = $this->shiftSchedulerService->setShiftScheduler($request->all());
        return $this->sendResponse($response);
    }

    public function getShiftScheduler(Request $request)
    {
        $response = $this->shiftSchedulerService->getShiftScheduler($request->all());
        return $this->sendResponse($response);
    }

    public function copyShiftScheduler(CopyShiftSchedulerRequest $request)
    {
        $response = $this->shiftSchedulerService->copyShiftScheduler($request->all());
        return $this->sendResponse($response);
    }
}