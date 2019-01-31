<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;
use App\Scrapers\CrawlLogger;

class CrawlWebsite extends Command
{
    /** @var \Spatie\Crawler\Crawler */
    protected $crawler;

    /** @var \App\Scrapers\CrawlLogger */
    protected $crawlLogger;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:start {url} {--output=log.txt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that crawls a website.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CrawlLogger $crawlLogger)
    {
        parent::__construct();

        $this->crawler = Crawler::create();

        $this->crawlLogger = $crawlLogger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');
        $output = $this->option('output');

        $this->line("Start crawling {$url}...\n");

        $this->crawlLogger->setOutput($this->getOutput());

        if ($output && file_exists($output)) {
            if (! $this->confirm("The output file `{$output}` already exists. Overwrite it? (y/n)")) {
                exit('Aborting...');
            }

            $this->crawlLogger->setOutputFile($output);
        }

        $this->crawler
            ->setCrawlObserver($this->crawlLogger)
            ->startCrawling($url);
    }
}
