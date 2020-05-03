@extends('layouts.app')

@section('content')

<h1>Project Materials</h1>
<div class="row">
  <div class="col-md-8">
    @include('messages', ['items' => $items])
  </div>
  <div class="col-md-4" >
    <h2>Add items</h2>
    {!! Form::open(['url' => 'items/submit']) !!}
      <div class="form-group"> 
        {{Form::label('product_name', 'Product Name')}}
        {{Form::text('product_name', '', ['class' => 'form-control', 'placeholder' => 'Enter Product name'])}}
      </div>
    <input type="hidden" name="project_id" value="{{ $project->id }}">
      <div class="form-group">
        {{Form::label('quantity', 'Quantity')}}
        {{Form::text('quantity', '', ['class' => 'form-control', 'placeholder' => 'Enter Product Quantity'])}}
      </div>
      <div class="form-group">
        {{Form::label('date ', 'Date Received')}}
        {{Form::text('date', '', ['class' => 'form-control', 'placeholder' => 'month/date/year'])}}
      </div>
      <div>
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
      </div>
    {!! Form::close() !!} 
  </div>
</div>
@endsection