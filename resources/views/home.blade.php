<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    {{-- boostrap 4 cdn --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    {{-- font awesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- owl carousel --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="{{ asset('public/css/index.css') }}">
</head>

<body>
    <div>
        {{-- header --}}
        <header class="d-flex justify-content-around ">
            <div class="logo"><a href="{{ url('/') }}">ismart</a></div>
            <nav class="menu">
                <ul class="d-flex justify-content-around ">
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="{{ url('/product') }}">sản phẩm</a></li>
                    <li><a href="{{ url('/post') }}">bài viết</a></li>
                    <li><a href="{{ url('/contact') }}">liên hệ</a></li>
                    <li><a href="123">giỏ hàng</a></li>
                </ul>
            </nav>
            <div class="login_logout">
                <ul class="d-flex">
                    <li><a href="">Đăng nhập </a></li>
                    <li><a href="">đăng xuất</a></li>
                </ul>
            </div>
        </header>
        {{-- end header --}}

        @section('content')

            {{-- owl carousel --}}
            <section class="owl-carousel header owl-theme">
                <div class="item ">
                    <img src="{{ asset('public/images/slider-image-1-1920x900.jpg') }}" alt="">
                    <div class="content">
                        <p> Samsung Galaxy Z Fold3 5G 256GB
                            &nbsp;
                            Lorem, ipsum dolor.
                            &nbsp;</p>
                        <button class="btn btn-warning">MUA NGAY</button>
                    </div>

                </div>
                <div class="item"><img src="{{ asset('public/images/slider-image-2-1920x900.jpg') }}" alt="">
                    <div class="content">
                        <p> iPhone 12 Pro Max
                            &nbsp;
                            Lorem, ipsum dolor Lorem, ipsum dolor..
                            &nbsp;</p>
                        <button class="btn btn-warning">MUA NGAY</button>
                    </div>
                </div>
                <div class="item"><img src="{{ asset('public/images/slider-image-3-1920x900.jpg') }}" alt="">
                    <div class="content">
                        <p> iPhone 13 mini 256GB Lorem ipsum dolor sit amet consectetur.
                            &nbsp;
                            Lorem, ipsum dolor.
                            &nbsp;</p>
                        <button class="btn btn-warning">MUA NGAY</button>
                    </div>
                </div>
            </section>
            {{-- end owl carousel --}}

            {{-- products --}}
            <section class="products m-5">
                <h2 class="text-center text-uppercase">sản phẩm <span>nổi bật</span> </h2>
                <p class="text-center">Những sản phẩm bán chạy trong tháng</p>

                <div class="row mt-5">
                    @foreach ($products as $product)

                        <div class="card col-4  border-0 product w3-animate-left">
                            <img class="card-img-top" src="{{ asset($product->thumbnail) }}" alt="">
                            <div class="card-body text-center">
                                <h4 class="card-title font-weight-bold">{{ Str::of($product->name)->limit(24) }}</h4>
                                <h6 class="card-text price mt-2 mb-2"> <sup>$</sup><span
                                        class="pr-2"><em>2000</em>
                                    </span> <sup>$</sup>{{ number_format($product->price, 0, ',', '.') }}
                                </h6>
                                <a href="" class="btn btn-warning mt-2  pl-3 pr-3">Mua ngay</a>

                            </div>
                        </div>
                    @endforeach

                </div>
                {{-- {{ $products->links() }} --}}
            </section>
            {{-- end products --}}

            {{-- post --}}
            <section class="post m-5">
                <h2 class="text-center text-uppercase">BÀI Viết <span>mới</span> </h2>
                <p class="text-center subtitle">Những bài viết hay trong tuần</p>
                <div class="row mt-5">
                    <div class="col-5 post-content">
                        <ul>

                            @foreach ($posts as $post)
                                <li class=" w3-animate-left">
                                    <div class="row">
                                        <div class="col-6 text-center p-0">
                                            <img src="{{ $post->thumbnail }}" alt="" width="80%" height="100">
                                        </div>
                                        <div class="col-6 text-left p-0">
                                            <a href="">{{ $post->title }}</a> </a>
                                            <p>{{ $post->created_at }}</p>
                                        </div>
                                    </div>
                                </li>

                            @endforeach

                            <li>
                                <div class=" post-btn text-center">
                                    <a href="{{ url('post') }}" class="">Xem thêm</a>
                                </div>
                            </li>

                        </ul>

                    </div>

                    <div class="col-7">
                        <div>
                            <img src="{{ asset('public/images/blog-image-1-940x460.jpg') }}" alt="" width="100%"
                                height="auto">
                        </div>
                        <div class="post-subTitle ">
                            <h4 class="post-subTitle-header">
                                Lorem ipsum dolor sit amet, consectetur adipisicing.
                            </h4>
                            <p class="post-subTitle-content">
                                Sed ut dolor in augue cursus ultrices. Vivamus mauris turpis, auctor vel facilisis in,
                                tincidunt vel diam. Sed vitae scelerisque orci. Nunc non magna orci. Aliquam commodo mauris
                                ante, quis posuere nibh vestibulum sit amet.
                            </p>
                        </div>
                    </div>
                </div>


            </section>
            {{-- end post --}}

            {{-- comment --}}
            <section class="comment m-5">
                <div class="comment-header">
                    <h2 class="text-center text-uppercase">Đánh giá <span>nổi bật</span> </h2>
                    <p class="text-center subtitle">Những bình luận về sản phẩm</p>
                </div>
                <div class="owl-carousel comment-slide owl-theme">
                    <div class="item text-center ">
                        <h4 class="comment-name">Nguyễn Quốc Anh</h4>
                        <p class="comment-content">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab minus eius
                            commodi totam nesciunt aut reiciendis voluptates,"</p>
                    </div>
                    <div class="item text-center pl-5 pr-5">
                        <h4 class="comment-name">Hà Thị Hoa</h4>
                        <p class="comment-content text-left">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab
                            minus eius commodi totam nesciunt aut reiciendis voluptates,"</p>
                    </div>

                    <div class="item text-center ">
                        <h4 class="comment-name">Hồ Như Hiền</h4>
                        <p class="comment-content">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab minus eius
                            commodi totam nesciunt aut reiciendis voluptates"</p>
                    </div>

                    <div class="item text-center ">
                        <h4 class="comment-name">Lệnh Hồ Sung</h4>
                        <p class="comment-content">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab minus eius
                            commodi totam nesciunt aut reiciendis voluptates"</p>
                    </div>
                </div>

            </section>
        @show

        {{-- contact --}}
        @section('contact')

            <section class="contact m-5">
                <div class="contact-header">
                    <h2 class="text-center text-uppercase">Thông tin <span>liên hệ</span> </h2>
                    <p class="text-center subtitle">Hãy đóng góp phản hồi của bạn</p>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="contact-item">
                            <i class="fa fa-phone"></i>
                            <h4>Telephone</h4>
                            <p>Hãy gọi cho chúng tôi để đặt hàng và giải đáp thắc mắc về sản phẩm</p>
                            <a href="#">093 6866 868</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="contact-item">
                            <i class="fa fa-envelope"></i>
                            <h4>Email</h4>
                            <p>Gửi những đóng góp của bạn vào hòm thư của chúng tôi</p>
                            <a href="#">ismart1234@gmail.com</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="contact-item">
                            <i class="fa fa-map-marker"></i>
                            <h4>Location</h4>
                            <p>Đến ngay cửa hàng để mua những sản phẩm mới nhất tại:</p>
                            <a href="#">Ngõ 68 - Nguyễn Chí Thanh, Ba Đình, Hà Nội</a>
                        </div>
                    </div>
                </div>
            </section>

        @show
        {{-- end contact --}}

        {{-- footer --}}
        <footer class="row ">
            <div class="col">
                <div class="head">
                    <h3>Liên Kết Mạng Xã Hội</h3>

                </div>
                <p class="social content">Liên kết với cửa hàng chúng tôi để nhận thông tin mới nhất</p>
                <ul class="row justify-content-around">
                    <li><i class="fab fa-facebook-f social-icon"></i></li>
                    <li><i class="fab fa-youtube social-icon"></i></li>
                    <li><i class="fab fa-twitter social-icon"></i></li>
                    <li><i class="fab fa-instagram social-icon"></i></li>
                </ul>
            </div>
            <div class="col">
                <div class="head">
                    <h3>Menu</h3>

                </div>
                <ul class="content">
                    <li><a href="">Trang Chủ</a></li>
                    <li><a href="">Sản Phẩm</a></li>
                    <li><a href="">Bài Viết</a></li>
                    <li><a href="">Liên Hệ</a></li>
                    <li><a href="">Giỏ Hàng </a></li>
                </ul>
            </div>
            <div class="col">
                <div class="head">
                    <h3>Thông tin liên hệ</h3>
                </div>
                <div class="content">
                    <p>Ngõ 68 - Nguyễn Chí Thanh, Ba Đình, Hà Nội</p>
                    <p>SĐT: 093 6866 868</p>
                    <p>Email: ismart1234@gmail.com</p>
                </div>
            </div>
        </footer>
        <h6 class="text-uppercase text-center p-3 end"> ISmart - đồ án tốt nghiệp - Ma Văn Nam</h6>

        {{-- end footer --}}
    </div>

    {{-- boostrap 4 cdn --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('.owl-carousel.header').owlCarousel({
            autoplay: true,
            loop: true,
            autoplayTimeout: 4000,
            animateOut: 'fadeOut',
            // animateInt: 'fadeInt',

            dot: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    </script>

    <script>
        $('.owl-carousel.comment-slide').owlCarousel({
            loop: true,
            nav: true,
            autoplay: 3000,
            // margin: 10,
            navText: ["<i class='fa fa-angle-left arrow'></i>", "<i class='fa fa-angle-right arrow'></i>"],
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>


</body>

</html>
