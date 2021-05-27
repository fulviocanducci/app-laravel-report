<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{    
    public function __construct(public Person $model) 
    {
        $this->model = $model;
    }

    public function index()
    {
        $datas = $this->model
            ->has('processes.financials')
            ->with('processes.financials')
            ->select(['id', 'name', 'fantasy'])
            ->get();

        $data_ini = "03/03/1993";
        $data_end = "04/03/1993";

        return PDF::loadView('financials', compact('datas', 'data_ini', 'data_end'))
            ->stream();
    }

    public function test()
    {
        $datas = $this->model
            ->whereHas(
                
                    'processes.financials', function($query) {
                        $query->where('financials.due_date', ['1999-01-01','1999-01-02']);
                    }
                
            )
            ->with('processes.financials')
            ->select(['id', 'name', 'fantasy'])
            ->get();
        return response()
            ->json($datas, 200);
    }

    public function bootstrap()
    {
        return PDF::loadView('bootstrap')
            ->stream();
    }
}
