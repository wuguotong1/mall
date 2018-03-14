<?php

namespace App\Http\Controllers\Home;

use App\Model\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index($id)
    {
        $data = Goods::find($id);
        return view('home.goods.good',compact('data'));
    }
}
