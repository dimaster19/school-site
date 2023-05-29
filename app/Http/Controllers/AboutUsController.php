<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function index()
    {
        $title = 'Информация о школе №43 г.Донецк';
        $workers = $this->getWorkers();

        return view('aboutUs', compact( 'workers', 'title'));
    }

    public function getWorkers()
    {
        $workers = Employee::join('ranks', 'employees.rank_id', '=', 'ranks.id')
            ->select('employees.*', 'ranks.rank_name')
            ->get();

        $director = array(); $teachers = array(); $vice_directors = array();
        foreach ($workers as &$worker) {
            if ($worker->rank_name == 'Директор') {
                $director[] = $worker;
            }
            else if ($worker->rank_name == 'Заместитель директора') {
                $vice_directors[] = $worker;
            }
            else if ($worker->rank_name == 'Учитель' or $worker->rank_name == 'Воспитатель') {
                $teachers[] = $worker;
            }

        }

       $workers = (object)[
            'director' => $director,
            'vice_directors' => $vice_directors,
            'teachers' => $teachers,
        ];

        return $workers;
    }
}
