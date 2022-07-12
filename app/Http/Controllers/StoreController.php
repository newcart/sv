<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePanelRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\View\Components\Datatable\BasicDatatable;
use Illuminate\Foundation\Http\FormRequest;
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
        $data['sections']['content'] = 'post.post-index';
        $data['breadcramps'] = 'Store/List';
        $data['title'] = 'Welcome!';
        $data['message'] = 'Welcome!';
        $data['dataTable'] = [];
        $data['dataTable']['tableTitle'] = 'List of Stores';
        $data['dataTable']['visibleCols'] = [
            'store_id'   =>'Store Id',
            'store_code' =>'Store Code',
            'store_name' =>'Name',
            'address'    =>'Address',
            'town_id'    =>'Town',
            'city_id'    =>'City',
            'country_id' =>'Country',
            'tax_number' =>'Tax Number',
            'tax_office' =>'Tax Office',
            'email'      =>'Email',
            'mobile'     =>'Mobile Phone',
            'telephone'  =>'Phone',
            'status'     =>'Status',
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myprofile()
    {
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'store.store-edit';
        $data['breadcramps'] = 'Store/My Profile';
        $data['title'] = 'My Profile!';
        $data['message'] = 'My Profile!';
        $user = auth()->user();
        $data['apiget'] = route('store.apiget',['id'=>$user->id]);
        $data['apipost'] = route('store.apipost',['id'=>$user->id]);
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
     * @param  \App\Models\Store  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Store $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $user, $id)
    {
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'store.store-edit';
        $data['breadcramps'] = 'Store/Store Profile';
        $data['title'] = 'Store Profile!';
        $data['message'] = 'Store Profile!';
        $data['apiget'] = route('store.apiget',['id'=>$id]);
        $data['apipost'] = route('store.apipost',['id'=>$id]);
        return view('admin', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\Store  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, Store $user)
    {
        $data = $request->all();
        $user::where('id', $data['id'])
            ->update($data);
        $this->setJsonResponseStatus('success');
        $this->setJsonResponseTitle('İşlem Sonucu');
        $this->setJsonResponseMessage('Kullanıcı Kaydedildi');
        return $this->jsonResponse;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $user)
    {
        //
    }

    public function apiget(Request $request, $id){
        $response =$this->getir($id);
        $this->setJsonResponseTitle('İşlem Sonucu');
        if(isset($response['data']) && isset($response['data']['id'])){
            $this->setJsonResponseStatus('success');
            $user = $response['data'];
        } else{
            $user =  [
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
            if(empty($id)){
                $this->setJsonResponseStatus('success');
            } else {
                $this->setJsonResponseStatus('error');
                $this->setJsonResponseMessage('Kayıt silinmiş veya kaybolmuş olabilir.');
            }
        }
        $this->setJsonResponseData($user);
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
            $response = $this->kaydet($store);
            if(isset($response['data']) && array_key_exists('store_id', $response['data'])){
                if($response['status']=='success'){
                    $this->setJsonResponseStatus('success');
                    $this->setJsonResponseData($response['data']);
                } else{
                    $this->setJsonResponseStatus('success');
                    $this->setJsonResponseMessage($response['message']);
                }
            } else {
                $this->setJsonResponseStatus('success');
                $this->setJsonResponseData($store);
            }
        } catch (\Exception $ex){
            $this->setJsonResponseStatus('error');
            $this->setJsonResponseMessage($ex->getMessage());
            $fields = \Hattat::get_table_cols('posts');
            $this->setJsonResponseData($fields);
        }
        return $this->jsonResponse;
    }

    public function apilist(Request $request, Store $user){
        $page = $request->get('user', 0);
        $page = max(0, $page);
        $response = $this->liste();
        //$query = $user->skip(list_limit() * $page)->take(list_limit())->get();
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
            $result['data']['pages'] = \Hattat::get_pagination($page, $user->count(), list_limit()) ;
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
        $url = route('store.edit', ['id'=>$row['id']]);
        $html = '<span style="float: right">';
        $html .= '<span class="badge badge-sm bg-gradient-success">Online</span>';
        $html .= '<a class="btn btn-link text-dark px-3 mb-0" href="'.$url.'"><i class="material-icons text-sm me-2">edit</i></a>';
        $html .= '</span>';
        return $html;
    }

    private function liste(){
        $response = \Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'
        ])->withOptions([
            'debug' => false,
        ])->withBasicAuth(
            'supervisor', 'TiJgxQE2t5LluwHT'
        )->post( 'localhost:3000/0/store/list',['page'=>0, 'limit'=>100]);
        return $response->json();
    }

    private function getir($id){
        $response = \Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'
        ])->withOptions([
            'debug' => false,
        ])->withBasicAuth(
            'supervisor', 'TiJgxQE2t5LluwHT'
        )->post( 'localhost:3000/0/store/info',['id'=>$id]);
        return $response->json();
    }
    private function kaydet($store){
        $response = \Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'
        ])->withOptions([
            'debug' => false,
        ])->withBasicAuth(
            'supervisor', 'TiJgxQE2t5LluwHT'
        )->post( 'localhost:3000/0/store/save',$store);
        return $response->json();
    }
}
