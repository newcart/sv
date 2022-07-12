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
    public function liste($end_point, $page, $limit=100){
        //'0/store/list'
        $response = \Http::withHeaders([
            'User-Agent' =>  $this->get_user_agent()
        ])->withOptions([
            'debug' => false,
        ])->withBasicAuth(
            env('API_NAME'), env('API_PASS')
        )->post( env('API_URL').$end_point, ['page'=>$page, 'limit'=>$limit]);
        return $response->json();
    }
    public function getir($end_point, $data){
        //'0/store/info'
        $response = \Http::withHeaders([
            'User-Agent' =>  $this->get_user_agent()
        ])->withOptions([
            'debug' => false,
        ])->withBasicAuth(
            env('API_NAME'), env('API_PASS')
        )->post( env('API_URL').$end_point, $data);

        return $response->json();
    }
    public function kaydet($end_point, $data){
        // '0/store/save'
        $response = \Http::withHeaders([
            'User-Agent' =>  $this->get_user_agent()
        ])->withOptions([
            'debug' => false,
        ])->withBasicAuth(
            env('API_NAME'), env('API_PASS')
        )->post( env('API_URL').$end_point, $data);
        return $response->json();
    }
    private function get_user_agent(){
        return 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36';
    }
}
