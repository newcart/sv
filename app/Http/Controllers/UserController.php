<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePanelRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\View\Components\Datatable\BasicDatatable;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->liste();
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'post.post-index';
        $data['breadcramps'] = 'User/List';
        $data['title'] = 'Welcome!';
        $data['message'] = 'Welcome!';
        $data['dataTable'] = BasicDatatable::new('users', 'api/user/list' );
        $data['dataTable']['tableTitle'] = 'List of Users';
        $data['dataTable']['visibleCols'] = [
            'id'  => 'Id',
            'name'=>'İsim',
            'email'=>'Email',
            'actions'=>'İşlemler',
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
        $data['sections']['content'] = 'user.user-edit';
        $data['breadcramps'] = 'User/New User';
        $data['title'] = 'New User!';
        $data['message'] = 'New User!';
        $data['apiget'] = route('user.apiget',['id'=>0]);
        $data['apipost'] = route('user.apipost',['id'=>0]);
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
        $data['sections']['content'] = 'user.user-edit';
        $data['breadcramps'] = 'User/My Profile';
        $data['title'] = 'My Profile!';
        $data['message'] = 'My Profile!';
        $user = auth()->user();
        $data['apiget'] = route('user.apiget',['id'=>$user->id]);
        $data['apipost'] = route('user.apipost',['id'=>$user->id]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'user.user-edit';
        $data['breadcramps'] = 'User/User Profile';
        $data['title'] = 'User Profile!';
        $data['message'] = 'User Profile!';
        $data['apiget'] = route('user.apiget',['id'=>$id]);
        $data['apipost'] = route('user.apipost',['id'=>$id]);
        return view('admin', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function apiget(Request $request, $id){

            $user = User::find($id);
            $this->setJsonResponseTitle('İşlem Sonucu');
            if(empty($user)){
                $user = \Hattat::get_table_cols('users');
                if(empty($id)){
                    $this->setJsonResponseStatus('success');
                } else {
                    $this->setJsonResponseStatus('error');
                    $this->setJsonResponseMessage('Kayıt silinmiş veya kaybolmuş olabilir.');
                }
            } else{
                $this->setJsonResponseStatus('success');
            }

        $this->setJsonResponseData($user);
        return $this->jsonResponse;
    }

    public function apipost(Request $request, $id){
        try{
            $this->setJsonResponseTitle('İşlem Sonucu');
            $fields = $request->get('fields', []);
            if(isset($fields['id'])){
                $user = User::find($fields['id']);
                if(empty($user)){
                    $user = new User();
                    $this->setJsonResponseMessage('Kullanıcı Tekrar Oluşturuldu');
                } else {
                    $this->setJsonResponseMessage('Kullanıcı Kaydedildi');
                }
            } else{
                $user = new User();
                $this->setJsonResponseMessage('Kullanıcı Oluşturuldu');
            }
            $user->name = $fields['name'];
            $user->email = $fields['email'];
            $user->password = $fields['password'];
            $user->save();
            $this->setJsonResponseStatus('success');
            $this->setJsonResponseData($user);
        } catch (\Exception $ex){
            $this->setJsonResponseStatus('error');
            $this->setJsonResponseMessage($ex->getMessage());
            $fields = \Hattat::get_table_cols('posts');
            $this->setJsonResponseData($fields);
        }
        return $this->jsonResponse;
    }

    public function apilist(Request $request, User $user){
        $page = $request->get('user', 0);
        $page = max(0, $page);
        $query = $user->skip(list_limit() * $page)->take(list_limit())->get();
        if($query->count()){
            foreach ($query->all() as $key=>$row){
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
        $url = route('user.edit', ['id'=>$row['id']]);
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
        )->get( 'localhost:3000/1/trendyol/service_test');
        print_r($response->body());
    }
}
