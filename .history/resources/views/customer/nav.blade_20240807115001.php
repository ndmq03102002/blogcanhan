<header class="header-area">
    <!-- Navbar Area -->
    <div class="newsbox-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container-fluid">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="newsboxNav">

                    <!-- Nav brand -->
                    <a href="{{route('customer.home')}}" class="nav-brand"><img src="fontend/img/core-img/logo.png" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{route('customer.home')}}">Home</a></li>
                                <li><a href="#">Category</a>
                                    <div class="megamenu">
                                        @foreach ($categories as $category)
                                            @if ($category->children->isNotEmpty())
                                                <ul class="single-mega cn-col-4">
                                                    <li class="title">{{ $category->name }}</li>
                                                    @foreach ($category->children as $childCategory)
                                                        <li>
                                                            <a href="{{ route('blog.search', ['category_id' => $childCategory->id]) }}">{{ $childCategory->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                                
                                <li><a href="#">Profile</a>
                                    <ul class="dropdown">
                                        
                                        <li><a href="{{route('auth.login')}}">Đặng nhập</a></li>
                                        <li><a href="{{route('auth.register')}}">Đặng ký</a></li>
                                       
                                        
                                    </ul>
                                </li>
                                <li>
                                    <form action="{{ route('customer.search') }}" method="GET" class="search-form">
                                        <input type="text" name="keyword" placeholder="Search..." value="{{ request('keyword') ?: old('keyword') }}">
                                        <button type="submit">Search</button>
                                    </form>
                                </li>
                            </ul>
                            
                            <!-- Header Add Area -->
                            {{-- <div class="header-add-area">
                                <a href="#">
                                   <img src="fontend/img/bg-img/add.png" alt="">
                                </a>    
                            </div> --}}
                        </div>
                        <!-- Nav End -->

                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>