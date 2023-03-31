@extends('layouts.modal')
@section('contnet')
<form id="target" data-action="features" action="" method="post" class="form-horizontal">
    @csrf
    <div class="card" >
        <div class="card-body">
          <h5 class="card-title">{{__('Order Details')}}</h5>
          
        </div>
      </div>
    
    <div class="form-group row">
        <div class="col-sm-offset-2 col-7">
            <input id="btn-submit-modal" value="{{__('Add')}}" hidden type="submit" class="btn btn-primary" >
        </div>
    </div>
</form>
@endsection
@section('js')
<script>$id = {{$order->id}}</script>
<script>
    $("#btn-submit").on('click', function(event){
    event.preventDefault();
    var $this = $(this).parent().parent().find('form');
    fail = true;
    http.checkRequiredFelids($this);
    if(!fail){
        return true;
    }
    var buttonText = $this.find('button:submit').text();
    data = {
        _token: $("meta[name='csrf-token']").attr("content"),
        status: $.trim($this.find("select[name='status']").val()),
    }
    $this.find("button:submit").attr('disabled', true);
    $this.find("button:submit").html('<span class="fas fa-spinner" data-fa-transform="shrink-3"></span>');
    $.ajax({
        url: $("meta[name='BASE_URL']").attr("content") + '/admin/order/' + $id,
        type: 'PUT',
        data:data
    })
    .done(function(response) {
        http.success({ 'message': response.message });
        window.location.reload();
    })
    .fail(function (response) {
        http.fail(response.responseJSON, true);
    })
    .always(function () {
        $this.find("button:submit").attr('disabled', false);
        $this.find("button:submit").html(buttonText);
    });
});


</script>

@endsection