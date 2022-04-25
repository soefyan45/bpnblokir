<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{asset('/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi,
                    {{ Auth::user()->name }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{route('apps.profile')}}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <div class="dropdown-item has-icon">
                    <button class="badge badge-danger center mx-auto" onclick="keluar()"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </
            </div>
        </li>
    </ul>
    <script>
        function keluar(){
            // window.open("/logout","_self")
            var secure_token = '{{ csrf_token() }}';
            $.ajax({
                url : "/logout",
                method : "POST",
                data : {
                    '_token': secure_token
                },
                async : false,
                dataType : 'json',
                success: function(data){
                    console.log('logout success');
                    window.open("/home","_self")
                },error: function (xhr, ajaxOptions, thrownError) {
                    window.open("/home","_self")
                }
            });
        }
    </script>

</nav>
