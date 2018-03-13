@extends('admin.layout.index')

@section('css')
<link rel="stylesheet" type="text/css" href="/fulei/css/page_page.css">
@endsection

@section('content')
<table class="layui-table">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">用户 {{$data['id']}} 对 {{$data['gid']}} 商品的评价</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">评论ID</th>
                        <td><span id="lbServerName">{{$data['id']}}</span></td>
                    </tr>

                     <tr>
                        <th width="30%">用户名</th>
                        <td><span id="lbServerName">{{$data['uid']}}</span></td>
                    </tr>

                     <tr>
                        <th width="30%">商品ID</th>
                        <td><span id="lbServerName">{{$data['gid']}}</span></td>
                    </tr>

                     <tr>
                        <th width="30%">评论标题</th>
                        <td><span id="lbServerName">{{$data['title']}}</span></td>
                    </tr>

                     <tr>
                        <th width="30%">评论内容</th>
                        <td><span id="lbServerName">{{$data['comment']}}</span></td>
                    </tr>

                     <tr>
                        <th width="30%">评论时间</th>
                        <td><span id="lbServerName">{{$data['updated_at']}}</span></td>
                    </tr>

                     <tr>
                        <th width="30%">用户评价</th>
                        <td><span id="lbServerName">{{$data['rate']}}</span></td>
                    </tr>
                    
                </tbody>
            </table>
            <form action="{{ url('/admin/index/create') }}" method="GET" class="mws-form">
                    <input type="hidden" name="id" value="{{$data['id']}}"></input>
                    <div class="mws-form-row">
                        <label class="mws-form-label">回复评论:</label>
                        <div class="mws-form-item">
                            <input type="text" class="large" name="reply" placeholder="对该评论进行回复" style="height: 60px;width:500px"><br><br>
                            <input type="submit" class="layui-btn layui-btn-info"  value="回复评论">
                        </div>
                    </div>
            </form>
@endsection