<?php

namespace App\Helpers;


class SweetAlert
{
    private function alert($title, $message, $type){
        session()->flash('alert', array(
            'title' => $title,
            'message' => $message,
            'type' => $type
        ));

    }

    function __call($type, $arguments)
    {
        $this->alert($arguments[0],$arguments[1],$type);
    }

}