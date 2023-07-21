<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\LeaveTypeService;
use App\Http\Requests\LeaveType\CreateLeaveTypeRequest;
use App\Http\Requests\LeaveType\UpdateLeaveTypeRequest;


class LeaveTypeController extends Controller
{
    public $leaveTypeService;

    public function __construct(LeaveTypeService $leaveTypeService)
    {
        $this->leaveTypeService = $leaveTypeService;
    }
    
    /**
     * List the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->leaveTypeService->getAllLeaveType();
        return $this->sendResponse($response);
    }

    /**
     * Show the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $leaveTypeUuid
     * @return \Illuminate\Http\Response
     */
    public function show($leaveTypeUuid)
    {
        $response = $this->leaveTypeService->getSingleLeaveType($leaveTypeUuid);
        return $this->sendResponse($response);
    }

    /**
     * Create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreateLeaveTypeRequest $request)
    {
        $response = $this->leaveTypeService->getAddLeaveType($request->all());
        return $this->sendResponse($response);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $leaveTypeId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeaveTypeRequest $request, $leaveTypeId)
    {
        $response = $this->leaveTypeService->getUpdateLeaveType($request->all(), $leaveTypeId);
        return $this->sendResponse($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $leaveTypeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($leaveTypeId)
    {
        $response = $this->leaveTypeService->getDeleteLeaveType($leaveTypeId);
        return $this->sendResponse($response);
    }
}
