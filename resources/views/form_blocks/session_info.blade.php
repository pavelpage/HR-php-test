@if(session('server_message'))
    <div class="alert alert-dismissible alert-info server-message">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('server_message')}}
    </div>
@endif