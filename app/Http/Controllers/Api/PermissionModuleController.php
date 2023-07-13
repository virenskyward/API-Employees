<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionModuleRequest\CreatePermissionModuleRequest;
use App\Http\Requests\PermissionModuleRequest\UpdatePermissionModuleRequest;
use App\Http\Services\PermissionModuleService;
use Illuminate\Http\Request;

class PermissionModuleController extends Controller
{
    public $permissionModuleService;

    public function __construct(PermissionModuleService $permissionModuleService)
    {
        $this->permissionModuleService = $permissionModuleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function list(Request $request) {
        $response = $this->permissionModuleService->list($request->all());
        return $this->sendResponse($response);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreatePermissionModuleRequest $request)
    {
        $response = $this->permissionModuleService->create($request->all());
        return $this->sendResponse($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionModuleRequest $request, $id)
    {
        $response = $this->permissionModuleService->update($request->all(), $id);
        return $this->sendResponse($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->permissionModuleService->delete($id);
        return $this->sendResponse($response);
    }
}
