<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

if (!function_exists('getCurrentDateTime')) {
    function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }
}

if (!function_exists('curlCall')) {
    function curlCall($endpoint, $params, $authorization, $method, $terminalID)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'User-Agent' => 'PostmanRuntime/7.32.3',
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate',
            'Connection' => 'keep-alive',
            'terminal-id' => $terminalID,
            'Authorization' => $authorization,
        ])->$method($endpoint, $params);
    }
}

if (!function_exists('failedValidation')) {
    function failedValidation($success, $message)
    {
        throw new HttpResponseException(response()->json([
            'success' => $success,
            'message' => $message,
            'code' => Response::HTTP_FORBIDDEN,
            'data' => null
        ]));
    }
}