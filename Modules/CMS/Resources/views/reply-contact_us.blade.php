@extends('layouts.app')
@section('content')
<form id="target" action="{{route('roles.store')}}" method="post" class="form-horizontal">
    @csrf

    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> {{_('Username')}} </div>

            <div class="profile-info-value">
                <span class="editable" id="username">{{$type->name}}</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> {{__('Email')}}</div>

            <div class="profile-info-value">
                <span class="editable" id="age">{{$type->email}}</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> {{__('Mobile Number')}} </div>

            <div class="profile-info-value">
                <span class="editable" id="signup">{{$type->mobile_no}}</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> {{__('Created At')}} </div>

            <div class="profile-info-value">
                <span class="editable" id="login">{{$type->created_at}}</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> {{__('Content')}}</div>

            <div class="profile-info-value">
                <span class="editable" id="about">{{$type->content}}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <h4 class="header  clearfix">
                {{__('Reply For Message')}}
                <span class="block pull-right">
                    <span class="btn-toolbar inline middle no-margin">
                        <span data-toggle="buttons" class="btn-group no-margin">
                            <label class="btn btn-sm btn-yellow">
                                1
                                <input type="radio" value="1" />
                            </label>

                            <label class="btn btn-sm btn-yellow active">
                                2
                                <input type="radio" value="2" />
                            </label>

                            <label class="btn btn-sm btn-yellow">
                                3
                                <input type="radio" value="3" />
                            </label>

                            <label class="btn btn-sm btn-yellow">
                                4
                                <input type="radio" value="4" />
                            </label>
                        </span>
                    </span>
                </span>
            </h4>

            <div class="wysiwyg-editor" data-data="editor1" id="editor1">{{$type->reply_msg}}</div>

            <div class="hr hr-double dotted"></div>

        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input id="btn-submit" value="{{__('Add')}}" type="submit" class="btn btn-primary" >
        </div>
    </div>
</form>
@endsection
@section('js')
<script>$id = {{$type->id}}</script>

<script>
    $.ajax({
       url: $("meta[name='BASE_URL']").attr("content") + '/admin/contact_us/' + $id,
       type: 'get',
   })
   .done(function(response) {
       $('#editor1').html(response.reply_msg);
   })
   
</script>
<script>
    

    $("#btn-submit").on('click', function(event){
    event.preventDefault();
    var $this = $(this).closest('form');
    var buttonText = $this.find('button:submit').text();
    data = {
        _token: $("meta[name='csrf-token']").attr("content"),
        reply: $this.find("#editor1").html(),
    }
    $this.find("button:submit").attr('disabled', true);
    $this.find("button:submit").html('<span class="fas fa-spinner" data-fa-transform="shrink-3"></span>');

    $.ajax({
        url: $("meta[name='BASE_URL']").attr("content") + "/admin/contact_us/" + $id,
        type: 'PUT',
        data:data
    })
    .done(function(response) {
        http.success({ 'message': response.message });
        window.location.reload();
    })
    .fail(function (response) {
        http.fail(response.responseJSON, true);
    });
});


</script>
<script >
    $(function($){
      console.log('object');
  $('textarea[data-provide="markdown"]').each(function(){
      var $this = $(this);

      if ($this.data('markdown')) {
      $this.data('markdown').showEditor();
      }
      else $this.markdown()
      
      $this.parent().find('.btn').addClass('btn-white');
  })



    function showErrorAlert (reason, detail) {
    var msg='';
    if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
    else {
    //console.log("error uploading file", reason, detail);
    }
    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
    '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
    }

    //$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

    //but we want to change a few buttons colors for the third style
    $('#editor1').ace_wysiwyg({
    toolbar:
    [
    'font',
    null,
    'fontSize',
    null,
    {name:'bold', className:'btn-info'},
    {name:'italic', className:'btn-info'},
    {name:'strikethrough', className:'btn-info'},
    {name:'underline', className:'btn-info'},
    null,
    {name:'insertunorderedlist', className:'btn-success'},
    {name:'insertorderedlist', className:'btn-success'},
    {name:'outdent', className:'btn-purple'},
    {name:'indent', className:'btn-purple'},
    null,
    {name:'justifyleft', className:'btn-primary'},
    {name:'justifycenter', className:'btn-primary'},
    {name:'justifyright', className:'btn-primary'},
    {name:'justifyfull', className:'btn-inverse'},
    null,
    {name:'createLink', className:'btn-pink'},
    {name:'unlink', className:'btn-pink'},
    null,
    {name:'insertImage', className:'btn-success'},
    null,
    'foreColor',
    null,
    {name:'undo', className:'btn-grey'},
    {name:'redo', className:'btn-grey'}
    ],
    'wysiwyg': {
    fileUploadError: showErrorAlert
    }
    }).prev().addClass('wysiwyg-style2');

    $('#editor2').ace_wysiwyg({
    toolbar:
    [
    'font',
    null,
    'fontSize',
    null,
    {name:'bold', className:'btn-info'},
    {name:'italic', className:'btn-info'},
    {name:'strikethrough', className:'btn-info'},
    {name:'underline', className:'btn-info'},
    null,
    {name:'insertunorderedlist', className:'btn-success'},
    {name:'insertorderedlist', className:'btn-success'},
    {name:'outdent', className:'btn-purple'},
    {name:'indent', className:'btn-purple'},
    null,
    {name:'justifyleft', className:'btn-primary'},
    {name:'justifycenter', className:'btn-primary'},
    {name:'justifyright', className:'btn-primary'},
    {name:'justifyfull', className:'btn-inverse'},
    null,
    {name:'createLink', className:'btn-pink'},
    {name:'unlink', className:'btn-pink'},
    null,
    {name:'insertImage', className:'btn-success'},
    null,
    'foreColor',
    null,
    {name:'undo', className:'btn-grey'},
    {name:'redo', className:'btn-grey'}
    ],
    'wysiwyg': {
    fileUploadError: showErrorAlert
    }
    }).prev().addClass('wysiwyg-style2');







    $('[data-toggle="buttons"] .btn').on('click', function(e){
    var target = $(this).find('input[type=radio]');
    var which = parseInt(target.val());
    var toolbar = $('#editor1').prev().get(0);
    if(which >= 1 && which <= 4) {
    toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
    if(which == 1) $(toolbar).addClass('wysiwyg-style1');
    else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
    if(which == 4) {
        $(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
    } else $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
    }
    });




    if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {

    var lastResizableImg = null;
    function destroyResizable() {
    if(lastResizableImg == null) return;
    lastResizableImg.resizable( "destroy" );
    lastResizableImg.removeData('resizable');
    lastResizableImg = null;
    }

    var enableImageResize = function() {
    $('.wysiwyg-editor')
    .on('mousedown', function(e) {
        var target = $(e.target);
        if( e.target instanceof HTMLImageElement ) {
            if( !target.data('resizable') ) {
                target.resizable({
                    aspectRatio: e.target.width / e.target.height,
                });
                target.data('resizable', true);
                
                if( lastResizableImg != null ) {
                    //disable previous resizable image
                    lastResizableImg.resizable( "destroy" );
                    lastResizableImg.removeData('resizable');
                }
                lastResizableImg = target;
            }
        }
    })
    .on('click', function(e) {
        if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
            destroyResizable();
        }
    })
    .on('keydown', function() {
        destroyResizable();
    });
    }

    enableImageResize();

    }


});
</script>
@endsection