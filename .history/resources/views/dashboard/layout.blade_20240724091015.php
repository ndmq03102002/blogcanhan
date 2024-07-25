
<!DOCTYPE html>
<html>

@include('dashboard.component.head')

<body>
    <div id="wrapper">
    @include('dashboard.component.sidebar')

        <div id="page-wrapper" class="gray-bg">
        @include('dashboard.component.nav')
        @include($template)
        @include('dashboard.footer')
        </div>
    </div>
    @include('dashboard.scripts')
</body>
</html>
