@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
@endif
@if(session('success_confirm'))
    <div class="alert alert-success">
        {{session('success_confirm')}}
    </div>
@endif
@if(session('warning_confirm'))
    <div class="alert alert-warning">
        {{session('warning_confirm')}}
    </div>
@endif
@if(session('info'))
    <div class="alert alert-info">
        {{session('info')}}
    </div>
@endif
@if(session('danger'))
    <div class="alert alert-danger">
        {{session('danger')}}
    </div>
@endif
