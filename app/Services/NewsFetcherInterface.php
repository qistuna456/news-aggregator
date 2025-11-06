<?php

namespace App\Services;

interface NewsFetcherInterface
{
    /**
     * Fetch articles from an API and return normalized arrays
     */
    public function fetch(array $params = []): array;
}
