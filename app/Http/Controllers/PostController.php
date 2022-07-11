<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePanelRequest;
use App\Http\Requests\UpdatePanelRequest;
use App\Models\Post;
use App\View\Components\Datatable\BasicDatatable;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
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
        $data['breadcramps'] = 'Post/List';
        $data['title'] = 'Welcome!';
        $data['message'] = 'Welcome!';
        $data['dataTable'] = BasicDatatable::new('posts', 'api/post/list' );
        $data['dataTable']['tableTitle'] = 'List of Posts';
        $data['dataTable']['visibleCols'] = [
            'id'  => 'Id',
            'image'=>'Resim',
            'title'=>'Başlık',
            'slug'=>'SEO name',
            'author'=>'Yayıncı',
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
        $data['sections']['content'] = 'post.post-edit';
        $data['breadcramps'] = 'User/My Profile';
        $data['title'] = 'My Profile!';
        $data['message'] = 'My Profile!';
        $data['apiget'] = route('post.apiget',['id'=>0]);
        $data['apipost'] = route('post.apipost',['id'=>0]);
        return view('admin', ['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePanelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePanelRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $id)
    {
        $data['sections'] = \Hattat::get_view_comon_sections();
        $data['sections']['content'] = 'post.post-edit';
        $data['breadcramps'] = 'User/My Profile';
        $data['title'] = 'My Profile!';
        $data['message'] = 'My Profile!';
        $data['apiget'] = route('post.apiget',['id'=>$id]);
        $data['apipost'] = route('post.apipost',['id'=>$id]);
        return view('admin', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePanelRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePanelRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function actionButtons($row){
        $url = route('post.edit', ['id'=>$row['id']]);
        $html = '<span style="float: right">';
        $html .= '<span class="badge badge-sm bg-gradient-success">Online</span>';
        $html .= '<a class="btn btn-link text-dark px-3 mb-0" href="'.$url.'"><i class="material-icons text-sm me-2">edit</i></a>';
        $html .= '</span>';
        return $html;
    }
    function apiget(Request $request, $id){
        $post = Post::find($id);
        $this->setJsonResponseTitle('İşlem Sonucu');
        if(empty($post)){
            $post = \Hattat::get_table_cols('posts');
            if(empty($id)){
                $this->setJsonResponseStatus('success');
            } else {
                $this->setJsonResponseStatus('error');
                $this->setJsonResponseMessage('Kayıt silinmiş veya kaybolmuş olabilir.');
            }
        } else{
            $this->setJsonResponseStatus('success');
        }
        $this->setJsonResponseData($post);
        return $this->jsonResponse;
    }
    function apipost(StorePanelRequest $request, $id){
        try{
            $this->setJsonResponseTitle('İşlem Sonucu');
            $fields = $request->get('fields', []);
            if($fields['id']){
                $post = Post::find($fields['id']);
                if(empty($post)){
                    $post = new Post();
                    $this->setJsonResponseMessage('Post Tekrar Oluşturuldu');
                } else {
                    $this->setJsonResponseMessage('Post Kaydedildi');
                }
            } else{
                $post = new Post();
                $this->setJsonResponseMessage('Post Oluşturuldu');
            }
            $post->title = $fields['title'];
            $post->slug = $fields['slug'];
            $post->content = $fields['content'];
            $post->image = $fields['image'];
            $post->slug = $fields['slug'];
            $post->author = \Auth::id();
            $post->save();
            $this->setJsonResponseStatus('success');
            $this->setJsonResponseData($post);
        } catch (\Exception $ex){
            $this->setJsonResponseStatus('error');
            $this->setJsonResponseMessage($ex->getMessage());
            $fields = \Hattat::get_table_cols('posts');
            $this->setJsonResponseData($fields);
        }
        return $this->jsonResponse;
    }
    function apilist(Request $request, Post $post){
        $page = $request->get('page', 0);
        $page = max(0, $page);
        $query = $post->skip(list_limit() * $page)->take(list_limit())->get();
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
            $result['data']['pages'] = \Hattat::get_pagination($page, $post->count(), list_limit()) ;
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
}
