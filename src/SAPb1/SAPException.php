<?php

namespace SAPb1;

class SAPException extends \Exception
{
    protected int $statusCode;
    public readonly Response $response;
    public readonly string $body;

    /**
     * Initializes a new instance of SAPException.
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->body = $response->getBody();
        $this->statusCode = $response->getStatusCode();
        $message = '';
        $errorCode = $this->statusCode;
        try {
            if ($response->getHeaders('Content-Type') == 'text/html') {
                $message = $response->getBody();
            }
            if ($response->getHeaders('Content-Type') == 'application/json') {
                $json = $response->getJson();
                if (property_exists($json, "error")) {
                    if (property_exists($json->error, "message")) {
                        $message = $json->error->message;
                        $errorCode = $json->error->code;
                    } else {
                        throw "No error->message property";
                    }
                } else {
                    throw "No error property";
                }
            }
        } catch (\Throwable $t) {
            $message = 
                $t->getMessage() . PHP_EOL . 
                $t->getTraceAsString() . PHP_EOL ;
        }
        $message = $message . PHP_EOL . 
                   "TIP: check the ->response and ->body property of this SAPException for more information" . PHP_EOL;
        parent::__construct($message, $errorCode);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
?>