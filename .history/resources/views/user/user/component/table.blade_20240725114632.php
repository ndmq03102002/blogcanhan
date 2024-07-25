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
            <input type="checkbox" value="{{ $user->publish }}" class="js-switch status" data-field="publish" data-model="User" data-id="{{ $user->id }}" {{ ($user->publish == 1) ? 'checked' : '' }} />
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
<script src="template/js/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.status').change(function() {
            var publish = $(this).is('checked') ? 1 : 0;
            var userId = $(this).data('id');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('user.updatePublishStatus',u)}}",
                type: "POST",
                data: {
                    publish: publish,
                    userId: userId,
                    _token: _token
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
            
        });
    });
</script>
