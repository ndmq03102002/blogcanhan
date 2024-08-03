@include('blog.header')

<body>

    @include('blog.nav')
    <section class="intro-news-area section-padding-10-0 mb-70">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Intro News Tabs Area -->
                <div class="col-12 col-lg-8">
                    <div class="intro-news-tab">

                        <!-- Intro News Filter -->
                        <div class="intro-news-filter d-flex justify-content-between">
                            <h6>All the news</h6>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav1" data-toggle="tab" href="#nav-1" role="tab" aria-controls="nav-1" aria-selected="true">Latest</a>
                                    <a class="nav-item nav-link" id="nav2" data-toggle="tab" href="#nav-2" role="tab" aria-controls="nav-2" aria-selected="false">Popular</a>
                                    <a class="nav-item nav-link" id="nav3" data-toggle="tab" href="#nav-3" role="tab" aria-controls="nav-3" aria-selected="false">International</a>
                                    <a class="nav-item nav-link" id="nav4" data-toggle="tab" href="#nav-4" role="tab" aria-controls="nav-4" aria-selected="false">Local</a>
                                </div>
                            </nav>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav1">
                                <div class="row">
                                    <!-- Main Post -->
                                    @if($mainPost)
                                    @php
                                        $url = route('blog.show', $mainPost->id);
                                    @endphp
                                    <div class="col-12">
                                        <div class="single-blog-post1 style-2 mb-5">
                                            <div class="blog-thumbnail">
                                                <a href="{{$url}}"><img src="{{ asset('storage/images/' . basename($mainPost->image)) }}" alt="Post Image" class="img-fluid"></a>
                                            </div>
                                            <div class="blog-content">
                                                <span class="post-date">{{ $mainPost->created_at->format('F j, Y') }}</span>
                                                <a href="{{$url}}" class="post-title">{{ $mainPost->title }}</a>
                                                <a href="{{$url}}" class="post-author mb-30">By: {{ $mainPost->user->username }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
    
                                    <!-- Additional Posts -->
                                    @foreach($additionalPosts as $post)
                                    @php
                                        $urls = route('blog.show', $post->id);
                                    @endphp
                                    <div class="col-12 col-sm-6">
                                        <div class="single-blog-post2 style-2 mb-5">
                                            <div class="blog-thumbnail">
                                                <a href="{{$urls}}"><img src="{{ asset('storage/images/' . basename($post->image)) }}" alt="Post Image" class="img-fluid"></a>
                                            </div>
                                            <div class="blog-content">
                                                <span class="post-date">{{ $post->created_at->format('F j, Y') }}</span>
                                                <a href="{{$urls}}" class="post-title">{{ $post->title }}</a>
                                                <a href="{{$urls}}" class="post-author">By: {{ $post->user->username }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
    
                                <!-- Pagination -->
                                <div class="text-center">
                                    {{ $posts->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
 
    @include('blog.footer')
    
   
</body>
