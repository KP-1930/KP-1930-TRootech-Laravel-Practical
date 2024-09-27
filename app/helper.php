<?php

use Illuminate\Support\Facades\DB;

function sendResponse($res, $message)
{
    $response = [
        'success' => true,
        'data'    => $res,
        'message' => $message,
    ];

    return response()->json($response, 200);
}

function sendError($error, $errorMessages = [], $code = 404)
{
    $response = [
        'success' => false,
        'message' => $error,
    ];

    if (!empty($errorMessages)) {
        $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
}


function getUserIdFromToken($token)
{
    $tokenRecord = DB::table('personal_access_tokens')->where('token', $token)->first();

    if ($tokenRecord) {
        return $tokenRecord->tokenable_id;
    }

    return null; 
}
