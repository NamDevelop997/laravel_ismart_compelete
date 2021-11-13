@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <a class=" text-success " href="{{ url('dashboard/user/list') }}" style="text-decoration:underline">Danh
                    sách thành viên</a>

                <div class="form-search form-inline">
                    <form class="d-flex">
                        <input type="text" class="form-control form-search" name="keyword"
                            placeholder="Nhập tên user cần tìm" value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">

                <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="btn btn-success rounded p-1">
                    active ({{ $count[0] }})</a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'non_active']) }}"
                    class="btn btn-warning rounded p-1"> non-active ({{ $count[1] }})</a>

                <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}"
                    class="btn btn-danger rounded p-1">Thùng
                    rác({{ $count[2] }})</a>

                <form action="{{ url('dashboard/user/action') }}">

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
                    @if ($users->count() >= 1)
                        <table class="table table-striped  table-checkall">
                            <thead>
                                <tr class="text-center">
                                    <th>
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Quyền</th>
                                    <th scope="col">Thời gian tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $index = 1;
                                @endphp

                                @foreach ($users as $user)
                                    <tr class="text-center">

                                        @if (Auth::id() != $user->id)
                                            <td>
                                                <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                                            </td>
                                        @else
                                            <td></td>
                                        @endif

                                        <td scope="row">{{ $index++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @php
                                                echo $user->role_id == 1 ? 'Admintrator' : 'User';
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                if ($user->email_verified_at != null) {
                                                    echo $user->email_verified_at;
                                                } else {
                                                    echo "<p  class='btn btn-warning text-dark'>Chưa active email</p>";
                                                }
                                            @endphp
                                        </td>
                                        <td>

                                            @if (Auth::id() != $user->id)
                                                <a href="{{ url('dashboard/user/edit', $user->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ route('user.delete', $user->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                                    onclick="return confirm('Bạn chắc chắn muốn xóa user này?')"><i
                                                        class="fa fa-trash"></i></a>
                                            @else
                                                <a href="{{ url('dashboard/user/edit', $user->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    style="margin-right: 35px;"><i class="fa fa-edit"></i></a>

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    @else
                        <div class="p-3 mb-2 bg-warning text-dark">Không tìm thấy tài khoản nào!</div>
                    @endif

                </form>
                {{ $users->links() }}

            </div>
        </div>
    </div>
@endsection
