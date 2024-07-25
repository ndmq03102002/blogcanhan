
    <base href="{{env('URL')}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard v.2</title>
    <script src="template/js/jquery-3.1.1.min.js"></script>
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="template/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @if(isset($config['css'])&& is_array($config['css']))
    @foreach($config['css'] as $key => $val)
        {!! '<link rel="stylesheet" href="'.$val.'">' !!}
    @endforeach
    @endif
    <link href="template/css/style.css" rel="stylesheet">
    <link href="template/css/customize.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('.js-switch').change(function() {
                var publish = $(this).is(':checked') ? 1 : 0;
                var userId = $(this).data('id');
    
                $.ajax({
                    url: '/users/' + userId + '/publish',
                    type: 'PATCH',
                    data: {
                        publish: publish,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.success) {
                            alert('Cập nhật thành công!');
                        } else {
                            alert('Cập nhật thất bại!');
                        }
                    },
                    error: function(response) {
                        alert('Có lỗi xảy ra!');
                    }
                });
            });
        });
    </script>
    
