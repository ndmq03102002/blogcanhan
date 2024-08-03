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
   
 
    <footer class="footer-area">
        <!-- Footer Logo -->
        <div class="footer-logo mb-100">
            <a href="index.html"><img src="fontend/img/core-img/logo.png" alt=""></a>
        </div>
        <!-- Footer Content -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-content text-center">
                        <!-- Footer Nav -->
                        <div class="footer-nav">
                            <ul>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Closed Captioning</a></li>
                                <li><a href="#">Site Map</a></li>
                            </ul>
                        </div>
                        <!-- Social Info -->
                        <div class="footer-social-info">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="behance"><i class="fa fa-behance" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>

                        <p class="mb-15">Nullam lacinia ex eleifend orci porttitor, suscipit interdum augue condimentum. Etiam pretium turpis eget nibh laoreet iaculis. Proin ac urna at lectus volutpat lobortis. Vestibulum venenatis iaculis diam vitae lobortis. Donec tincidunt viverra elit, sed consectetur est pr etium ac. Mauris nec mauris tellus. </p>

                        <!-- Copywrite Text -->
                        <p class="copywrite-text"><a href="#">
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="fontend/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="fontend/js/bootstrap/popper.min.js"></script>
    <script src="fontend/js/bootstrap/bootstrap.min.js"></script>
    <script src="fontend/js/plugins/plugins.js"></script>
    <script src="fontend/js/active.js"></script>
</body>

</html>