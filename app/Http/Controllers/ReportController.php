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

        return PDF::loadView('financials', compact('datas'))
            ->stream();
    }
}
