@extends('layouts.default')
@section('title',$article->title)
@section('content')
  <div class="container mb-5">
      <div class="markdown">
        {!! $article->content !!}
      </div>
  </div>
@stop
