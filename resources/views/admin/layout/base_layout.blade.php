

@include('admin.incld.header')
@include('admin.incld.sidebar')
@yield('style')
<div class="content-wrapper">
 @yield('content')
</div>
@include('admin.incld.footer')
@yield('links')
@yield('scripts')
