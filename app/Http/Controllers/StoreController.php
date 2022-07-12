<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\View\Components\Datatable\BasicDatatable;
use Symfony\Component\HttpFoundation\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'store.store-index';
        $data['breadcramps'] = 'Store/List';
        $data['title'] = 'Welcome!';
        $data['message'] = 'Welcome!';
        $data['dataTable'] = BasicDatatable::new('api/store/list', $this->getFields() );

        $data['dataTable']['tableTitle'] = 'List of Stores';
        $data['dataTable']['visibleCols'] = [
            'store_id'   =>'Store Id',
            'store_code' =>'Store Code',
            'store_name' =>'Name',
            'city_id'    =>'City',
            'country_id' =>'Country',
            'email'      =>'Email',
            'mobile'     =>'Mobile Phone',
            'telephone'  =>'Phone',
            'status'     =>'Status',
            'actions'    =>'İşlemler',
        ];
        return view('admin', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'store.store-edit';
        $data['breadcramps'] = 'Store/New Store';
        $data['title'] = 'New Store!';
        $data['message'] = 'New Store!';
        $data['apiget'] = route('store.apiget',['id'=>0]);
        $data['apipost'] = route('store.apipost',['id'=>0]);
        return view('admin', ['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'store.store-edit';
        $data['breadcramps'] = 'Store/Edit Store';
        $data['title'] = 'Edit Store!';
        $data['message'] = 'Edit Store!';
        $data['apiget'] = route('store.apiget',['id'=>$id]);
        $data['apipost'] = route('store.apipost',['id'=>$id]);
        return view('admin', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, Store $store)
    {
        $data = $request->all();
        $store::where('id', $data['id'])
            ->update($data);
        $this->setJsonResponseStatus('success');
        $this->setJsonResponseTitle('İşlem Sonucu');
        $this->setJsonResponseMessage('Kullanıcı Kaydedildi');
        return $this->jsonResponse;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }

    public function apiget(Request $request, $id){
        $end_point = '0/store/info';
        $response =$this->getir($end_point, ['store_id'=>$id]);
        $this->setJsonResponseTitle('İşlem Sonucu');
        if(isset($response['data']) && isset($response['data']['store_id'])){
            $this->setJsonResponseStatus('success');
            $store = $response['data'];
        } else{
            $store =  $this->getFields();
            if(empty($id)){
                $this->setJsonResponseStatus('success');
            } else {
                $this->setJsonResponseStatus('error');
                $this->setJsonResponseMessage('Kayıt silinmiş veya kaybolmuş olabilir.');
            }
        }
        $this->setJsonResponseData($store);
        return $this->jsonResponse;
    }

    public function apipost(Request $request, $id){
        try{
            $this->setJsonResponseTitle('İşlem Sonucu');
            $fields = $request->get('fields', []);
            $store['store_id'] = $fields['store_id'];
            $store['store_code'] = $fields['store_code'];
            $store['store_name'] = $fields['store_name'];
            $store['address'] = $fields['address'];
            $store['town_id'] = $fields['town_id'];
            $store['city_id'] = $fields['city_id'];
            $store['country_id'] = $fields['country_id'];
            $store['tax_number'] = $fields['tax_number'];
            $store['tax_office'] = $fields['tax_office'];
            $store['email'] = $fields['email'];
            $store['mobile'] = $fields['mobile'];
            $store['telephone'] = $fields['telephone'];
            $store['status'] = $fields['status'];
            $end_point = '0/store/save';
            $response = $this->kaydet($end_point, $store);

            if(isset($response['data']) && array_key_exists('store_id', $response['data'])){
                if($response['status']=='success'){
                    $this->setJsonResponseStatus('success');
                    $this->setJsonResponseData($response['data']);
                } else{
                    $this->setJsonResponseStatus('failure');
                }
            } else {
                $this->setJsonResponseStatus('failure');
                $this->setJsonResponseData($store);
            }
            $this->setJsonResponseMessage($response['message']);
        } catch (\Exception $ex){
            $this->setJsonResponseStatus('error');
            $this->setJsonResponseMessage($ex->getMessage());
            $fields = \Hattat::get_table_cols('posts');
            $this->setJsonResponseData($fields);
        }
        return $this->jsonResponse;
    }

    public function apilist(Request $request){

        $page = $request->get('user', 0);
        $page = max(0, $page);
        $end_point = '0/store/list';
        $response = $this->liste($end_point, $page);

        if(isset($response['data']) && isset($response['data']['items'])){
            foreach ($response['data']['items'] as $key=>$row){
                $row['image'] = '<div class="avatar-group mt-2">
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Elena Morison">
                        <img alt="Image placeholder" src="'.\Hattat::get_image_url($row['image']).'">
                    </a>
                </div>';
                $row['actions'] = $this->actionButtons($row);
                $result['data']['rows'][] = $row;
            }
            $result['status'] = 'success';
            //$result['data']['rows'] = $query->all();
            $result['data']['page'] = $page;
            $result['data']['pages'] = \Hattat::get_pagination($page, $response['data']['count'], list_limit()) ;
        } else{
            $result['status'] = 'failure';
            $result['title'] = 'Kayıt Bulunamadı';
            $result['message'] = 'Kayıt silinmiş veya değiştirilmiş olabilir';
        }
        if($page==10){
            $result['title'] = '2. Sayfa';
            $result['message'] = 'Özel mesaj veren sayfa. 2. sayfa ama pozisyonu 1';
        }
        return \Hattat::response($result);
    }

    public function actionButtons($row){
        $url = route('store.edit', ['id'=>$row['store_id']]);
        $html = '<span style="float: right">';
        $html .= '<a class="btn btn-link text-dark px-3 mb-0" href="'.$url.'"><i class="material-icons text-sm me-2">edit</i></a>';
        $html .= '</span>';
        return $html;
    }

    private function getFields(){
        return  [
            'store_id'   =>'',
            'store_code' =>'',
            'store_name' =>'',
            'address'    =>'',
            'town_id'    =>'',
            'city_id'    =>'',
            'country_id' =>'',
            'tax_number' =>'',
            'tax_office' =>'',
            'email'      =>'',
            'mobile'     =>'',
            'telephone'  =>'',
            'status'     =>'',
        ];

    }
}
