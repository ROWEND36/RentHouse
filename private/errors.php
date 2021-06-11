<?php
$HEADERS = [
    403=>"API Error",
    406=>"Invalid Credentials",
    407=>"Unathorised Operation",
    409=>"Bad Parameter",
    410=>"Database Error"
    ];
class APIError extends Exception
{
    public static $BAD_PARAMETER = 409;
    public static $INVALID_CREDENTIALS = 406;
    public static $UNAUTHORISED = 407;
    public static $DATABASE_ERROR = 410;
    public static $API_ERROR = 403;
    public function die()
    {
        if($this->$code<400 || $this->$code>599){
            $this->$code = 500;
        }
        $header = "Internal Server Error";
        if(array_key_exists($this->$code,$HEADERS)){
            $header = $HEADERS[$this->$code];
        }
        header($header,$this->$code);
        die($this->$message);
    }
}

?>