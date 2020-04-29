<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public function index()
    {	
    	$companies = Company::all();

    	return view('companies', compact('companies'));
    }

    public function home()
    {	
    	$companies = Company::all();

    	return view('stats', compact('companies'));
    }
}
