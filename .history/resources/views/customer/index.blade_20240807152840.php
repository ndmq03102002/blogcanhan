
<div class="container">
    <h5>Người đăng: {{$post->user->username}}</h5>
    <h5>{{ $formattedDate }}</h5>
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
        <h5>Bài viết hay? Ấn để tương tác</h5>
        @if ($post->ratings->count())
            <ul>
                @foreach ($rat as $rating)
                    <li>
                        <strong>{{ $rating->user->username }}:</strong> {{ $rating->rating }} sao
                    </li>
                @endforeach
                {{$rat->links('pagination::bootstrap-4')}}
            </ul>
            <!-- Hiển thị điểm trung bình -->
            <p><strong>Điểm trung bình:</strong> {{ $post->averageRating() }} sao</p>
        @else
            <p>Chưa có đánh giá.</p>
        @endif
    </div>
    

    <div class="post-comments" id="comments-section">
        <h5>Bình luận:</h5>
        <ul id="comments-list">
            @foreach ($cmt as $comment)
                @php
                    $avatar = $comment->user->profile->avatar ?? 'default-avatar.png'; // Avatar mặc định nếu không có
                @endphp
                <li>
                    <img src="{{ asset('storage/avatars/' . basename($avatar)) }}" alt="Avatar" style="width: 30px; height: 30px; border-radius: 50%;">
                    <strong>{{ $comment->user->profile->name  ?? $comment->user->username}}:</strong> {{ $comment->content }}
                </li>
                
            @endforeach
            {{$cmt->links('pagination::bootstrap-4')}}
        </ul>
        
    </div>
    
    
    
    
    {{-- Form bình luận --}}
    <div class="post-comment-form">
        <h5>Thêm bình luận:</h5>
        <form id="comment-form" action="{{ route('comments.store') }}" method="POST" onsubmit="submitComment(event)">
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
        <form id="rating-form" action="{{ route('ratings.store') }}" method="POST" onsubmit="submitRating(event)">
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

