<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Carousel;
use App\Model\Recommend;
class IndexController extends Controller
{
    /**
     * 加载首页
     * @param
     * 
     */
    public function index()
    {
        //推荐位
        $recom = Recommend::where('status','1')->orderBy('sort','asc')->get();
        //轮播图
        $carousel = Carousel::where('status','1')->get();
        return view('Home.index',['carousel'=>$carousel,'recom'=>$recom]);
    }
}
