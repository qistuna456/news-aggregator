<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Source;

class SourcesTableSeeder extends Seeder
{
    public function run(): void
    {
        $sources = [
            ['key' => 'newsapi', 'name' => 'NewsAPI', 'base_url' => 'https://newsapi.org'],
            ['key' => 'guardian', 'name' => 'The Guardian', 'base_url' => 'https://content.guardianapis.com'],
            ['key' => 'nytimes', 'name' => 'New York Times', 'base_url' => 'https://api.nytimes.com'],
            ['key' => 'guardian', 'name' => 'The Guardian', 'base_url' => 'https://content.guardianapis.com'],
            ['key' => 'nytimes', 'name' => 'New York Times', 'base_url' => 'https://api.nytimes.com'],

        ];

        foreach ($sources as $s) {
            Source::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
