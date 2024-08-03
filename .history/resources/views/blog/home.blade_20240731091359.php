<div class="container">
    <h1>{{ $post->title }}</h1>
    
    {{-- Hiển thị danh mục bài viết --}}
    @if ($post->categories->count())
        <div class="post-categories">
            <h5>Danh mục:</h5>
            <ul>
                @foreach ($post->categories as $category)
                    <li>{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Hiển thị ảnh đại diện nếu có --}}
    @if ($post->image)
        <div class="post-image">
            <img src="{{ asset('storage/images/' . basename($post->image)) }}" alt="Post Image" class="img-fluid">
        </div>
    @endif

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
                        <strong>{{ $rating->user->name }}:</strong> {{ $rating->rating }} sao
                    </li>
                @endforeach
            </ul>
        @else
            <p>Chưa có đánh giá.</p>
        @endif
    </div>

    {{-- Phần bình luận --}}
    <div class="post-comments">
        <h5>Bình luận:</h5>
        @if ($post->comments->count())
            <ul>
                @foreach ($post->comments as $comment)
                    <li>
                        <strong>{{ $comment->user->username }}:</strong> {{ $comment->content }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Chưa có bình luận.</p>
        @endif
    </div>

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
    .post-image img {
        max-width: 100%;
        height: auto;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
    }
    
    .post-ratings ul, .post-comments ul {
        list-style-type: none;
        padding: 0;
    }

    .post-ratings li, .post-comments li {
        margin-bottom: 10px;
    }

    .post-comment-form, .post-rating-form {
        margin-top: 20px;
    }
    .container
</style>
