<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function show(Request $request)
    {

        $url = $request->input('status');
        $keyword = "";
        $count_users_active = User::whereNotNull('email_verified_at')->count();
        $count_users_non_active = User::whereNull('email_verified_at')->count();
        $count_users_trash = User::onlyTrashed()->count();
        $count = [$count_users_active, $count_users_non_active, $count_users_trash];
        $act = [];
        if ($url == "trash") {
            $act = [
                'restore' => "Khôi phục",
                'destroy' => "Xóa vĩnh viễn",
            ];
            $users = User::onlyTrashed()->paginate(20);
        } elseif ($url == "non_active") {
            $act = [
                'softdelete' => "Xóa tạm thời",
                'destroy' => "Xóa vĩnh viễn",
            ];
            $users = User::whereNull('email_verified_at')->paginate(20);
        } else {
            $act = [
                'softdelete' => "Xóa tạm thời",
            ];

            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users = User::where('name', 'like', "%{$keyword}%")->whereNotNull('email_verified_at')->paginate(20);
        }

        return view('layouts.user.user_list', compact(['users', 'count', 'act']));
    }

    function add()
    {
        return view('layouts.user.add_user');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required | string | min:6 | max:255',
                'email' => 'required | string | email | max:255 | min:15| unique:users',
                'password' => 'required | string | min:8 | confirmed'
            ],
            [],
            [
                'name' => "Họ và tên",
            ]

        );

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('dashboard/user/list')->with('success', 'Thêm thành viên thành công!');
    }

    function edit($id)
    {
        $user = User::find($id);
        return view('layouts.user.edit_user', compact('user'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required | string | min:6 | max:255',
                // 'email' => 'required | string | email | max:255 | min:15| unique:users',
                'password' => 'required | string | min:8 | confirmed'
            ],
            [],
            [
                'name' => "Họ và tên",
            ]

        );

        User::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                // 'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

        return redirect('dashboard/user/list')->with('success', 'Update user thành công!');
    }

    function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with('success', 'Xóa user thành công!');
    }

    function action(Request $request)
    {
        $act = $request->input('act');
        $list_check = $request->input('list_check');
        // dd(1);
        // dd($list_check);
        // $count_users = sizeof($list_check);


        if (!empty($list_check) and !empty($act)) {
            // dd(1);
            switch ($act) {
                case 'softdelete':
                    $count_list_check = count($list_check);

                    User::destroy($list_check);
                    return back()->with('success', "$count_list_check tài khoản đã được đưa vào thùng rác!");
                case 'restore':
                    $count_list_check = count($list_check);

                    User::whereIn('id', $list_check)->restore();
                    return redirect('dashboard/user/list')->with('success', "$count_list_check tài khoản đã được khôi phục lại!");
                case 'destroy':
                    $count_list_check = count($list_check);

                    User::onlyTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();

                    return back()->with('success', "{ $count_list_check } tài khoản đã bị xóa vĩnh viễn!");

                default:
                    return back()->with('success', 'Vui lòng chọn chức năng và click vào ô muốn thao tác!');
            }
        } else {
            return back()->with('success', 'Vui lòng chọn chức năng và click vào ô muốn thao tác!');
        }
    }
}
