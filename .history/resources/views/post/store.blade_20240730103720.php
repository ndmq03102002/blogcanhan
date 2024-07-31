

@php
    // Xác định route và title dựa trên config['method']
    if ($config['method'] == 'create') {
        $url = route('post.store');
        $title = $config['seo']['create']['title'];
    } else {
        $url = route('post.update', $user->id);
        $title = $config['seo']['edit']['title'];
    }
@endphp

@include('dashboard.component.breadcrumb', ['title' => $title])

<form action="{{$url}}" method="post" class="box" enctype="multipart/form-data">
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
                                    <select name="category_id[]" id="category" class="form-control select2" multiple="multiple">
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
                                        id="editor"
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
        
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

<script>
    // Khởi tạo CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ route('ckeditor.upload') }}'
            }
        })
        .catch(error => {
            console.error(error);
        });

</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script type="importmap">
    {
        "imports": {    
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph,
        Image,
        ImageInsert,
        AutoImage,
        ImageCaption,
        ImageResize,
        ImageStyle,
        ImageToolbar,
        LinkImage,
        
    } from 'ckeditor5';

    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            plugins: [ Essentials, Bold, Italic, Font, Paragraph, Image, ImageInsert , AutoImage , ImageToolbar, ImageCaption, ImageStyle, ImageResize, LinkImage],
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'insertImage'
                    ]
            }
            
        } )
        
        .then( /* ... */ )
        .catch( /* ... */ );
</script>
