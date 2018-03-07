<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    public $table = 'goods_cate';
//    表的主键
    public $primaryKey = 'id';

//    是否自动维护created_at和updated_at字段
    public $timestamps = false;

    public $guarded = [];
    //返回格式化的分类数据
    public function getTree()
    {
        $cates = $this->orderBy('path','asc')->get();
        return Cate::tree($cates);
    }


    //数据格式化（缩进、排序）
    public static function tree($Category,$pid=0)
    {
        //1.声明一个空数组存放格式化后的分类数据
        $arr = [];
//        2.获取所有的一级类
//        每获取一个一级类，接着获取此一级类下的二级类
        foreach($Category as $v){
            //        找一级类
            if($v['pid'] == $pid){
                //存放到arr中
                $v['type_name'] = $v['type_name'];
                $arr[] = $v;
                foreach ($Category as $m){
                    //获取此一级类下的二级类
                    if($m['pid'] == $v['id']){
                        //如果是二级类，在分类名称前添加几个空格
                        $m['type_name'] = '|----'.$m['type_name'];
                        $arr[] = $m;
                    }
                }
            }
        }



//        3. 返回格式化后的数据，即返回$arr;
        return $arr;
    }
    public function getCate()
    {
        return $this->hasMany('App\Model\Goods', 'cid')->get();
    }

}


