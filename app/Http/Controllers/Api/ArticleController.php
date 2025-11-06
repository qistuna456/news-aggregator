<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Source;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('source');

        if ($q = $request->query('q')) {
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('summary', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        if ($source = $request->query('source')) {
            $query->whereHas('source', fn($s) => $s->where('key', $source));
        }

        if ($category = $request->query('category')) {
            $query->where('category', $category);
        }

        if ($author = $request->query('author')) {
            $query->where('author', 'like', "%{$author}%");
        }

        if ($from = $request->query('from')) {
            $query->where('published_at', '>=', $from);
        }

        if ($to = $request->query('to')) {
            $query->where('published_at', '<=', $to);
        }

        $articles = $query->orderBy('published_at', 'desc')
            ->paginate(min(100, $request->query('per_page', 20)));

        return response()->json($articles);
    }

    public function show($id)
    {
        return response()->json(Article::with('source')->findOrFail($id));
    }

    public function sources()
    {
        return response()->json(Source::all());
    }
}
