<!DOCTYPE html>
<html>
<body>
    @include('dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">Tên</th>
            <th class="text-center">Mô tả</th>
            <th class="text-center">Danh mục cha</th>
            <th class="text-center">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($categories) && $categories->isNotEmpty())
            @foreach($categories as $category)
        <tr>
            <td>
                <input type="checkbox" value="{{ $category->id }}" class="input-checkbox checkBoxItem">
            </td>
            <td>
                {{ $category->name }}
            </td>
            <td>
                {{ $category->description }}
            </td>
            <td>
                {{ $category->parent ? $category->parent->name : 'Không có' }}
            </td>
            <td class="text-center">
                <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                {{-- <a href="{{ route('cat.edit', $category->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('cat.delete', $category->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
            </td>
        </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    {{ $categories->links('pagination::bootstrap-4') }}
</body>
</html>
