
    <!-- Mainly scripts -->
    
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="template/library/library.js"></script>
    <script src='backend/js/inspinia.js',
                'backend/js/plugins/pace/pace.min.js',></script>
    <script src="template/library/library.js"></script>
    <!-- Custom and plugin javascript -->
    @if(isset($config['js'])&& is_array($config['js']))
    @foreach($config['js'] as $key => $val)
        {!! '<script src="'.$val.'"></script>' !!}
    @endforeach
    @endif

    
 