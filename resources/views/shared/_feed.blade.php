@if ($articles->count() > 0)
  <ul class="list-unstyled">
    @foreach ($articles as $article)
      @include('articles.index',  ['user' => $article->user])
    @endforeach
  </ul>
  <div class="mt-5">
    {!! $articles->render() !!}
  </div>
@else
  <p>没有数据！</p>
@endif
