<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * Generate success type response.
     *
     * Returns the success data and message if there is any error
     *
     * @param object $data
     * @param string $message
     * @param integer $status_code
     * @return JsonResponse
     */
    public function responseSuccess($data, $message = "Successful", $status_code = JsonResponse::HTTP_OK): JsonResponse
    {

        return response()->json([
            'status'  => true,
            'message' => $message,
            'errors'  => null,
            'data'    => $data,
        ], $status_code);
    }

    /**
     * Generate Error response.
     *
     * Returns the errors data if there is any error
     *
     * @param object $errors
     * @return JsonResponse
     */
    public function responseError($errors, $message = 'Data is invalid', $status_code = JsonResponse::HTTP_BAD_REQUEST): JsonResponse
    {
        $errorList = [];
        if (!empty($errors)) {
            if (!is_array($errors)) {
                $errors = [$errors];
            }
            foreach ($errors as $error) {
                $errorList = $error;
            }
        }
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  =>is_array($errorList) ? $errorList : [$errorList],
            'data'    => null,
        ], $status_code);
    }
}
