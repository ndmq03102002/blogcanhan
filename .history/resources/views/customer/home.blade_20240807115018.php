@include('customer.header')

<body>

    @include('customer.nav')
    <section class="intro-news-area section-padding-10-0 mb-70">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Intro News Tabs Area -->
                <div class="col-12 col-lg-8">
                    @include($template)
                </div>
            </div>
        </div>
    </section>
   
 
    @include('blog.footer')
    
   
</body>
<script src="fontend/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="fontend/js/bootstrap/popper.min.js"></script>
    <script src="fontend/js/bootstrap/bootstrap.min.js"></script>
    <script src="fontend/js/plugins/plugins.js"></script>
    <script src="fontend/js/active.js"></script>