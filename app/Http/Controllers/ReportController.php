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
            ->with('processes.financials')
            ->select(['id', 'name', 'fantasy'])
            ->get();

        $data_ini = "03/03/1993";
        $data_end = "04/03/1993";

        return PDF::loadView('financials', compact('datas', 'data_ini', 'data_end'))
            ->stream();
    }
}
