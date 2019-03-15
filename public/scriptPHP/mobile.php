<?php

function detection_mobile()
{
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']))
        return true;
    
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        $accept = strtolower($_SERVER['HTTP_ACCEPT']);
        if (strpos($accept, 'wap') !== false)
            return true;
    }
    
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false)
            return true;
        
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false)
            return true;
    }
    
    return false;
}


