<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th class="text-center">Tiêu đề</th>
        <th class="text-center">Danh mục bài viết</th>
        <th class="text-center">Avatar</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($posts) && is_object($posts))
        @foreach($posts as $posts)
    <tr>
        <td>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox checkBoxItem">
        </td>
        <td>
            {{$posts->username}}
        </td>
        <td>
            {{$user->email}}
        </td>
        <td>
            {{$user->role}}
        </td>
        <td class="text-center">
            <form action="{{ route('user.updatePublishStatus', $user->id) }}" method="POST" id="publishForm-{{ $user->id }}">
                @csrf
                <input type="hidden" name="publish" value="0">
                <input type="checkbox" name="publish" value="1" class="js-switch" onchange="document.getElementById('publishForm-{{ $user->id }}').submit();" {{ ($user->publish == 1) ? 'checked' : '' }} />
            </form>
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

