@extends('layouts.default')
@section('title', 'Signup')

@section('content')
<div class="offset-md-2 col-md-8">
  <div class="card ">
    <div class="card-header">
      <h5>Signup</h5>
    </div>
    <div class="card-body">
      @include('shared._errors')
      <form method="POST" action="{{ route('users.store') }}">
          <div class="form-group">
            <label for="name">Name：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
          </div>

          <div class="form-group">
            <label for="email">Email：</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="password">Password：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirm password：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>

          <button type="submit" class="btn btn-primary">Signup</button>
          {{csrf_field()}}
      </form>
    </div>
  </div>
</div>
@stop
