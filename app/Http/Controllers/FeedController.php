<?php

namespace App\Http\Controllers;

use App\Services\ProductFeed;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function __construct(private readonly ProductFeed $feed)
    {
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
}
