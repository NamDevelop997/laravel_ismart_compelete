<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        $products = Product::paginate(20);
        return view('product',compact('products'));
    }

    function add()
    {
        return view('layouts.product.add_product');
    }


    function edit($id)
    {
        $product = Product::find($id);
        return view('layouts.product.edit_product', compact('product'));
    }

    function update(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required | string | min:6 | max:255',
                // dd(1),
                'quantity' => 'required | numeric | min:1|',
                'price' => 'required | numeric | min:1',
                'content' => 'required | string | min:6',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [],
            [
                'name' => "Tên sản phẩm",
                'quantity' => "Số lượng",
                'price' => "Giá",
                'thumbnail' => "Ảnh đại diện",

            ]
        );

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $file->move('public/uploads/products/', $fileName);
            $thumbnail = 'public/uploads/products/' . $fileName;
        }

        Product::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
                'thumbnail' => $thumbnail,
            ]);

        return redirect('dashboard/product/list')->with('success', 'Cập nhật sẩn phẩm thành công!');
    }

    function delete($id)
    {
        Product::where('id', $id)->delete();
        return back()->with('success', 'Xóa sản phẩm thành công!');
    }


    function show(Request $request)
    {
        $url = $request->input('status');
        $keyword = "";
        $count_products = Product::count();
        $count_products_trash = Product::onlyTrashed()->count();
        $count = [$count_products, $count_products_trash];
        $act = [];
        if ($url == "trash") {
            $act = [
                'restore' => "Khôi phục",
                'destroy' => "Xóa vĩnh viễn",
            ];
            $products = Product::onlyTrashed()->paginate(20);
        } else {
            $act = [
                'softdelete' => "Xóa tạm thời",
            ];

            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $products = Product::where('name', 'like', "%{$keyword}%")->paginate(20);
        }

        return view('layouts.product.list_product', compact(['products', 'count', 'act']));
    }


    function store(Request $request)
    {

        $request->validate(
            [
                // dd(23),
                'name' => 'required | string | min:6 | max:255 |unique:products',
                // dd(1),
                'quantity' => 'required | numeric | min:1|',
                'price' => 'required | numeric | min:1',
                'content' => 'required | string | min:6',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [],
            [
                'name' => "Tên sản phẩm",
                'quantity' => "Số lượng",
                'price' => "Giá",
                'thumbnail' => "Ảnh đại diện",

            ]
        );


        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $file->move('public/uploads/products/', $fileName);
            $thumbnail = 'public/uploads/products/' . $fileName;
        }

        Product::create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'thumbnail' => $thumbnail,
        ]);

        return redirect('dashboard/product/list')->with('success', 'Một sản phẩm vừa được thêm!');
    }


    function action(Request $request)
    {
        $act = $request->input('act');
        // dd($act);
        $list_check = $request->input('list_check');
        // dd($list_check);
        // $count_list_check = count($list_check);
        // // dd(count($list_check));

        if (!empty($list_check) and !empty($act)) {
            switch ($act) {
                case 'softdelete':
                    $count_list_check = count($list_check);
                    Product::destroy($list_check);
                    return redirect('dashboard/product/list')->with('success', "$count_list_check sản phẩm đã đưa vào thùng rác!");
                case 'restore':
                    $count_list_check = count($list_check);
                    Product::whereIn('id', $list_check)->restore();
                    return redirect('dashboard/product/list')->with('success', " Khôi phục $count_list_check sản phẩm thành công!");
                case 'destroy':
                    $count_list_check = count($list_check);
                    Product::onlyTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();

                    return redirect('dashboard/product/list')->with('success', "Đã xóa vĩnh viễn $count_list_check sản phẩm được chọn!");

                default:
                    return back()->with('success', 'Vui lòng chọn chức năng và click vào ô muốn thao tác!');
            }
        } else {
            return back()->with('success', 'Vui lòng chọn chức năng');
        }
    }
}
