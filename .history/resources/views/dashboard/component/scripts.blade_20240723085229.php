
    <!-- Mainly scripts -->
    <script src="template/js/jquery-3.1.1.min.js"></script>
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="template/js/plugins/flot/jquery.flot.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="template/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="template/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="template/js/inspinia.js"></script>
    <script src="template/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="template/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="template/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="template/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="template/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="template/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="template/js/demo/sparkline-demo.js"></script>

    
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script>
        @if(session('status'))
            toastr.success("{{ session('status') }}");
        @endif
    </script>