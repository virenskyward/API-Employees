<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\PermissionActionService;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionActionRequest\CreatePermissionActionRequest;
use App\Http\Requests\PermissionActionRequest\UpdatePermissionActionRequest;

class PermissionActionController extends Controller
{
    public $permissionActionService;

    public function __construct(PermissionActionService $permissionActionService)
    {
        $this->permissionActionService = $permissionActionService;
    }

    function list(Request $request) {
        $response = $this->permissionActionService->list($request->all());
        return $this->sendResponse($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreatePermissionActionRequest $request)
    {
        $response = $this->permissionActionService->create($request->all());
        return $this->sendResponse($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionActionRequest $request, $id)
    {
        $response = $this->permissionActionService->update($request->all(), $id);
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
        $response = $this->permissionActionService->delete($id);
        return $this->sendResponse($response);
    }
}
