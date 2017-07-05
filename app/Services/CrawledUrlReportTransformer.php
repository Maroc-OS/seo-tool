<?php

namespace App\Services;

use League\Fractal\TransformerAbstract;

class CrawledUrlReportTransformer extends TransformerAbstract
{
    public function transform(CrawledUrlReport $crawledUrlReport): array
    {
        return [
            'nodeType' => $crawledUrlReport->getNodeType(),
            'url' => $crawledUrlReport->getUrl(),
            'statusCode' => $crawledUrlReport->getStatusCode(),
            'redirectHistory' => $crawledUrlReport->getRedirectHistory(),
            'headers' => $crawledUrlReport->getHeaders(),
            'title' => $crawledUrlReport->getTitle(),
            'h1' => $crawledUrlReport->getH1(),
            'foundOnUrl' => $crawledUrlReport->getFoundOnUrl(),
            'originalHtml' => $crawledUrlReport->getHtml(),
            'updatedHtml' => $crawledUrlReport->getNewHtml(),
        ];
    }
}
