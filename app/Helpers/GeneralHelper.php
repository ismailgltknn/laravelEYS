<?php
function vd($mixed){
    if ($mixed) {
        var_dump('<pre>'. var_dump($mixed) . '</pre>');
        exit;
    }else{
        var_dump($mixed);exit;
    }
}