@extends('admin.layout.index')

@section('css')
<link rel="stylesheet" type="text/css" href="/fulei/css/page_page.css">
@endsection

@section('content')
    <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-pencil"></i> Text Inputs</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form class="mws-form" action="form_elements.html">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Text Field</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>      
                </div>      
@endsection