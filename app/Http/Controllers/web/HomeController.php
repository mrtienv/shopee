<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Nha_Cai;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {
        $data = [];
        return view('web.home.index', $data);
    }
}
