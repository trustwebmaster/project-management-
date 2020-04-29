@extends('layouts.app')

@section('content')
  <h1>Messages</h1>
  @if(count($messages) > 0)
    @foreach($messages as $message)
      <ul class="list-group">
        <li class="list-group-item">Product Name: {{$message->product_name}}</li>
        <li class="list-group-item">Quantity: {{$message->quantity}}</li>
        <li class="list-group-item">Date: {{$message->date}}</li>
      </ul>
    @endforeach
  @endif
@endsection