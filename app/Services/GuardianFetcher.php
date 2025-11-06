<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class GuardianFetcher implements NewsFetcherInterface
{
    protected Client $client;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GUARDIAN_KEY', '');
        $this->client = new Client(['base_uri' => 'https://content.guardianapis.com/']);
    }

    public function fetch(array $params = []): array
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Missing Guardian API key.');
        }

        $response = $this->client->get('search', [
            'query' => array_merge([
                'q' => 'technology',
                'show-fields' => 'headline,trailText,bodyText,byline,thumbnail',
                'api-key' => $this->apiKey,
                'page-size' => 20,
            ], $params),
        ]);

        $payload = json_decode((string) $response->getBody(), true);
        $articles = [];

        foreach ($payload['response']['results'] ?? [] as $item) {
            $fields = $item['fields'] ?? [];

            $articles[] = [
                'external_id' => Arr::get($item, 'id'),
                'title' => Arr::get($fields, 'headline'),
                'summary' => Arr::get($fields, 'trailText'),
                'content' => Arr::get($fields, 'bodyText'),
                'author' => Arr::get($fields, 'byline'),
                'url' => Arr::get($item, 'webUrl'),
                'url_to_image' => Arr::get($fields, 'thumbnail'),
                'category' => Arr::get($item, 'sectionName'),
                'published_at' => Arr::get($item, 'webPublicationDate'),
                'raw' => $item,
            ];
        }

        return $articles;
    }
}
