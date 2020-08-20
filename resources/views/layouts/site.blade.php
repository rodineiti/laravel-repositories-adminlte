<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('applab/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('applab/css/style.css')}}">
</head>

<body>

<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-2">
                        <div class="logo">
                            <a href="/">
                                <img src="{{asset('applab/img/logo.png')}}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="/">Home</a></li>
                                    @foreach($menu_site as $menu)
                                        <li>
                                            @if(count($menu->subpages))
                                                <a href="javascript:;">{{$menu->title}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    @foreach($menu->subpages as $submenu)
                                                        <li><a href="/{{$menu->slug}}/{{$submenu->slug}}">{{$submenu->title}}</a></li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <a href="/{{$menu->slug}}">{{$menu->title}}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">

                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- header-end -->

@yield('content')

<!-- footer start -->
<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="footer_widget">
                        <div class="footer_logo">
                            <a href="#">
                                <img src="{{asset('applab/img/logo.png')}}" alt="logo">
                            </a>
                        </div>
                        <p>
                            {{$settings["subtitle"]}}
                        </p>
                        <div class="socail_links">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="ti-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="ti-twitter-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-lg-2">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Menu
                        </h3>
                        <ul>
                            @foreach($menu_site as $menu)
                                @if($menu->title !== 'Home')
                                    <li>
                                        <a href="{{$menu->slug}}">{{$menu->title}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-12">
                    <p class="copy_right text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/ footer end  -->

<!-- JS here -->
<script src="{{asset('applab/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<script src="{{asset('applab/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('applab/js/popper.min.js')}}"></script>
<script src="{{asset('applab/js/bootstrap.min.js')}}"></script>
<script src="{{asset('applab/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('applab/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('applab/js/ajax-form.js')}}"></script>
<script src="{{asset('applab/js/waypoints.min.js')}}"></script>
<script src="{{asset('applab/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('applab/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('applab/js/scrollIt.js')}}"></script>
<script src="{{asset('applab/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('applab/js/wow.min.js')}}"></script>
<script src="{{asset('applab/js/nice-select.min.js')}}"></script>
<script src="{{asset('applab/js/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('applab/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('applab/js/plugins.js')}}"></script>
<script src="{{asset('applab/js/gijgo.min.js')}}"></script>
<script src="{{asset('applab/js/contact.js')}}"></script>
<script src="{{asset('applab/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('applab/js/jquery.form.js')}}"></script>
<script src="{{asset('applab/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('applab/js/mail-script.js')}}"></script>
<script src="{{asset('applab/js/main.js')}}"></script>
</body>

</html>
