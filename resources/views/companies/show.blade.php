@extends('layouts.app')
@section('content')

 <div class="row col-md-9 col-lg-9 col-sm-9  pull-left">
    <div class="jumbotron">
    <h1>{{ $company->name }}</h1>
     <p  class="lead">{{ $company->description}}</p>
    </div>

    <div class="row col-md-9 col-lg-9 col-sm-9" style="background-color:white; margin:10px;" >
        {{-- <a href="/projects/create" class="pull-right btn btn-default btn-sm">Add Project</a> --}}
        @foreach($company->projects as $project)
         <div class="col-lg-4 col-md-4 col-sm-4">
         <h2>{{ $project->name }}</h2>
         <p class="text-danger">{{ $project->description }}</p>
         <p><a class="btn btn-primary " href="/projects/{{ $project->id}}" role="button">View Project Details</a></p>
         </div>
        @endforeach
    </div>
 </div>

 <div class="col-sm-3 col-md-4 col-lg-3 pull-right">
     <div class="sidebar-module">
         <h4>Actions</h4>
          <ol class ="list-unstyled">
          <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
          <li><a href="/projects/create">Add Project</a></li>
          <li><a href="/companies">Companies</a></li>
          <li><a href="/companies/create">Create New Company</a></li>
              <li>

                <br>

                <a
                href=""
                      onclick="
                        var result =confirm('Are you sure you wish to delete this Project?');
                        if( result ){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();

                           } ">
                           Delete
                </a>
                <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}"
                    method="POST" style="dispaly:none;">
                        <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}

                </li>

          </ol>
     </div>

@endsection



