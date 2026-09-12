<?php

namespace App\Http\Controllers;

use App\Services\ProductFeed;
use App\Services\ProductFeedTsv;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function __construct(
        private readonly ProductFeed $feed,
        private readonly ProductFeedTsv $feedTsv,
    ) {
    }

    /** Feed im Browser anzeigen. */
    public function index(): Response
    {
        return response($this->feed->toXml(), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'X-Robots-Tag' => 'noindex',
        ]);
    }

    /** Feed als Datei herunterladen. */
    public function download(): Response
    {
        return response($this->feed->toXml(), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="google-merchant-feed.xml"',
            'X-Robots-Tag' => 'noindex',
        ]);
    }

    /** TSV-Backup-Feed (Google-Shopping-Standardspalten). */
    public function tsv(): Response
    {
        return response($this->feedTsv->toTsv(), 200, [
            'Content-Type' => 'text/tab-separated-values; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="google-merchant-feed.tsv"',
            'X-Robots-Tag' => 'noindex',
        ]);
    }
}
