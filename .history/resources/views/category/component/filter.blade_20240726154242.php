<form action="{{ route('cat.search') }}" method="GET">
    <div class="filter-wapper">
        <div name="perpage">
            @php
                $perpage = request('perpage') ?: old('perpage', 10); // Giá trị mặc định là 10 nếu không có yêu cầu từ người dùng
                $parentId = request('parent_id') ?: old('parent_id');
                $keyword = request('keyword') ?: old('keyword');
            @endphp
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <select name="perpage" class="form-control input-sm perpage filter mr10">
                    @for($i = 5; $i<= 200; $i+=5)
                        <option {{ ($perpage == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} bản ghi</option>
                    @endfor
                </select>
                <div class="action">
                    <div class="uk-flex uk-flex-middle">
                        <select name="cat_id" class="form-control mr10">
                            <option value="" {{ $parentId === '' ? 'selected' : '' }}>Chọn danh mục cha (tất cả)</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $parentId == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="uk-search uk-flex-middle mr10">
                            <div class="input-group">
                                <input
                                    type="text"
                                    name="keyword"
                                    value="{{ request('keyword') ?: old('keyword') }}"
                                    placeholder="Nhập từ khóa bạn muốn tìm kiếm..."
                                    class="form-control"
                                >
                                <span class="input-group-btn">
                                    <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm kiếm</button>
                                </span>
                            </div>
                        </div>
                        <a href="{{route('cat.create')}}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới thành viên</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
