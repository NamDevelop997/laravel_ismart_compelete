@extends('layouts.admin')

@section('content')

    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold text-primary">
                Sửa sản phẩm
            </div>

            <div class="card-body">
                <form method="post" action="{{ url('/dashboard/product/update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" >
                        <label for="name" class="font-weight-bold">Tên sản phẩm</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $product->name }}">
                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity"  class="font-weight-bold">Số lượng</label>
                        <input class="form-control" type="number" name="quantity" id="quantity" min='1'
                            value="{{ $product->quantity }}">
                        @error('quantity')
                            <small class="text-danger">
                                {{ $message }}

                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price" class="font-weight-bold">Giá</label>
                        <input class="form-control" type="number" name="price" id="price" min="1"
                            value="{{ $product->price }}">
                        @error('price')
                            <small class="text-danger">
                                {{ $message }}

                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="font-weight-bold">Mô tả sản phẩm</label>

                        <textarea id="content" name="content" class="form-control" name="content" id="content">
                                  {!! $product->content !!}
                        </textarea>
                        @error('content')
                            <small class="text-danger">
                                {{ $message }}

                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail" class="font-weight-bold">Ảnh đại diện sản phẩm</label>
                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">

                        @error('thumbnail')
                            <small class="text-danger">
                                {{ $message }}

                            </small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" name="btn_add" value="add-product">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>

@endsection
