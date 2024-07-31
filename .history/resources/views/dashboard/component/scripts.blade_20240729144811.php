
    <!-- Mainly scripts -->
    
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="template/library/library.js"></script>
    <script src="template/js/inspinia.js"></script>
    <script src="template/js/plugins/pace/pace.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom and plugin javascript -->
    @if(isset($config['js'])&& is_array($config['js']))
    @foreach($config['js'] as $key => $val)
        {!! '<script src="'.$val.'"></script>' !!}
    @endforeach
    @endif

    
 