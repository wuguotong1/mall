@extends('admin.layout.index')

@section('css')
<link rel="stylesheet" type="text/css" href="/fulei/css/page_page.css">
@endsection

@section('content')
<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-pencil"></i>{{$data['uid']}} 对 {{$data['gid']}} 商品的评价</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form class="mws-form" action="/admin/index/{{$data['id']}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">用户ID</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="id" value="{{$data['id']}}" >
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">用户名</label>
                                    <div class="mws-form-item">
                                        <input type="text" name="uname" class="large" value="{{$data['uid']}}" >
                                    </div>
                                </div>
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">商品ID</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="gid" value="{{$data['gid']}}" >
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">评论标题</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="title" value="{{$data['title']}}" >
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">评论内容</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="comment" value="{{$data['comment']}}" >
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">评论时间</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="ctime" value="{{$data['ctime']}}" >
                                    </div>
                                </div>
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">用户评价</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="rate" value="{{$data['rate']}}" >
                                    </div>
                                </div>
                                
                            </div>

                            <input type="submit" class="btn btn-info" value="修改评论">
                        </form>
                    </div>      
                </div>
@endsection