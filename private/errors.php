<?php

class APIError extends Exception
{
    public static $API_ERROR = 422;
    public static $BAD_PARAMETER = 400;
    public static $DATABASE_ERROR = 503;
    public static $INVALID_CREDENTIALS = 403;
    public static $UNAUTHORISED = 401;
    public static $SERVER_ERROR = 401;
    public function die()
    {
        $HEADERS = [
            422 => "API Error",
            400 => "Bad Request",
            503 => "Database Error",
            403 => "Invalid Credentials",
            401 => "Unathorised Operation",
        ];
        $code = $this->getCode();
        if ($code < 400 || $code > 599) {
            $code = 500;
        }
        $header = "Internal Server Error";
        if (array_key_exists($code, $HEADERS)) {
            $header = $HEADERS[$code];
        }
        header($header,true, $code);
        die($this->getMessage() or "Unknown Error");
    }
}

?>