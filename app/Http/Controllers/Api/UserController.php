<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use App\Http\Requests\User\VerifyPinRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * List the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateUserRequest $request)
    {
        $response = $this->userService->create($request->all());
        return $this->sendResponse($response);
    }

     /**
     * List the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $response = $this->userService->update($request->all());
        return $this->sendResponse($response);
    }

     /**
     * List the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $response = $this->userService->list($request->all());
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
        $response = $this->userService->destroy($id);
        return $this->sendResponse($response);
    }
}