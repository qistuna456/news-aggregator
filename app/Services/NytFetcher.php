<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class NytFetcher implements NewsFetcherInterface
{
    protected Client $client;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NYT_KEY', '');
        $this->client = new Client(['base_uri' => 'https://api.nytimes.com/svc/topstories/v2/']);
    }

    public function fetch(array $params = []): array
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Missing NYT API key.');
        }

        $response = $this->client->get('technology.json', [
            'query' => ['api-key' => $this->apiKey],
        ]);

        $payload = json_decode((string) $response->getBody(), true);
        $articles = [];

        foreach ($payload['results'] ?? [] as $item) {
            $articles[] = [
                'external_id'   => Arr::get($item, 'uri'),
                'title'         => Arr::get($item, 'title'),
                'summary'       => Arr::get($item, 'abstract'),
                'content'       => Arr::get($item, 'abstract'),
                'author'        => Arr::get($item, 'byline'),
                'url'           => Arr::get($item, 'url'),
                'url_to_image'  => Arr::get($item, 'multimedia.0.url'),
                'category'      => Arr::get($item, 'section'),
                'published_at'  => Arr::get($item, 'published_date'),
                'raw'           => $item,
            ];
        }

        return $articles;
    }
}
