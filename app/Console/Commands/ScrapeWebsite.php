<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\Scraper;

class ScrapeWebsite extends Command
{
    /** @var \App\Scrapers\Scraper */
    protected $scraper;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:start {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that scrapes a website.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Scraper $scraper)
    {
        parent::__construct();

        $this->scraper = $scraper;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');

        $this->line("Start scraping {$url}...\n");

        $this->scraper->setOutput($this->getOutput());

        $this->scraper->startScraping($url);
    }
}
