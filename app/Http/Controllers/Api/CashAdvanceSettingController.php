<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashAdvanceSettingRequest\CreateCashAdvanceSettingRequest;
use App\Http\Requests\CashAdvanceSettingRequest\UpdateCashAdvanceSettingRequest;
use App\Http\Services\CashAdvanceSettingService;
use Illuminate\Http\Request;

class CashAdvanceSettingController extends Controller
{
    public $cashAdvanceSettingService;

    public function __construct(CashAdvanceSettingService $cashAdvanceSettingService)
    {
        $this->cashAdvanceSettingService = $cashAdvanceSettingService;
    }

    public function create(CreateCashAdvanceSettingRequest $request)
    {
        $response = $this->cashAdvanceSettingService->create($request->all());
        return $this->sendResponse($response);
    }

    public function update(UpdateCashAdvanceSettingRequest $request)
    {
        $response = $this->cashAdvanceSettingService->update($request->all());
        return $this->sendResponse($response);
    }

    public function list(Request $request)
    {
        $response = $this->cashAdvanceSettingService->list($request->all());
        return $this->sendResponse($response);
    }

    public function destroy($id)
    {
        $response = $this->cashAdvanceSettingService->destroy($id);
        return $this->sendResponse($response);
    }
}
