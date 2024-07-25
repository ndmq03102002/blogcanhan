<form action="{{ route('user.index') }}">
<div class="filter-wapper">
    <div name="perpage" >
        @php
            $perpage = request('perpage') ?: old('perpage');
        @endphp
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <select name = "perpage" class="form-control input-sm perpage filter mr10">
                @for($i=20; $i<=200; $i+=20)
                    <option value="{{$i}}">{{$i}} Bản ghi</option>
                @endfor
            </select>
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    
                    <select name="user_catalogue_id" class = "form-control mr10">
                        <option value="0" selected="selected">
                            Chọn nhóm thành viên
                        </option>
                        <option value="1">Quản trị viên</option>
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
                    <a href="{{route('user.create')}}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới thành viên</a>
                </div>
            </div>
        </div>

    </div>
</div>
</form>