@extends('dashboard.layout')

@section('content')
<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($users) && is_object($users))
            @foreach($users as $user)
        <tr>
            <td>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox checkBoxItem">
            </td>
            <td>
                {{$user->username}}
            </td>
            <td>
                {{$user->email}}
            </td>
            <td>
                {{$user->role}}
            </td>
            <td class="text-center ">
                <input type="checkbox" value="{{ $user->publish }}" class="js-switch" data-id="{{ $user->id }}" {{ ($user->publish == 1) ? 'checked' : '' }} />
            </td>
            <td class="text-center">
                <a href="{{route('user.edit', $user->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>

        </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    {{$users->links('pagination::bootstrap-4')}}
</div>

<!-- Include jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
@endsection
