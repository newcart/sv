<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $jsonResponse = [
        'status'=>'',
        'title'=>'',
        'message'=>''
    ];

    public function setJsonResponseStatus($value){
        $this->jsonResponse['status'] = $value;
    }
    public function setJsonResponseTitle($value){
        $this->jsonResponse['title'] = $value;
    }
    public function setJsonResponseMessage($value){
        $this->jsonResponse['message'] = $value;
    }
    public function setJsonResponseData($value){
        $this->jsonResponse['fields'] = $value;
    }
}
