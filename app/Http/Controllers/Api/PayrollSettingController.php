<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollSettingRequest\CreatePayrollSettingRequest;
use App\Http\Requests\PayrollSettingRequest\UpdatePayrollSettingRequest;
use App\Http\Services\PayrollSettingService;
use Illuminate\Http\Request;

class PayrollSettingController extends Controller
{
    public $payrollSettingService;

    public function __construct(PayrollSettingService $payrollSettingService)
    {
        $this->payrollSettingService = $payrollSettingService;
    }

    public function create(CreatePayrollSettingRequest $request)
    {
        $response = $this->payrollSettingService->create($request->all());
        return $this->sendResponse($response);
    }

    public function update(UpdatePayrollSettingRequest $request)
    {
        $response = $this->payrollSettingService->update($request->all());
        return $this->sendResponse($response);
    }

    public function list(Request $request)
    {
        $response = $this->payrollSettingService->list($request->all());
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $response = $this->payrollSettingService->destroy($id);
        return $this->sendResponse($response);
    }
}
