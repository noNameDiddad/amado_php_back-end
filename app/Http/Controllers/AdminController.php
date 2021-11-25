<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin()
    {
        return view('admin.index');
    }

    public function showUsers(Request $request)
    {
        $get_fields = [];
        $data = $request->query->all();
        if (isset($data['fields'])) {
            try {
                $get_fields = explode(',', $data['fields']);
                $data_table = User::select($get_fields)->paginate(20);
                $data_table = $data_table->appends(['fields' => $data['fields']]);
            } catch (\Throwable $throwable) {
                $data_table = User::paginate(20);
                return view('admin.user', compact('data_table', 'throwable'));
            }
        } else {
            $data_table = User::paginate(20);
        }
        $columns = [
            'id',
            'name',
            'email',
            'email_verified_at',
            'role',
            'created_at',
        ];
        return view('admin.user', compact('data_table', 'columns', 'get_fields'));
    }

    public function showCategory(Request $request)
    {
        $get_fields = [];
        $data = $request->query->all();
        if (isset($data['fields'])) {
            try {
                $get_fields = explode(',', $data['fields']);
                $data_table = Category::select($get_fields)->paginate(20);
                $data_table = $data_table->appends(['fields' => $data['fields']]);
            } catch (\Throwable $throwable) {
                $data_table = Category::paginate(20);
                return view('admin.category', compact('data_table', 'throwable'));
            }
        } else {
            $data_table = Category::paginate(20);
        }
        $columns = [
            'id',
            'category',
            'created_at  ',
        ];
        return view('admin.category', compact('data_table', 'columns', 'get_fields'));
    }

    public function showProduct(Request $request)
    {
        $get_fields = [];
        $show_category = false;
        $data = $request->query->all();
        if (isset($data['fields'])) {
            try {
                $get_fields = explode(',', $data['fields']);
                $data_table = Product::select($get_fields)->paginate(20);
                $data_table = $data_table->appends(['fields' => $data['fields']]);
            } catch (\Throwable $throwable) {
                $data_table = Product::paginate(20);
                return view('admin.category', compact('data_table', 'throwable'));
            }
        } else {
            $data_table = Product::paginate(20);
        }
        if (isset($data['expand'])) {
            if ($data['expand'] == 'category') {
                $show_category = true;
            }
        }
        $columns = [
            'id',
            'product',
            'description',
            'number',
            'price',
            'category_id',
            'image_path',
            'created_at',
        ];

        return view('admin.product', compact('data_table', 'columns', 'get_fields', 'show_category'));
    }

    public function setFields(Request $request)
    {
        $fields = $request->all();
        unset($fields['_token']);
        unset($fields['show_category']);
        $show_category = "";
        if (isset($request->all()['show_category'])){
            $show_category = "expand=category";
        }
        if (empty($fields)){
            $url = explode('?', url()->previous());
            $page = explode('/admin', $url[0]);
            return redirect('/admin' . $page[1].'?'.$show_category);
        }else {
            $fields_string = "?fields=";
            foreach ($fields as $field) {
                $fields_string = $fields_string . $field . ",";
            }
            $fields_string = substr($fields_string, 0, -1);
            $url = explode('?', url()->previous());
            $page = explode('/admin', $url[0]);
            return redirect('/admin' . $page[1] . $fields_string.'&'.$show_category);
        }

    }
}
