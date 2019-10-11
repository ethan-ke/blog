@extends('layouts.default')
@section('title','Home')
@section('content')
  <div class="row">
    <div class="col-md-6 offset-md-3">
      @include('shared._feed')
    </div>
  </div>
@stop
