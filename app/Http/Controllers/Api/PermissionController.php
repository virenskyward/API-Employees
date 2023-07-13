<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PermissionService;
use App\Http\Requests\PermissionRequest\CreatePermissionRequest;

class PermissionController extends Controller
{
    public $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $response = $this->permissionService->list($request->all());
        return $this->sendResponse($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreatePermissionRequest $request)
    {
        $response = $this->permissionService->create($request->all());
        return $this->sendResponse($response);
    }
    
}