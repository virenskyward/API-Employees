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

if (!function_exists('generatePIN')) {
    function generatePIN($length = 6)
    {
        $digit = '0123456789';
        $pin = '';
        for ($i = 0; $i < $length; $i++) {
            $pin .= $digit[random_int(0, strlen($digit) - 1)];
        }
        return $pin;
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

if (!function_exists('curlSMSCall')) {
    function curlSMSCall($endpoint, $params, $accountSid, $accountToken, $method)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'User-Agent' => 'PostmanRuntime/7.32.3',
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate',
            'Connection' => 'keep-alive',
        ])->withOptions([
            'auth' => [$accountSid, $accountToken],
        ])->asForm()->$method($endpoint, $params);
    }
}

if (!function_exists('generateUPC')) {
    function generateUPC($length = 13)
    {
        $digit = '0123456789';
        $upc = '';
        for ($i = 0; $i < $length; $i++) {
            $upc .= $digit[random_int(0, strlen($digit) - 1)];
        }
        return $upc;
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
