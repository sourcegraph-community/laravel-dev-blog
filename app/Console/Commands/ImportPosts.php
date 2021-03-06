<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Minicli\Curly\Client;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts from DEV.to';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $crawler = new Client();
        $headers = [
            'User-Agent: curly 0.1',
        ];

        $articles_response = $crawler->get('https://dev.to/api/articles?username=erikaheidi&per_page=10', $headers);

        if ($articles_response['code'] !== 200) {
            var_dump($articles_response);
            $this->error('Error while contacting the dev.to API.');

            return Command::FAILURE;
        }

        $articles = json_decode($articles_response['body'], true);
        foreach ($articles as $article) {
            $article_slug = $article['slug'];
            $published = new Carbon($article['published_at']);
            $filename = $published->format('YmdH') . '-' . $article_slug .'.md';

            if (Storage::disk('local')->exists($filename)) {
                continue;
            }

            $endpoint = sprintf('https://dev.to/api/articles/%s', $article['id']);
            $article_query = $crawler->get($endpoint, $headers);

            if ($article_query['code'] == 200) {
                $article_full = json_decode($article_query['body'], true);

                Storage::disk('local')->put($filename, $article_full['body_markdown']);

                $this->info("Article saved: " . $filename);
            }
        }

        return Command::SUCCESS;
    }
}
