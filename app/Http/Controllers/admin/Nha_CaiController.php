<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\Nha_Cai;

class Nha_CaiController extends Controller
{
    public function __construct()
    {

    }

    public function index($type = 1) {
        if (empty($type) || $type > 6) return Redirect::to('/');
        $data['type'] = $type;
        $data['listItem'] = Nha_Cai::where('type', $type)->orderBy(Nha_Cai::raw('order_by = 0'))->orderBy('order_by')->get();
        return view('admin.nha_cai.index', $data);
    }

    public function update($type = 1, $id = 0) {
        if (empty($type) || $type > 6) return Redirect::to('/');
        if ($id > 0) {
            $oneItem = Nha_Cai::findOrFail($id);
            $data = json_decode($oneItem->content, 1);
            $data['oneItem'] = $oneItem;
        }
        $data['arr_type'] = [
            '1' => 'Top 10 nhà cái up tín nhất Việt Nam',
            '2' => 'Top 5 nhà cái tặng tiền cược miễn phí',
            '3' => 'Top 5 game bài nhiều người chơi nhất',
            '5' => 'Chuyên mục Game bài đổi thưởng',
            '6' => 'Chuyên mục Bắn cá đổi thưởng',
        ];
        $data['type'] = $type;
        if (!empty(Request::post())) {
            $post_data['content'] = json_encode(Request::post()['content']);
            $post_data['type'] = $type;
            $post_data['name'] = Request::post()['name'];
            $post_data['order_by'] = Request::post()['order_by'];
            $post_data['post_id'] = null;
            if (!empty(Request::post()['content']['link_review'])) {
                $link_review = Request::post()['content']['link_review'];
                preg_match('/-p([0-9]+?).html/', $link_review, $item);
                if (!empty($item[1])) $post_data['post_id'] = $item[1];
            }
            Nha_Cai::updateOrInsert(['id' => $id], $post_data);
            return Redirect::to('/admin/nha_cai/'.$type);
        }
        return view('admin.nha_cai.update', $data);
    }

    public function delete($id) {
        Nha_Cai::destroy($id);
        return back();
    }
}
