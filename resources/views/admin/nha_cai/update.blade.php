@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} Nhà cái</strong> ( {{$arr_type[$type]}} )</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tên nhà cái</label>
                                                <input class="form-control" required name="name" value="{{!empty($oneItem->name) ? $oneItem->name : ''}}" type="text" placeholder="Tên nhà cái">
                                            </div>
                                            @if($type == 1)
                                                <div class="form-group">
                                                    <label>Khuyến mãi</label>
                                                    <textarea class="form-control" name="content[khuyen_mai]" rows="4" placeholder="Khuyến mãi">{{!empty($khuyen_mai) ? $khuyen_mai : ''}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Link cược ngay</label>
                                                    <input class="form-control" name="content[link]" value="{{!empty($link) ? $link : ''}}" type="text" placeholder="Link cược ngay">
                                                </div>
                                                <div class="form-group">
                                                    <label>Link xem review</label>
                                                    <input class="form-control" name="content[link_review]" value="{{!empty($link_review) ? $link_review : ''}}" type="text" placeholder="Link xem review">
                                                </div>
                                            @elseif ($type == 2)
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <input class="form-control" name="content[description]" value="{{!empty($description) ? $description : ''}}" type="text" placeholder="Mô tả">
                                                </div>
                                                <div class="form-group">
                                                    <label>Link cược ngay</label>
                                                    <input class="form-control" name="content[link_bet]" value="{{!empty($link_bet) ? $link_bet : ''}}" type="text" placeholder="Link cược ngay">
                                                </div>
                                                <div class="form-group">
                                                    <label>Link xem review</label>
                                                    <input class="form-control" name="content[link_review]" value="{{!empty($link_review) ? $link_review : ''}}" type="text" placeholder="Link xem review">
                                                </div>
                                            @elseif ($type == 3)
                                                <div class="form-group">
                                                    <label>Số người chơi</label>
                                                    <input class="form-control" name="content[count]" value="{{!empty($count) ? $count : ''}}" type="text" placeholder="Số người chơi">
                                                </div>
                                                <div class="form-group">
                                                    <label>Link tải ngay</label>
                                                    <input class="form-control" name="content[link]" value="{{!empty($link) ? $link : ''}}" type="text" placeholder="Link tải ngay">
                                                </div>
                                            @elseif ($type == 5 || $type == 6)
                                                <div class="form-group">
                                                    <label>Mô tả</label>
                                                    <input class="form-control" name="content[description]" value="{{!empty($description) ? $description : ''}}" type="text" placeholder="Mô tả">
                                                </div>
{{--                                            Bỏ lượt bình chọn sau có thể thêm lại--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Lượt bình chọn</label>--}}
{{--                                                    <input class="form-control" name="content[count]" value="{{!empty($count) ? $count : ''}}" type="text" placeholder="Lượt bình chọn">--}}
{{--                                                </div>--}}
                                                <div class="form-group">
                                                    <label>Link nhận gift code</label>
                                                    <input class="form-control" name="content[link_gift_code]" value="{{!empty($link_gift_code) ? $link_gift_code : ''}}" type="text" placeholder="Link nhận gift code">
                                                </div>
                                                <div class="form-group">
                                                    <label>Link chơi ngay</label>
                                                    <input class="form-control" name="content[link_play]" value="{{!empty($link_play) ? $link_play : ''}}" type="text" placeholder="Link chơi ngay">
                                                </div>
                                                <div class="form-group">
                                                    <label>Link xem review</label>
                                                    <input class="form-control" name="content[link_review]" value="{{!empty($link_review) ? $link_review : ''}}" type="text" placeholder="Link xem review">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header"><strong>Thông tin khác</strong></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Logo nhà cái</label>
                                        @if(!empty($logo))
                                            <img src="{{$logo}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @else
                                            <img src="{{url('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" id="hd_img" name="content[logo]" value="{{!empty($logo) ? $logo: ''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Link Logo</label>
                                        <input class="form-control" name="content[link_logo]" value="{{!empty($link_logo) ? $link_logo: ''}}" type="text" placeholder="Link Logo">
                                    </div>
                                    <div class="form-group">
                                        <label>Thứ tự</label>
                                        <input class="form-control" name="order_by" value="{{!empty($oneItem->order_by) ? $oneItem->order_by : 0}}" type="number" placeholder="Thứ tự" min="0">
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary">Lưu trữ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
