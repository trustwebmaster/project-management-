@extends('layouts.app')

@section('content')

  <h1>Project Materials</h1>
     <div class="container col-md-4 col-sm-4 pull-left" >
      {!! Form::open(['url' => 'items/submit']) !!}
                <div class="form-group">
                  {{Form::label('product_name', 'Product Name')}}
                  {{Form::text('product_name', '', ['class' => 'form-control', 'placeholder' => 'Enter Product name'])}}
                </div>
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
      <div class="col-md-7 col-sm-7 pull-right">
      @include('messages')
      </div>
      </div>
@endsection