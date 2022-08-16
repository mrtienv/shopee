<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        $data = [];
        return view('web.category.index', $data);
    }
}
