<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($data)
    {
            $response = [
                'success' => $data['status'] ?? true,
                'message' => $data['message'] ?? '',
                'code' => $data['code'] ?? 200,
                'data'    => $data['data'] ?? (object) []
            ];
            return response()->json($response, 200);
    }
}