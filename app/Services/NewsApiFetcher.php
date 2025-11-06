<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class NewsApiFetcher implements NewsFetcherInterface
{
    protected Client $client;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NEWSAPI_KEY');
        $this->client = new Client(['base_uri' => 'https://newsapi.org/v2/']);
    }

    public function fetch(array $params = []): array
    {
        $response = $this->client->get('everything', [
            'query' => array_merge([
                'q' => 'technology',
                'language' => 'en',
                'pageSize' => 20,
                'apiKey' => $this->apiKey,
            ], $params),
        ]);

        $payload = json_decode((string) $response->getBody(), true);
        $articles = [];

        foreach ($payload['articles'] ?? [] as $item) {
            $articles[] = [
                'external_id' => null,
                'title' => Arr::get($item, 'title'),
                'summary' => Arr::get($item, 'description'),
                'content' => Arr::get($item, 'content'),
                'author' => Arr::get($item, 'author'),
                'url' => Arr::get($item, 'url'),
                'url_to_image' => Arr::get($item, 'urlToImage'),
                'category' => null,
                'published_at' => Arr::get($item, 'publishedAt'),
                'raw' => $item,
            ];
        }

        return $articles;
    }
}
