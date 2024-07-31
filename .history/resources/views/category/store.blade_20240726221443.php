
@php
    // Xác định route và title dựa trên config['method']
    if ($config['method'] == 'create') {
        $url = route('cat.store');
        $title = $config['seo']['create']['title'];
    } else {
        $url = route('cat.update', $category->id);
        $title = $config['seo']['edit']['title'];
    }
@endphp

@include('dashboard.component.breadcrumb', ['title' => $title])
<form action="{{$url}}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin danh mục</div>
                    <div class="panel-description">
                        <p>Nhập thông tin của danh mục mới</p>
                        <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="name" class="control-label text-left">Tên danh mục <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', ($category->name) ?? '' ) }}"
                                        class="form-control"
                                        placeholder="Nhập tên danh mục"
                                        autocomplete="off"
                                    >
                                    @if($errors->has('name'))
                                        <p class="error-message">* {{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="is_parent" class="control-label text-left">Mô tả</label>
                                    <input 
                                        type="text"
                                        name="description"
                                        id="description"
                                        value="{{ old('description', ($category->description) ?? '' ) }}"
                                        class="form-control"
                                        placeholder="Nhập tên danh mục"
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        {{-- <div id="parent_field" style="{{ old('is_parent', isset($category) ? ($category->parent_id === null) : false) ? 'display:none;' : 'display:block;' }}"> --}}
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="parent_id" class="control-label text-left">Danh mục cha</label>
                                        <select name="parent_id" id="parent_id" class="form-control setupSelect2">
                                            <option value="0">Chọn danh mục cha (nếu có)</option>
                                            @foreach($cats as $cat)
                                                <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <hr> --}}
        
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>