<?php

namespace App\Http\Traits;

trait Response
{
    public function responseSuccess($message = 'Success.')
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
        ], 200);
    }

    public function responseWithData($data)
    {
        return response()->json($data, 200);
    }

    public function responseWithToken($token, $role)
    {
        return response()->json([
            'key_login'     => $token,
            'role'          => $role
        ]);
    }

    public function responseResourceCreated(string $message = 'Resource created.')
    {
        return response()->json([
            'status' => 201,
            'message' => $message,
        ], 201);
    }

    public function responseUnauthorized(string $errors = 'Unauthorized.')
    {
        return response()->json([
            'status' => 401,
            'errors' => $errors,
        ], 401);
    }

    public function responseUnprocessable(string $errors)
    {
        return response()->json([
            'status' => 422,
            'errors' => $errors,
        ], 422);
    }

    public function responseServerError(string $errors = 'Server error.')
    {
        return response()->json([
            'status' => 500,
            'errors' => $errors
        ], 500);
    }
}
