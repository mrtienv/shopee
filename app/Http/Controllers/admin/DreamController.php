<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Redirect;
use App\Models\Dream;
use Illuminate\Support\Facades\Auth;

class DreamController extends Controller
{
    public function __construct()
    {

    }

    public function index() {
        $limit = 10;
        $count = Dream::count();
        $pagination = (int) ceil($count/$limit);
        #
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        #
        $condition = [];
        if (!empty($_GET['keyword'])) {
            $data['keyword'] = $_GET['keyword'];
            $condition[] = ['slug', 'LIKE', '%'.toSlug($_GET['keyword']).'%'];
        }
        #
        $data['listItem'] = Dream::where($condition)->orderBy('id', 'DESC')->offset(($page-1)*$limit)->limit($limit)->get();
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        return view('admin.dream.index', $data);
    }

    public function update($id = 0) {
        $data = [];
        $data['user_id'] = Auth::id();

        if ($id > 0) {
            $data['oneItem'] = $oneItem = Dream::findOrFail($id);
        }
        if (!empty($post_data = Request::post())) {
            $post_data['user_id'] = $data['user_id'];
            $post_data['slug'] = toSlug($post_data['title']);
            Dream::updateOrInsert(['id' => $id], $post_data);

            return Redirect::to('/admin/dream?1');
        }
        return view('admin.dream.update', $data);
    }

    public function delete($id) {
        Dream::destroy($id);
        return back();
    }
}
