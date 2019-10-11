@extends('layouts.default')
@section('title', $user->name)

@section('content')
<div class="row">
  <div class="col-md-8">
    <section class="status">
      @if ($articles->count() > 0)
        <ul class="list-unstyled">
          @foreach ($articles as $article)
            @include('articles.index')
          @endforeach
        </ul>
        <div class="mt-5">
          {!! $articles->render() !!}
        </div>
      @else
        <p>End!</p>
      @endif
    </section>
  </div>
</div>
@stop
