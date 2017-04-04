<?php

use App\Helpers\SweetAlert;

function alert($title = '',$message = ''){

    $alert = new SweetAlert();

    if($title !== ''){
        $alert->success($title,$message);
    }

    return $alert;
}