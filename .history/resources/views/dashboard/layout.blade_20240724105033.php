
<!DOCTYPE html>
<html>
<head>
@include('dashboard.component.head')
</head>
<body>
    <div id="wrapper">
        @include('dashboard.component.sidebar')

        <div id="page-wrapper" class="gray-bg">
        @include('dashboard.component.nav')
        @include($template)
        @include('dashboard.component.footer')
        </div>
    </div>
    @include('dashboard.component.scripts')
</body>
</html>
