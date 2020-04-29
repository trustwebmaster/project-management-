@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
  @if(auth()->user()->isAdmin())
    <div class="col-md-6">
      <h1 class="m-0 text-white" style="color: white;">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right bg-dark">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v2</li>
      </ol>
    </div><!-- /.col -->
    <div class="card border-dark bg-primary">
      <div class="card-header border-dark bg-primary"><h2>Statistics Overview</h2></div>
      <div class="card-body border-dark bg-primary">
        <table class="table table-bordered table-dark">
          <thead>
            <th>Total Users</th>
            <th>Companies</th>
            <th>Projects</th>
            <th>Tasks</th>
            <th>Comments</th>
          </thead>
          <tbody>
            <tr>
              <td>{{ $users->count() }}</td>
              <td>{{ $companies->count() }}</td>
              <td>{{ $projects->count() }}</td>
              <td>{{ $tasks->count() }}</td>
              <td>{{ $comments->count() }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
      @else
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  @endif
    
@endsection

