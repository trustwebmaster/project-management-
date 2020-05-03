@extends('layouts.app')

@section('content')
  <div class="col-md-9">
    <div class="panel">
      <div class="panel-heading">
        <h1>Create new project </h1>
      </div>
      <div class="panel-body">
        <form method="post" action="{{ route('projects.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
              <label for="project-name">Name<span class="required">*</span></label>
              <input placeholder="Enter name" id="project-name" required name="name" spellcheck="false" class="form-control" />
          </div>
  
          @if($companies == null)
          <input class="form-control" type="hidden" name="company_id" value="{{ $company_id }}" />
          @endif
  
          @if($companies != null)
          <div class="form-group">
              <label for="company-content">Select company</label>
              <select name="company_id" class="form-control" >
                @foreach($companies as $company)
                  <option value="{{$company->id}}"> {{$company->name}} </option>
                @endforeach
              </select>
          </div>
          @endif
  
          <div class="form-group">
            <label for="project-content">Description</label>
            <textarea placeholder="Enter description" style="resize: vertical" id="project-content" name="description" rows="5" spellcheck="false" class="form-control autosize-target text-left"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit"/>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="sidebar-module">
      <h4>Actions</h4>
      <ol class="list-unstyled">
        <li><a href="/projects"><i class="fa fa-user-o" aria-hidden="true"></i> My projects</a></li>
      </ol>
    </div>
  </div>
@endsection
