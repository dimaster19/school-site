<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Админ-панель';
        if (Auth::check() && Auth::user()->super == true) {
            $tables = ['news', 'ranks', 'employees', 'notifies', 'users'];
            return view('admin-panel', compact('title', 'tables'));
        } else if (Auth::check() && Auth::user()->super == false) {
            $tables = ['news', 'ranks', 'employees', 'notifies'];
            return view('admin-panel', compact('title', 'tables'));
        }
    }

    public function getColumns(Request $request)
    {
        return Schema::getColumnListing($request->table_name);
    }

    public function getRow(Request $request)
    {

        return DB::table($request->db)->find($request->id);
    }

    public function createRow(Request $request)
    {
        $data = $request->data;
        $data['created_at'] = \Carbon\Carbon::now();
        $data['updated_at'] = \Carbon\Carbon::now();
        if ($request->db == "users") {
            $data['password'] = Hash::make($data['password']);
        }
        DB::table($request->db)->insert($data);
    }

    public function updateRow(Request $request)
    {

        $data = $request->data;
        $data['updated_at'] = \Carbon\Carbon::now();
        DB::table($request->db)->where('id', $request->id)->update($data);
    }

    public function removeRow(Request $request)
    {
        DB::table($request->db)->where('id', $request->id)->delete();
    }

    public function uploadFiles(Request $request)
    {

        foreach ($request->files as &$file) {

            $file[0]->move(public_path('build/' . $request->path), $file[0]->getClientOriginalName());
        }
    }

    public function viewDb(Request $request, $db)
    {
        $title = ucfirst($db);

        $query =   DB::table($db)->orderBy('id')->paginate(30);

        $columns =  Schema::getColumnListing($db);

        return view('viewdb', compact('query', 'columns', 'title'));
    }
}
