<?php


namespace App\Traits;


trait ApiResponse
{
    public function success($data, string $message)
    {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];
    }

    public function fail($data, string $message)
    {
        return [
            'success' => true,
            'message' => $message
        ];
    }
}
