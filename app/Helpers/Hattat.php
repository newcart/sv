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

    static function get_cities(){
            $_['ADANA']='1';
            $_['ADIYAMAN']='2';
            $_['AFYON']='3';
            $_['AĞRI']='4';
            $_['AMASYA']='5';
            $_['ANKARA']='6';
            $_['ANTALYA']='7';
            $_['ARTVİN']='8';
            $_['AYDIN']='9';
            $_['BALIKESİR']='10';
            $_['BİLECİK']='11';
            $_['BİNGÖL']='12';
            $_['BİTLİS']='13';
            $_['BOLU']='14';
            $_['BURDUR']='15';
            $_['BURSA']='16';
            $_['ÇANAKKALE']='17';
            $_['ÇANKIRI']='18';
            $_['ÇORUM']='19';
            $_['DENİZLİ']='20';
            $_['DİYARBAKIR']='21';
            $_['EDİRNE']='22';
            $_['ELAZIĞ']='23';
            $_['ERZİNCAN']='24';
            $_['ERZURUM']='25';
            $_['ESKİŞEHİR']='26';
            $_['GAZİANTEP']='27';
            $_['GİRESUN']='28';
            $_['GÜMÜŞHANE']='29';
            $_['HAKKARİ']='30';
            $_['HATAY']='31';
            $_['ISPARTA']='32';
            $_['MERSİN']='33';
            $_['İSTANBUL']='34';
            $_['İZMİR']='35';
            $_['KARS']='36';
            $_['KASTAMONU']='37';
            $_['KAYSERİ']='38';
            $_['KIRKLARELİ']='39';
            $_['KIRŞEHİR']='40';
            $_['KOCAELİ']='41';
            $_['KONYA']='42';
            $_['KÜTAHYA']='43';
            $_['MALATYA']='44';
            $_['MANİSA']='45';
            $_['KAHRAMANMARAŞ']='46';
            $_['MARDİN']='47';
            $_['MUĞLA']='48';
            $_['MUŞ']='49';
            $_['NEVŞEHİR']='50';
            $_['NİĞDE']='51';
            $_['ORDU']='52';
            $_['RİZE']='53';
            $_['SAKARYA']='54';
            $_['SAMSUN']='55';
            $_['SİİRT']='56';
            $_['SİNOP']='57';
            $_['SİVAS']='58';
            $_['TEKİRDAĞ']='59';
            $_['TOKAT']='60';
            $_['TRABZON']='61';
            $_['TUNCELİ']='62';
            $_['ŞANLIURFA']='63';
            $_['UŞAK']='64';
            $_['VAN']='65';
            $_['YOZGAT']='66';
            $_['ZONGULDAK']='67';
            $_['AKSARAY']='68';
            $_['BAYBURT']='69';
            $_['KARAMAN']='70';
            $_['KIRIKKALE']='71';
            $_['BATMAN']='72';
            $_['ŞIRNAK']='73';
            $_['BARTIN']='74';
            $_['ARDAHAN']='75';
            $_['IĞDIR']='76';
            $_['YALOVA']='77';
            $_['KARABÜK']='78';
            $_['KİLİS']='79';
            $_['OSMANİYE']='80';
            $_['DÜZCE']='81';
            return $_;
        }

}
function Hattat(){
    return Hattat::getInstance();
}
function list_limit(){
    return Hattat::$list_limit;
}
