<?php 

namespace App\Http\Traits;

/**
 * API Resposne Trait
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */
trait ApiResponseTrait
{
    /**
     * default status code.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * Set the status code.
     *
     * @param string $code
     * @return self
     */
    public function setStatusCode(string $code): self
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * get the status code.
     *
     * @return statuscode
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Success Response.
     *
     * @param array $data
     * @param string $message
     * @param int $code
     * @return json|string
     */
    public function successResponse($data = [], $message = 'Success', $code = 200)
    {
        $response = [
            'status'    => true,
            'data'      => $data,
            'message'   => $message ? $message : 'Success',
            'code'      => $code ? $code : $this->getStatusCode(),
        ];

        return response()->json(
            (object) $response,
            $this->getStatusCode()
        );
    }

    /**
     * Failure Response.
     *
     * @param array $data
     * @param string $message
     * @param int $code
     * @return json|string
     */
    public function failureResponse($message = null, $errors = [])
    {
        $response = [
            'status' => false,
        ];

        if ($message) {
            $response['message'] = $message;
        }
        
        if (count($errors)) {
            $response['error'] = $errors;
        }

        return response()->json(
            (object) $response,
            $this->getStatusCode()
        );
    }
}