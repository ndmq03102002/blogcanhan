
<!DOCTYPE html>
<html>

@include('dashboard.component.head')

<body>
    <div id="wrapper">
    @include('dashboard.sidebar')

        <div id="page-wrapper" class="gray-bg">
        @include('dashboard.nav')
        @include($template)
        @include('dashboard.footer')
        </div>
    </div>
    @include('dashboard.scripts')
</body>
</html>
