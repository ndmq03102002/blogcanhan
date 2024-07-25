123

<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script>
        @if(session('status'))
            toastr.success("{{ session('status') }}");
        @endif
    </script>