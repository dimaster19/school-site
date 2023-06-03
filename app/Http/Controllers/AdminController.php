<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Админ-панель';
        $tables = ['news', 'ranks', 'employees'];
        Rank::factory(5)->create();
        return view('admin-panel', compact('title', 'tables'));
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

        DB::table($request->db)->insert($request->data);
    }

    public function updateRow(Request $request)
    {
        DB::table($request->db)->where('id', $request->id)->update($request->data);
    }

    public function removeRow(Request $request)
    {
        DB::table($request->db)->where('id', $request->id)->delete();
    }

    public function uploadFiles(Request $request)
    {

        foreach ($request->files as &$file) {

            $file[0]->move(public_path('build/'.$request->path), $file[0]->getClientOriginalName());
        }
    }
}
