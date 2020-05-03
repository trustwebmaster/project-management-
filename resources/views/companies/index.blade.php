
@extends('layouts.app')
@section('content')
<div class="col-md-4">
  <div class="panel">
    <div class="panel-heading" >
      <span class="panel-title">Quick Access</span>
    </div>
    <div class="panel-body">
      <a class="btn btn-primary" href="/companies/create">
        Create New
      </a>
    </div>
  </div>
</div>
<div class="col-md-8">
<div class ="panel">
    <div class="panel-heading">
      <span class="panel-title">Companies</span>
    </div>
    <div class="panel-body">

      <ul class="list-group">

        @foreach($companies  as $company)
      <li class="list-group-item"><a href="/companies/{{ $company->id }}">{{ $company->name }}</a></li>
          @endforeach
      </ul>
    </div>
</div>
</div>
@endsection
