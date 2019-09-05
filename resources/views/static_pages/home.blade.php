@extends('layouts.default')
@section('title','Home')
@section('content')
  @if (Auth::check())
  <div class="row">
    <div class="col-md-8">
      <section class="status_form">
        @include('shared._status_form')
      </section>
      <h4>Article list</h4>
      <hr>
      @include('shared._feed')
    </div>
    <aside class="col-md-4">
      <section class="user_info">
        @include('shared._user_info', ['user' => Auth::user()])
      </section>
    </aside>
  </div>
  @else
  <div class="jumbotron">
    <h1>Hello Laravel</h1>
    <p class="lead">
      Laravel
    </p>
    <p>
      一切，将从这里开始。
    </p>
    <p>
      <a class="btn btn-lg btn-success" href="{{route('signup')}}" role="button">Now Sign up!</a>
    </p>
  </div>
  @endif
@stop
