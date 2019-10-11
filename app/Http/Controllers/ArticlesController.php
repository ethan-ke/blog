<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Auth;
use App\Markdown\Markdown;

class ArticlesController extends Controller
{
    protected $markdown;
    public function __construct(Markdown $markdown)
    {
      $this->markdown = $markdown;
    }

    public function create()
    {
      return view('articles.create');
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'title' => 'required',
        'content' => 'required'
      ]);

      Auth::user()->articles()->create([
        'title' => $request->title,
        'content' => $request->content,
      ]);
      return [];
    }

    public function show(Article $article)
    {
      $article->content = $this->markdown->markdown($article->content);
      return view('articles.show',compact('article'));
    }

    public function edit(Article $article)
    {
      $this->authorize('own',$article);
      return view('articles.edit',compact('article'));
    }

    public function update(Article $article,Request $request)
    {
      $this->validate($request,[
        'title' => 'required',
        'content' => 'required'
      ]);
      $article->fill($request->all());
      $article->save();
      return [];
    }

    public function destroy(Article $article)
    {
      $this->authorize('own',$article);
      $article->delete();
      session()->flash('success', 'Deleted！');
      return redirect()->back();
    }
}
