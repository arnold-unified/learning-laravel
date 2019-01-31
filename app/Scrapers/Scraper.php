<?php

namespace App\Scrapers;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Console\Output\OutputInterface;

class Scraper
{
    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $consoleOutput;

    /**
     * Starts the scraping.
     * 
     * @param string $url 
     */
    public function startScraping($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $crawler->filter('.post')->each(function (Crawler $nodeCrawler) {
            $timestamp = date('Y-m-d H:i:s');
            $this->consoleOutput->writeln("<comment>[{$timestamp}]:</comment>");

            // Post Details
            $postTitle = trim($nodeCrawler->filter('h2 > a')->first()->text());
            $postUri = $nodeCrawler->selectLink($postTitle)->link()->getUri();
            $this->consoleOutput->writeln("<info>Post Title: {$postTitle}</info>");
            $this->consoleOutput->writeln("<info>Post Uri: {$postUri}</info>");

            // Date Posted
            $postedAt = trim($nodeCrawler->filter('.metadata > span')->first()->text());
            $this->consoleOutput->writeln("<info>Posted At: {$postedAt}</info>");

            // Author Details
            $authorNode = $nodeCrawler->filter('.metadata > span')->last();
            $authorName = trim($authorNode->filter('a')->last()->text());
            $authorLink = $authorNode->selectLink($authorName)->link()->getUri();
            $this->consoleOutput->writeln("<info>Author Name: {$authorName}</info>");
            $this->consoleOutput->writeln("<info>Author Link: {$authorLink}</info>");

            // Author Image
            $authorImageUri = $authorNode->filter('a')->first()->selectImage("Avatar of {$authorName}")->image()->getUri();
            $this->consoleOutput->writeln("<info>Author Image Link: {$authorImageUri}</info>");

            $this->consoleOutput->writeln("<comment></comment>");
        });
    }

    /**
     * Set the output interface.
     * 
     * @param \Symfony\Component\Console\Output\OutputInterface $consoleOutput
     */
    public function setOutput(OutputInterface $consoleOutput)
    {
        $this->consoleOutput = $consoleOutput;
    }
}