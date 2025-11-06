<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Source;

class ArticleService
{
    public function saveFromNormalized(array $data, Source $source): ?Article
    {
        if (empty($data['url'])) return null;

        $article = Article::where('url', $data['url'])->first();

        $payload = array_merge($data, [
            'source_id' => $source->id,
            'raw' => $data['raw'] ?? null,
        ]);

        if ($article) {
            $article->update($payload);
            return $article;
        }

        return Article::create($payload);
    }
}
