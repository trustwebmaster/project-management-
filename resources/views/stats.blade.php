@extends('layouts.app')

@section('content')

 @if(auth()->user()->isAdmin())
    <div class="col-md-6">
      <h1 class="m-0 text-white" style="color: white;">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v2</li>
      </ol>
    </div><!-- /.col -->
    <div class="card border-dark bg-primary">
      <div class="card-header border-dark bg-primary"><h2>Platform Users</h2></div>
      <div class="card-body border-dark bg-primary">
        <table class="table table-bordered table-dark">
          <thead>
            <th>Company</th>
            <th>Owner</th>
            <th>Email</th>
          </thead>
          <tbody>
            @foreach($companies as $company)
            <tr>
              <td>{{ $company->name }}</td>
              <td>{{ $company->user->name }}</td>
              <td>{{ $company->user->email }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
      @endif

@endsection