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
        {{-- {!! $post->content !!} --}}
        {{-- {{ $post->content }} --}}
    </div>

    
</div>
<style>
    .post-image img {
        max-width: 100%;
        height: auto;
    }
</style>