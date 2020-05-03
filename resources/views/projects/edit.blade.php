@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-md-8" >
        <div class="panel">
            <div class="panel-heading">
                <h1>  Upadate Project </h1>
            </div>
            <div class="panel-body">
                <form method="post" action ="{{ route('projects.update',[ $project->id ]) }}">
                    {{  csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label for ="project-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter Name" id="project-name" required name="name" spellcheck="false" class="form-control" value="{{ $project->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="project-content">Description</label>
                            <textarea placeholder="Enter Descrition"
                                style="resize:vertical"
                                id="project-content"
                                name="description"
                                rows="5" spellcheck="false"
                                class="form-control autosize-target text-left">{{ $project->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class ="list-unstyled">
                <li><a href="/projects/{{ $project->id }}">View projects</a></li>
                <li><a href="/projects">All projects</a></li>
            </ol>
        </div>
    </div>
</div>


@endsection



