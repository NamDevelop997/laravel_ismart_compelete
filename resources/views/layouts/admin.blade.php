<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">

    {{-- tiny editer --}}
    <script src="https://cdn.tiny.cloud/1/usi5l5c1qyne02r6q19yu9vbrnez7ipisjh5svm07bntkfek/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">

    <title>Admintrator</title>
</head>

<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="{{ route('dashboard') }}">ISMART ADMIN</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('/dashboard/post/add') }}">Thêm bài viết</a>
                        <a class="dropdown-item" href="{{ url('/dashboard/product/add') }}">Thêm sản phẩm</a>

                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                        @php
                            $admin = Auth::user()->role_id == 1;
                            echo $admin ? '(Admin)' : '';
                        @endphp
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item " data-toggle="modal" data-target="#profile" href="#">Tài khoản</a>
                        <a class="dropdown-item " href="{{ url('/') }}">Xem trang web</a>
                        <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            {{-- modal profile --}}
            <div class="modal fade" id="profile" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title text-center" id="staticBackdropLabel">Thông tin tài khoản</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            @php
                                $profile_user = Auth::user();
                            @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>UserName: </th>
                                        <th>{{ $profile_user->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <th>{{ $profile_user->email }}</th>
                                    </tr>
                                    <tr>
                                        <th>Quyền:</th>
                                        <th>{{ $profile_user->role_id == 1 ? 'Admintrator' : '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>Thời gian tạo tài khoản:</th>
                                        <th>{{ $profile_user->email_verified_at }}</th>
                                    </tr>
                                </thead>

                            </table>


                        </div>

                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
            {{-- end modal profile --}}

            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    <li class="nav-link">
                        <a href="{{ url('/dashboard') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa fa-tachometer-alt text-primary"></i>
                            </div>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ url('/dashboard/post/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa fa-file-alt text-primary"></i>
                            </div>
                            Bài viết
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('/dashboard/post/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('/dashboard/post/list') }}">Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-link">
                        <a href="{{ url('/dashboard/product/list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa fa-shopping-cart text-primary"></i>
                            </div>
                            Sản phẩm
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{ url('/dashboard/product/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('/dashboard/product/list') }}">Danh sách</a></li>
                        </ul>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('users.list') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fa fa-users text-primary"></i>
                            </div>
                            Users
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ url('/dashboard/user/add') }}">Thêm mới</a></li>
                            <li><a href="{{ url('dashboard/user/list') }}">Danh sách</a></li>
                        </ul>
                    </li>


                </ul>
            </div>
            <div id="wp-content">
                @yield('content')      
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
        var editor_config = {
            path_absolute: "http://localhost/laravel_ismart_project/",
            selector: 'textarea',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>

    <script src="{{ asset('public/js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
