<li class="media mt-4 mb-4">
  <div class="media-body">
    <h5 class="mt-0 mb-1"> <a href="{{route('articles.show',$article)}}" class="text-dark">{{ $article->title }}</a> </h5>
    <small>{{ $article->created_at->diffForHumans() }}</small>
  </div>
  @can('own',$article)
  <a class="btn btn-sm btn-light" href="{{ route('articles.edit',$article) }}">Edit</a>
  @endcan
</li>
