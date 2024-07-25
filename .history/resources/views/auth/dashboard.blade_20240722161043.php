<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> Xin chào! Vui lòng hãy đăng nhập để tiếp tục </h1>


    
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script>
        @if(session('status'))
            toastr.success("{{ session('status') }}");
        @endif
    </script>
</body>
</html>