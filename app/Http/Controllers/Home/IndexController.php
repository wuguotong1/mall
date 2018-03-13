<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Carousel;
use App\Model\Recommend;
use App\Model\Link;
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
        //友情链接
        $link = Link::where('status','1')->orderBy('sort','asc')->get();
        //加载模板
        return view('Home.index',['carousel'=>$carousel,'recom'=>$recom,'link'=>$link]);
    }
}
