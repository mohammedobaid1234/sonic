@extends('layouts.app')
@section('css')
    
@endsection
@section('content')
<div class="row">
    @if (\Auth::user()->hasRole('super_admin'))
    <div class="col-sm-6" style="max-height: 300px; overflow:scroll">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">
                    <i class="ace-icon fa fa-comment blue"></i>
                    {{__('Messages For Admin')}}
                </h4>
            </div>
    
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <div class="dialogs">
                        @foreach ($contact_us as $item)
                        <div class="itemdiv dialogdiv" >
                            <div class="user">
                                <img alt="Alexa's Avatar" src="{{asset('/public/assets/images/avatars/avatar2.png')}}" />
                            </div>
    
                            <div class="body">
                                @if ($item->is_read == 2)
                                <i class="ace-icon fa fa-check-square-o"></i>
                                @else
                                <i class="ace-icon fa  fa-square-o"></i>
                                @endif
                                <div class="time">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span class="green">{{$item->created_at}}</span>
                                </div>
    
                                <div class="name">
                                    {{__('Name')}}: {{$item->name}}|
                                    {{__('Email')}}: {{$item->email}} |
                                    {{__('Mobile Number')}}: {{$item->mobile_no}}
                                </div>
                                <div class="text" style="max-height: 40px; overflow:hidden">{{$item->content}}</div>
                                <div class="tools">
                                    <a href="{{route('contact_us.reply', $item->id)}}" class="btn btn-minier btn-info">
                                        <i class="icon-only ace-icon fa fa-share"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </div>
    
                    
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div>
    </div>
    @endif
</div>

@endsection

