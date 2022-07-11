<?php
class Hattat
{
    static $list_limit = 10;

    static function getInstance(){
        return new Hattat();
    }
    static  function response($result){
        $response = new  stdClass();
        $response->status = isset($result['status'])?$result['status']:'failure';
        if($response->status===true && $response->status===1){
            $response->status = 'success';
        }
        $response->title = isset($result['title'])?$result['title']:'';
        $response->message = isset($result['message'])?$result['message']:'';
        $response->data = isset($result['data'])?$result['data']:'';
        return response()->json($response)->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }
    static function get_table_cols($model){
        if(is_string($model)){
            $table = $model;
        } elseif (is_object($model) && method_exists($model, 'getTable')){
            $table = $model->getTable();
        } else {
            return [];
        }
        $result = [];
        $fields = \Schema::getColumnListing($table);
        if($fields){
            foreach($fields as $field){
                if(is_object($model) && isset($model->{$model})){
                    $result[$field] = $model->{$model};
                } else{
                    $result[$field] = '';
                }
            }
        }
        return $result;
    }

    static function get_pagination($pos, $total, $list_limit=false){
        if(empty($list_limit)) $list_limit = list_limit();
        $page_count = $total / $list_limit;
        $poit_count = 3;
        $pos = max(0, $pos-1);
        $ins = [];
        $outs = [];
        if($pos < $page_count){
            $pos = 0;
        }
        for($i=$pos; $i<($pos + $poit_count); $i++){
            if($i>=0 && $i<$page_count ) $merged[] = (int)$i;
        }
        //print_r([$total, $merged]);
        if($page_count>count($merged)){
            $merged[] = null;
            for($i=$total; $i>($page_count-$poit_count); $i--){
                if($i>=0 && $i<$page_count )$outs[] = (int)$i;
            }
            sort($outs);
            $merged = array_merge($merged, $outs);
        }
        /*
        sort($outs);
        $merged =  array_unique( array_merge($ins  , $outs));
        if(count($merged)>=6){
            $in = array_slice($merged, 0,3);
            $out = array_slice($merged, -3,3);

        }
        */
        return $merged;
    }
    static function get_view_comon_sections(){
        return [
            'head'=>'common.head',
            'aside'=>'common.aside',
            'navbar'=>'common.navbar',
            'footer'=>'common.footer',
            'javascripts'=>'common.javascripts',
        ];
    }
    static function get_image_url($image){
        $image = (string)$image;
        if($image){
            $image = url($image);
        } else {
            $image = url('images/not_found.png');
        }
        return $image;
    }
}
function Hattat(){
    return Hattat::getInstance();
}
function list_limit(){
    return Hattat::$list_limit;
}
