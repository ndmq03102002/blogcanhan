
    <!-- Mainly scripts -->
    <script src="template/js/jquery-3.1.1.min.js"></script>
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    

    
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script>
        @if(session('status'))
            toastr.success("{{ session('status') }}");
        @endif
    </script>