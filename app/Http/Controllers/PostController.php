<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(6);
        return view('post', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.post.add_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                // dd(23),
                'title' => 'required | string | min:6 | max:255 |unique:posts',
                'content' => 'required | string | min:6',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [],
            [
                'title' => "Tiêu đề",
                'content' => "Nội dung",
                'thumbnail' => "Ảnh đại diện",

            ]
        );


        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $file->move('public/uploads/posts/', $fileName);
            $thumbnail = 'public/uploads/posts/' . $fileName;
        }

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'thumbnail' => $thumbnail,
        ]);

        return redirect('dashboard/post/list')->with('success', 'Thêm bài viết thành công!');
        // return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $url = $request->input('status');
        $keyword = "";
        $count_posts = Post::count();
        $count_posts_trash = Post::onlyTrashed()->count();
        $count = [$count_posts, $count_posts_trash];
        $act = [];
        if ($url == "trash") {
            $act = [
                'restore' => "Khôi phục",
                'destroy' => "Xóa vĩnh viễn",
            ];
            $posts = Post::onlyTrashed()->paginate(20);
        } else {
            $act = [
                'softdelete' => "Xóa tạm thời",
            ];

            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $posts = Post::where('title', 'like', "%{$keyword}%")->paginate(20);
        }

        return view('layouts.post.list_post', compact(['posts', 'count', 'act']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('layouts.post.edit_post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required | string | min:6 | max:255',
                'content' => 'required | string | min:6',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [],
            [
                'title' => "Tiêu đề",
                'content' => "Nội dung",
                'thumbnail' => "Ảnh đại diện",

            ]
        );


        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $file->move('public/uploads/posts/', $fileName);
            $thumbnail = 'public/uploads/posts/' . $fileName;
        }

        Post::where('id', $id)->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'thumbnail' => $thumbnail,
        ]);

        return redirect('dashboard/post/list')->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return back()->with('success', 'Xóa bài viết thành công!');
    }

    function action(Request $request)
    {
        $act = $request->input('act');
        // dd($act);
        $list_check = $request->input('list_check');
        // $count_list_check = count($list_check);
        // dd(count($list_check));

        if (!empty($list_check) and !empty($act)) {
            switch ($act) {
                case 'softdelete':
                    $count_list_check = count($list_check);
                    Post::destroy($list_check);
                    return redirect('dashboard/post/list')->with('success', "{$count_list_check} bài viết đã đưa vào thùng rác!");
                case 'restore':
                    $count_list_check = count($list_check);
                    Post::whereIn('id', $list_check)->restore();
                    return redirect('dashboard/post/list')->with('success', "Khôi phục {$count_list_check} bài viết thành công!");
                case 'destroy':
                    $count_list_check = count($list_check);
                    Post::onlyTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();

                    return redirect('dashboard/post/list')->with('success', "Đã xóa vĩnh viễn {$count_list_check} bài viết được chọn!");

                default:
                    return back()->with('success', 'Vui lòng chọn chức năng và click vào ô muốn thao tác!');
            }
        } else {
            return back()->with('success', 'Vui lòng chọn chức năng!');
        }
    }
}
