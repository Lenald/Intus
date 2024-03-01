<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonErrorResponse extends JsonResponse
{
    public function __construct(
        string $message = 'Something went wrong.',
        $code = Response::HTTP_BAD_REQUEST,
        $headers = [],
        $options = 0,
        $json = false
    ) {
        $data = [
            'status' => 'error',
            'message' => $message
        ];

        parent::__construct($data, $code, $headers, $options, $json);
    }
}
