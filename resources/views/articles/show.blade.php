@extends('layouts.default')
@section('title',$article->title)
@section('content')
  <div class="container">
      <div class="markdown">
        {!! $article->content !!}
      </div>
  </div>
@stop
