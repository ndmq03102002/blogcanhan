<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INSPINIA | Dashboard v.2</title>
    <script src="template/js/jquery-3.1.1.min.js"></script>
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="template/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @if(isset($config['css'])&& is_array($config['css']))
    @foreach($config['css'] as $key => $val)
        {!! '<link rel="stylesheet" href="'.$val.'">' !!}
    @endforeach
    @endif
    <link href="template/css/style.css" rel="stylesheet">
    <link href="template/css/customize.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css" />
</head>
<button><a href="{{route('blog.home')}}">Trang chủ</a></button>
<div class="container">
    <h3>Người đăng: {{$post->user->username}}</h3>
    <h4>{{ $formattedDate }}</h4>
    <h1 class="title">{{ $post->title }}</h1>
    
    {{-- Hiển thị danh mục bài viết --}}
    {{-- @if ($post->categories->count())
        <div class="post-categories">
            <h5>Danh mục:</h5>
            <ul>
                @foreach ($post->categories as $category)
                    <li>{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    {{-- Hiển thị ảnh đại diện nếu có --}}
    {{-- @if ($post->image)
        <div class="post-image">
            <img src="{{ asset('storage/images/' . basename($post->image)) }}" alt="Post Image" class="img-fluid">
        </div>
    @endif --}}

    {{-- Hiển thị nội dung bài viết --}}
    <div class="post-content">
        {!! $post->content !!}
    </div>

    {{-- Phần đánh giá --}}
    <div class="post-ratings">
        <h5>Đánh giá:</h5>
        @if ($post->ratings->count())
            <ul>
                @foreach ($post->ratings as $rating)
                    <li>
                        <strong>{{ $rating->user->username }}:</strong> {{ $rating->rating }} sao
                    </li>
                @endforeach
            </ul>
            <!-- Hiển thị điểm trung bình -->
            <p><strong>Điểm trung bình:</strong> {{ $post->averageRating() }} sao</p>
        @else
            <p>Chưa có đánh giá.</p>
        @endif
    </div>
    

    <div class="post-comments">
        <h5>Bình luận:</h5>
        @if ($post->comments->count())
            <ul>
                @foreach ($post->comments as $comment)
                    @php
                        $avatar = $comment->user->profile->avatar ?? 'default-avatar.png'; // Avatar mặc định nếu không có
                    @endphp
                    <li>
                        <img src="{{ asset('storage/avatars/' . basename($avatar)) }}" alt="Avatar" style="width: 30px; height: 30px; border-radius: 50%;">
                        <strong>{{ $comment->user->username }}:</strong> {{ $comment->content }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Chưa có bình luận.</p>
        @endif
        
    </div>
    {{$cmt -> links()}}
    
    
    {{-- Form bình luận --}}
    <div class="post-comment-form">
        <h5>Thêm bình luận:</h5>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" placeholder="Viết bình luận của bạn..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
        </form>
    </div>
    
    {{-- Form đánh giá --}}
    <div class="post-rating-form">
        <h5>Thêm đánh giá:</h5>
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <select name="rating" class="form-control" required>
                    <option value="">Chọn số sao</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} sao</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
        </form>
    </div>
    
   
</div>



<style>
     .container {
        max-width: 800px; /* Điều chỉnh chiều rộng tối đa của container */
        margin: 0 auto; /* Căn giữa container */
        padding: 20px; /* Khoảng cách bên trong container */
    }
    
    .title {
        text-align: center;
    }

    .post-content {
        text-align: left; /* Đặt văn bản căn trái mặc định */
    }

    .post-content p {
        margin: 0 0 10px; /* Khoảng cách dưới các đoạn văn */
    }

    .post-content figure {
        margin: 0; /* Loại bỏ khoảng cách mặc định của figure */
        text-align: center; /* Căn giữa nội dung của figure */
    }

    .post-content figure img {
        max-width: 100%; /* Đảm bảo hình ảnh không vượt quá chiều rộng của container */
        height: auto; /* Giữ tỷ lệ hình ảnh */
    }

    .post-content .image-style-align-left {
        float: left; /* Căn trái hình ảnh */
        margin-right: 10px; /* Khoảng cách bên phải của hình ảnh */
    }

    .post-content .image-style-align-center {
        display: block; /* Căn giữa hình ảnh */
        margin-left: auto;
        margin-right: auto;
    }

    .post-content .image-style-align-right {
        float: right; /* Căn phải hình ảnh */
        margin-left: 10px; /* Khoảng cách bên trái của hình ảnh */
    }
</style>
