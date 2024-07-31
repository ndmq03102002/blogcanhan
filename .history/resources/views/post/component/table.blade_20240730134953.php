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
        @foreach($posts as $post)
    <tr>
        <td>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox checkBoxItem">
        </td>
        <td>
            {{$post->title}}
        </td>
        <td>
            @foreach ($post->categories as $category)
                    <li>{{ $category->name }}</li>
            @endforeach
        </td>
        <td>
            <img src="{{asset($post->image)}}" alt="#" class="img-responsive" style="width: 100px; height: 100px;">
        </td>
        
        <td class="text-center">
            <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
            <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        </td>

    </tr>
        @endforeach
    @endif

    </tbody>
</table>

{{$users->links('pagination::bootstrap-4')}}

