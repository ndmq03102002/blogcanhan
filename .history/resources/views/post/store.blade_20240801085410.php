

@php
    // Xác định route và title dựa trên config['method']
    if ($config['method'] == 'create') {
        $url = route('post.store');
        $title = $config['seo']['create']['title'];
    } else {
        $url = route('post.update', $post->id);
        $title = $config['seo']['edit']['title'];
        $selectedCategories = old('category_id', $post->categories->pluck('id')->toArray());
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
                                        @foreach($cats as $cat)
                                        @if($config['method'] == 'edit')
                                            <option value="{{ $cat->id }}" {{ in_array($cat->id, $selectedCategories) ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                            @endif
                                            @if($config['method'] == 'create')
                                            <option value="{{ $cat->id }}">
                                                {{ $cat->name }}
                                            </option>
                                            @endif
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
                                    @if($config['method'] == 'edit')
                                    @if($post->image )
                                        <div class="mt-2">
                                            <img src="{{ asset($post->image) }}" alt="Current Image" style="max-width: 200px;">
                                        </div>
                                    @endif
                                    @endif
                                    @if($errors->has('image'))
                                        <p class="error-message">* {{$errors->first('image')}}</p>
                                    @endif
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Wyswig Summernote Editor</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="fa fa-wrench"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-user">
                                                <li><a href="#">Config option 1</a>
                                                </li>
                                                <li><a href="#">Config option 2</a>
                                                </li>
                                            </ul>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content no-padding">
                
                                        <div class="summernote">
                                            <h3>Lorem Ipsum is simply</h3>
                                            dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                                            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                                            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                            <br/>
                                            <br/>
                                            <ul>
                                                <li>Remaining essentially unchanged</li>
                                                <li>Make a type specimen book</li>
                                                <li>Unknown printer</li>
                                            </ul>
                                        </div>
                
                                    </div>
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

{{-- <script>
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

</script> --}}

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
        Clipboard,
        Alignment,
        FontSize,
        FontFamily
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#editor'), {
            plugins: [
                Essentials, Bold, Clipboard, Italic, Font, Paragraph, Image, ImageInsert, AutoImage, ImageToolbar, ImageCaption, ImageStyle, ImageResize, LinkImage, Alignment, FontSize, FontFamily
            ],
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'insertImage', 'alignment'
                ],
            },
            image: {
                toolbar: [
                    'imageTextAlternative', // Thay đổi thuộc tính văn bản thay thế của ảnh
                    '|',
                    'imageStyle:full', // Nút để chỉnh sửa hình ảnh thành full width
                    'imageStyle:side', // Nút để chỉnh sửa hình ảnh thành bên
                    'imageResize', // Thay đổi kích thước hình ảnh
                    'imageStyle:alignLeft', // Thêm nút căn trái
                    'imageStyle:alignCenter', // Thêm nút căn giữa
                    'imageStyle:alignRight' // Thêm nút căn phải
                ],
                styles: [
                    'full',
                    'side',
                    'alignLeft',
                    'alignCenter',
                    'alignRight'
                ]
            }
        })
        .then(/* ... */)
        .catch(/* ... */);
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>

