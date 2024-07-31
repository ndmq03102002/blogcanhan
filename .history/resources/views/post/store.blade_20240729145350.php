
@php
    // Xác định route và title dựa trên config['method']
    if ($config['method'] == 'create') {
        $url = route('user.store');
        $title = $config['seo']['create']['title'];
    } else {
        $url = route('user.update', $user->id);
        $title = $config['seo']['edit']['title'];
    }
@endphp

@include('dashboard.component.breadcrumb', ['title' => $title])

<form action="{{$url}}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <div class="panel-title">Thông tin bài viết</div>
                    <div class="panel-description">
                        <p>Nhập thông tin bài viết</p>
                        <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-12 mb15">
                                <div class="form-row">
                                    <label for="title" class="control-label text-left">Tiêu đề <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="title"
                                        id="title"
                                        value="{{ old('title', $post->title ?? '') }}"
                                        class="form-control"
                                        placeholder="Nhập tiêu đề bài viết"
                                        autocomplete="off"
                                    >
                                    @if($errors->has('title'))
                                        <p class="error-message">* {{$errors->first('title')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 mb15">
                                <div class="form-row">
                                    <label for="category" class="control-label text-left">Danh mục bài viết <span class="text-danger">(*)</span></label>
                                    <select name="<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>" id="category" class="form-control setupSelect2 multiple">
                                        <option value="">Chọn danh mục</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id'))
                                        <p class="error-message">* {{$errors->first('category_id')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 mb15">
                                <div class="form-row">
                                    <label for="image" class="control-label text-left">Ảnh đại diện <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="file"
                                        name="image"
                                        id="image"
                                        class="form-control"
                                    >
                                    @if($errors->has('image'))
                                        <p class="error-message">* {{$errors->first('image')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 mb15">
                                <div class="form-row">
                                    <label for="content" class="control-label text-left">Nội dung <span class="text-danger">(*)</span></label>
                                    <textarea
                                        name="content"
                                        id="content"
                                        class="form-control"
                                        placeholder="Nhập nội dung bài viết"
                                        rows="6"
                                    >{{ old('content', $post->content ?? '') }}</textarea>
                                    @if($errors->has('content'))
                                        <p class="error-message">* {{$errors->first('content')}}</p>
                                    @endif
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