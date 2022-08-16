<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
class PostController extends Controller
{
    public function index($slug, $id) {
        $oneItem = Post::findOrFail($id);
        if ($oneItem->slug != $slug) return Redirect::to(getUrlPost($oneItem), 301);
        if ($oneItem->status == 0 || strtotime($oneItem->displayed_time) > time()) return Redirect::to('/');
        $oneItem->content = $this->parse_content($oneItem->content);
        $data['oneItem'] = $oneItem;
        $data['category'] = $category = Category::find($oneItem->category_id);
        if (!empty($oneItem->optional))
            $data['optional'] = json_decode($oneItem->optional);

        $breadCrumb = [];

        $breadCrumb[] = [
            'name' => 'Trang chủ',
            'item' => url('/'),
            'schema' => false,
            'show' => true
        ];

        $breadCrumb[] = [
            'name' => $category->title,
            'item' => getUrlCate($category),
            'schema' => false,
            'show' => true
        ];
        $breadCrumb[] = [
            'name' => $oneItem->title,
            'item' => getUrlPost($oneItem),
            'schema' => true,
            'show' => false
        ];

        $data['schema'] = getSchemaBreadCrumb($breadCrumb).getSchemaNewsArticle($oneItem);

        //$data['tag'] = Post_tag::leftjoin('tag', 'tag_id', '=', 'id')->where('post_id', $id)->get();
        $data['related_post'] = Post::where(['status' => 1, 'category_id' => $oneItem->category_id, ['displayed_time', '<=', Post::raw('NOW()')], ['id', '<>', $id]])->orderBy('displayed_time', 'DESC')->limit(12)->get();
        $data['seo_data'] = initSeoData($oneItem, 'post');

        $data['author'] = User::where('id',$oneItem->user_id)->first();
        return view('web.post.index', $data);
    }
    private function parse_content($content) {
        $content = str_replace('<img', '<img loading="lazy"', $content);
        $content = tableOfContent($content);
        return $content;
    }
}
