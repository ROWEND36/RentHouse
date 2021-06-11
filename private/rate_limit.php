<?php
    function rateLimit($filename,$rate_seconds){
        $file = fopen($filename,"c+");
        if(flock($file,LOCK_EX|LOCK_NB)){
            $time = intval(fread($file,20));
            echo($time ." next access time");
            $current_time = time();
            if($time<$current_time){
                fwrite($file,strval($current_time+$rate_seconds));
                flock($file,LOCK_UN);
                fclose($file);
                return true;
            }
        }
        flock($file,LOCK_UN);
        fclose($file);
        return false;
    }
?>