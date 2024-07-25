
<!DOCTYPE html>
<html>

@include('dashboard.head')

<body>
    <div id="wrapper">
    @include('dashboard.sidebar')

        <div id="page-wrapper" class="gray-bg">
        @include('dashboard.nav')
        @include()
        @include('dashboard.footer')
        </div>
    </div>
    @include('dashboard.scripts')
</body>
</html>
