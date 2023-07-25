<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest\ChatHistoryRequest;
use App\Http\Requests\LeaveRequest\CreateLeaveRequest;
use App\Http\Requests\LeaveRequest\FilterLeaveRequest;
use App\Http\Requests\LeaveRequest\UpdateLeaveRequest;
use App\Http\Requests\LeaveRequest\UpdateLeaveRequestStatus;
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

    public function updateLeaveRequestStatus(UpdateLeaveRequestStatus $request)
    {
        $response = $this->leaveRequestService->updateLeaveRequestStatus($request->all());
        return $this->sendResponse($response);
    }

    public function list(FilterLeaveRequest $request)
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

    public function updateLeaveRequest(UpdateLeaveRequest $request)
    {
        $response = $this->leaveRequestService->updateLeaveRequest($request->all());
        return $this->sendResponse($response);
    }

    public function chatHistory(ChatHistoryRequest $request)
    {
        $response = $this->leaveRequestService->chatHistory($request->all());
        return $this->sendResponse($response);
    }
}