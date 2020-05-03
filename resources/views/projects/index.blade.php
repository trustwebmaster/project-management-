
@extends('layouts.app')
@section('content')
  <div class="col-md-4">
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">Quick Access</span>
      </div>
      <div class="panel-body">
        <a class="btn btn-primary" href="/projects/create">Add project</a>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class ="panel">
      <div class="panel-heading">
        <span class="panel-title">Projects</span>
        {{-- <a class="pull-right btn btn-primary btn-sm" href="/companies">
          Create New
        </a> --}}
      </div>
      <div class="panel-body">
        <div class="list-group">
          @foreach($projects  as $project)
            <a href="/projects/{{ $project->id }}" class="list-group-item">{{ $project->name }}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
