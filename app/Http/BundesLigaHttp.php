<?php

namespace App\Http;

use GuzzleHttp;
use Carbon\Carbon;

class BundesLigaHttp
{

    var $client;

    function __construct()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'https://www.openligadb.de/api/',
        ]);
    }

    public function request(string $method, string $path)
    {
        return $this->client->request($method, $path);
    }

    public function unwrappedRequestBody(string $method, string $path)
    {
        return GuzzleHttp\json_decode($this->request($method, $path)->getBody()->getContents());
    }

    public function getAllMatches()
    {
        return $this->unwrappedRequestBody("GET", "getmatchdata/bl1/2017");
    }

    public function getUpcomingMatches()
    {
        return array_filter($this->getAllMatches()
            , function ($match)
            {
                $carbon = Carbon::parse($match->MatchDateTimeUTC, 'UTC');

                return $carbon->isFuture();
            });
    }
}

