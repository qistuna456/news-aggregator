<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ArticleService;
use App\Services\NewsApiFetcher;
use App\Services\GuardianFetcher;
use App\Services\NytFetcher;

use App\Models\Source;

class FetchArticlesCommand extends Command
{
    protected $signature = 'fetch:articles {source?}';
    protected $description = 'Fetch latest articles from news APIs and store them in the database';

    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        parent::__construct();
        $this->articleService = $articleService;
    }

    public function handle(): int
    {
        $sourceKey = $this->argument('source');

        // Choose source
        $sources = $sourceKey
            ? Source::where('key', $sourceKey)->get()
            : Source::all();

        if ($sources->isEmpty()) {
            $this->error('No sources found.');
            return Command::FAILURE;
        }

        foreach ($sources as $source) {
            $this->info("Fetching articles from: {$source->name}");

            // TODO: You can add multiple fetchers here (Guardian, NYTimes, etc)
            $fetcher = match ($source->key) {
                'newsapi' => new NewsApiFetcher(),
                'guardian' => new GuardianFetcher(),
                'nytimes'  => new NytFetcher(),
                default => new NewsApiFetcher(), // fallback
            };

            $articles = $fetcher->fetch();
            $count = 0;

            foreach ($articles as $data) {
                $article = $this->articleService->saveFromNormalized($data, $source);
                if ($article) $count++;
            }

            $this->info("Saved {$count} articles from {$source->name}");
        }

        return Command::SUCCESS;
    }
}
