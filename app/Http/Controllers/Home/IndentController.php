<?php

namespace App\Http\Controllers\Home;

use App\Model\Indent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 1;
        $data = Indent::where('uid',$id)->get();
        return view('home.user.indent',compact('data'));
    }


}
