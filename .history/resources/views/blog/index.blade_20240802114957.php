
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
    

    <div class="post-comments" id="comments-section">
        <h5>Bình luận:</h5>
        <ul id="comments-list">
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
        <div id="pagination-links">
            {{ $comments->links('pagination::bootstrap-4')->render() }}
        </div>
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

<script>
    function submitComment(event) {
        event.preventDefault(); // Ngăn form gửi đi theo cách mặc định

        const form = event.target;
        const formData = new FormData(form);

        // Tạo đối tượng XMLHttpRequest để gửi dữ liệu
        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('X-CSRF-TOKEN', formData.get('_token'));

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Xử lý dữ liệu trả về từ server
                const response = JSON.parse(xhr.responseText);
                const commentsList = document.querySelector('.post-comments ul');
                const newComment = document.createElement('li');
                newComment.innerHTML = `
                    <img src="${response.avatar}" alt="Avatar" style="width: 30px; height: 30px; border-radius: 50%;">
                    <strong>${response.username}:</strong> ${response.content}
                `;
                commentsList.appendChild(newComment);

                // Xóa nội dung của textarea sau khi gửi
                form.querySelector('textarea').value = '';
            } else {
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            }
        };

        xhr.send(formData);
    }

    function submitRating(event) {
        event.preventDefault(); // Ngăn form gửi đi theo cách mặc định

        const form = event.target;
        const formData = new FormData(form);

        // Tạo đối tượng XMLHttpRequest để gửi dữ liệu
        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('X-CSRF-TOKEN', formData.get('_token'));

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Xử lý dữ liệu trả về từ server
                const response = JSON.parse(xhr.responseText);
                document.querySelector('.post-ratings p').innerText = `Điểm trung bình: ${response.averageRating} sao`;

                // Xóa lựa chọn sao sau khi gửi
                form.querySelector('select').value = '';
            } else {
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            }
        };

        xhr.send(formData);
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commentsSection = document.getElementById('comments-section');
        const commentsList = document.getElementById('comments-list');
        const paginationLinks = document.getElementById('pagination-links');

        // Xử lý nhấp vào liên kết phân trang
        commentsSection.addEventListener('click', function(event) {
            if (event.target.tagName === 'A') {
                event.preventDefault();
                const url = event.target.href;
                
                // Gửi yêu cầu HTTP GET để lấy bình luận mới
                const xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Phân tích dữ liệu HTML từ phản hồi
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = xhr.responseText;
                        
                        // Cập nhật nội dung của danh sách bình luận và liên kết phân trang
                        const newCommentsList = tempDiv.querySelector('#comments-list').innerHTML;
                        const newPaginationLinks = tempDiv.querySelector('#pagination-links').innerHTML;

                        commentsList.innerHTML = newCommentsList;
                        paginationLinks.innerHTML = newPaginationLinks;
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                };

                xhr.send();
            }
        });
    });
</script>

