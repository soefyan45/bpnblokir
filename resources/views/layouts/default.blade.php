<!-- head -->
<!DOCTYPE html>
@include('layouts.partials._head')
<body>
{{-- <body class="sidebar-mini"> --}}
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <!-- nav -->
    @include('layouts.partials._nav')
        <!-- sidebar -->
    @include('layouts.partials._sidebar')

        <!-- Main Content -->
        @yield('_containerOfContents')
    <!-- footer -->
        @include('layouts.partials._footer')
    </div>

</div>
</body>
</html>
