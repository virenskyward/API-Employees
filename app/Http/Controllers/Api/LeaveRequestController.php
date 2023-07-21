<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest\CreateLeaveRequest;
use App\Http\Requests\LeaveRequest\UpdateLeaveRequest;
use App\Http\Services\LeaveRequestService;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public $leaveRequestService;

    public function __construct(LeaveRequestService $leaveRequestService)
    {
        $this->leaveRequestService = $leaveRequestService;
    }

    public function createLeaveRequest(CreateLeaveRequest $request)
    {
        $response = $this->leaveRequestService->createLeaveRequest($request->all());
        return $this->sendResponse($response);
    }

    public function updateLeaveRequest(UpdateLeaveRequest $request)
    {
        $response = $this->leaveRequestService->updateLeaveRequest($request->all());
        return $this->sendResponse($response);
    }

    public function list(Request $request)
    {
        $response = $this->leaveRequestService->list($request->all());
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $response = $this->leaveRequestService->destroy($id);
        return $this->sendResponse($response);
    }

    public function getLeaveRequest(Request $request)
    {
        $response = $this->leaveRequestService->getLeaveRequest($request->all());
        return $this->sendResponse($response);
    }
}