<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\Company;
use App\Project;
use App\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $companies = Company::all();
        $projects = Project::all();
        $tasks = Task::all();
        $comments = Comment::all();
        return view('home', compact('users', 'companies', 'projects', 'tasks', 'comments'));
    }
}
