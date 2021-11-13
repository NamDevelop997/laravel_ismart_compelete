@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <a class=" text-success " href="{{ url('dashboard/post/list') }}" style="text-decoration:underline">Danh
                    sách bài viết</a>

                <div class="form-search form-inline">
                    <form class="d-flex">
                        <input type="text" class="form-control form-search" name="keyword" placeholder="Nhập tên sản phẩm"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">

                <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="btn btn-success rounded p-1">
                    Bài viết({{ $count[0] }})</a>

                <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}"
                    class="btn btn-danger rounded p-1">Thùng
                    rác({{ $count[1] }})</a>

                <form action="{{ url('dashboard/post/action') }}">

                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="act">
                            <option value=''>---Chọn---</option>
                            @foreach ($act as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach

                        </select>
                        <input type="submit" name="btn-search" class="btn btn-primary">
                    </div>
                    @if (session('success'))
                        <div class="alert alert-primary">{{ session('success') }}</div>
                    @endif
                    @if ($posts->count() >= 1)
                        <table class="table table-striped  table-checkall">
                            <thead>
                                <tr class="text-center">
                                    <th>
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên bài viết</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Thời gian tạo</th>
                                    <th scope="col">Cập nhật</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $index = 1;
                                @endphp

                                @foreach ($posts as $post)
                                    <tr class="text-center">

                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $post->id }}">
                                        </td>
                                        <td scope="row">{{ $index++ }}</td>
                                        <td>
                                            <a  data-toggle="modal"
                                                data-target=".bd-example-modal-lg">{{ Str::of($post->title)->limit(30) }}</a>
                                        </td>

                                        {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            {{ $post->title }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div> {!! $post->content !!}</div>
                                                    </div>
                                                </div>

                                               
                                            </div>
                                        </div> --}}

                                        <td>
                                            <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}"
                                                width="50px" height="50px" style="object-fit: cover; border-radius: 5px">
                                        </td>

                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at }}</td>

                                        <td>
                                           <a href=" {{ url('dashboard/post/edit', $post->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                                    
                                          <a href=" {{ route('post.delete', $post->id) }}"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"
                                                onclick="return confirm('Bạn chắc chắn muốn xóa bài viết này?')"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    @else
                        <div class="p-3 mb-2 bg-warning text-dark">Không có bài viết nào!</div>
                    @endif

                </form>
                {{ $posts->links() }}

            </div>
        </div>
    </div>
@endsection
