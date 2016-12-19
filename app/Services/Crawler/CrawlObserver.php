<?php

namespace App\Services\Crawler;

use App\Events\UrlHasBeenCrawled;
use App\Services\ResponseAnalysis;
use Spatie\Crawler\Url;

class CrawlObserver implements \Spatie\Crawler\CrawlObserver
{

    /**
     * Called when the crawler will crawl the url.
     *
     * @param \Spatie\Crawler\Url $url
     *
     * @return void
     */
    public function willCrawl(Url $url)
    {

    }

    /**
     * Called when the crawler has crawled the given url.
     *
     * @param \Spatie\Crawler\Url $url
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param \Spatie\Crawler\Url $foundOnUrl
     *
     * @return void
     */
    public function hasBeenCrawled(Url $url, $response, Url $foundOnUrl = null)
    {
        $responseAnalysis = new ResponseAnalysis($response);

        event(new UrlHasBeenCrawled($url, $response->getStatusCode(), $responseAnalysis->getTitle()));
    }

    /**
     * Called when the crawl has ended.
     *
     * @return void
     */
    public function finishedCrawling()
    {
        // TODO: Implement finishedCrawling() method.
    }
}