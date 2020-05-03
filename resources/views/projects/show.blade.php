@extends('layouts.app')
@section('content')
<div class="row col-md-9 col-lg-9 col-sm-9 pull-left ">
  <div class="well well-lg" >
    <h1>{{ $project->name }}</h1>
    <p class="lead">{{ $project->description }}</p>
  </div>

  
  <div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      @foreach ($items as $item)  
        <li role="presentation"><a href="#{{ strtolower( str_replace(' ', '_', $item->product_name) ) . '_pid_' . $item->id  }}" aria-controls="home" role="tab" data-toggle="tab">{{ $item->product_name }}</a></li>
      @endforeach
    </ul>
  
    <!-- Tab panes -->
    <div class="tab-content">
      @foreach ($items as $item)  
      <div role="tabpanel" class="tab-pane" id="{{ strtolower( str_replace(' ', '_', $item->product_name) ) . '_pid_' . $item->id }}">
        <canvas id="myChart_{{ $item->id }}" width="400" height="150"></canvas>
      </div>
      @endforeach
    </div>
  
  </div>
  <div class="row  col-md-12 col-lg-12 col-sm-12" style="background: white; margin: 10px; ">
    <br/>
    @include('partials.comments')
    <div class="row container-fluid">

      <form method="post" action="{{ route('comments.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="commentable_type" value="App\Project">
        <input type="hidden" name="commentable_id" value="{{$project->id}}">
        <div class="form-group">
          <label for="comment-content">Comment</label>
          <textarea placeholder="Enter comment" style="resize: vertical" id="comment-content" name="body" rows="3" spellcheck="false" class="form-control autosize-target text-left"></textarea>
        </div>
        <div class="form-group">
          <label for="comment-content">Proof of work done (Url/Photos)</label>
          <textarea placeholder="Enter url or screenshots"
            style="resize: vertical"
            id="comment-content"
            name="url"
            rows="2" spellcheck="false"
            class="form-control autosize-target text-left"></textarea>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit"/>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
  <div class="sidebar-module">
    <h4>Actions</h4>
    <ol class="list-unstyled">
      <li><a href="/projects/{{ $project->id }}/edit">
      <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
      <li><a href="/project/{{ $project->id }}/add-items"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Materials</a></li>
      <li><a href="/project/create"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create new project</a></li>
      <li><a href="/projects"><i class="fa fa-user-o" aria-hidden="true"></i> My projects</a></li>
      <li><a href="/projects"><i class="fa fa-user-o" aria-hidden="true"></i> My projects</a></li>
      <!-- Button trigger modal -->
      <br/>
      @if($project->user_id == Auth::user()->id)
        <li>
          <i class="fa fa-power-off" aria-hidden="true"></i>
          <a href="#" onclick="var result = confirm('Are you sure you wish to delete this project?');
            if( result ){
              event.preventDefault();
              document.getElementById('delete-form').submit();
            }">
              Delete
          </a>
          <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}"
            method="POST" style="display: none;">
            <input type="hidden" name="_method" value="delete">
            {{ csrf_field() }}
          </form>
        </li>
      @endif
      <br />
      <li>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
          Update stock
        </button>
      </li>
      <br />
      <li>
        <a href="/project/{{ $project->id }}/print" class="btn btn-success btn-sm">
          Print PDF
        </a>
      </li>
    </ol>
    <hr/>
    <h4>Add members</h4>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12  col-sm-12 ">
      <form id="add-user" action="{{ route('projects.adduser') }}"  method="POST" >
        {{ csrf_field() }}
        <div class="input-group">
          <input class="form-control" name = "project_id" id="project_id" value="{{$project->id}}" type="hidden">
          <input type="text" required class="form-control" id="email"  name = "email" placeholder="Email">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit" id="addMember" >Add!</button>
          </span>
        </div><!-- /input-group -->
        </form>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <br/>
    <h4>Team Members</h4>
    <ol class="list-unstyled" id="member-list">
      @foreach($project->users as $user)
        <li><a href="#"> {{$user->email}} </a> </li>
      @endforeach
    </ol>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <form method="post" action="/project/{{ $project->id }}/update-stock">
        @csrf()
        <div class="modal-body">
          <h3>Stock used today</h3>
          {{-- <div class="alert alert-info">Please leave empty if item was not used</div> --}}
          <input type="hidden" name="project_id" value="{{ $project->id }}">
          @foreach($items as $item)
            <div class="form-group">
              <label>{{ $item->product_name }} Used</label>
              <input type="number" min="0" class="form-control" name="{{ strtolower( str_replace(' ', '_',  $item->product_name) ) . '_pid_' . $item->id }}">
            </div>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@foreach ($items as $item)  
<script>
  var ctx = document.getElementById('myChart_{{ $item->id }}').getContext('2d');
  var data = {!! $item !!}
  var used = data.used;
  var labels = used.map( item => item.created_at );
  var data = used.map( item => item.quantity );
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: '{{ $item->product_name }}',
          data: data,
          backgroundColor: [
              'rgba(255, 255, 255, 0)',
          ],
          borderColor: [
              'rgba(255, 99, 132, 1)',
          ],
          borderWidth: 1
      } 
    ]
    },
    options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true
              }
          }]
      }
    }
  });
</script>
@endforeach
@endsection
















