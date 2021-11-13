@extends('layouts.admin')

@section('content')

    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>

            <div class="card-body">
                <form method="post" action="{{ url('/dashboard/post/store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input class="form-control" type="text" name="title" id="title">
                        @error('title')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Mô tả bài viết</label>
                        <textarea id="content" name="content" class="form-control" name="content" id="content">
                            </textarea>
                        @error('content')
                            <small class="text-danger">
                                {{ $message }}

                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Ảnh đại diện bài viết</label>
                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">

                        @error('thumbnail')
                            <small class="text-danger">
                                {{ $message }}

                            </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" name="btn_add" value="add-post">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>

@endsection
