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

    private function addToWinner($winner)
    {
        return $winner ? 1 : 0;
    }

    private function addToLoser($winner)
    {
        return $this->addToWinner(!$winner);
    }

    private function getEmptyTeam($name, $iconUrl)
    {
        return (object)[
            'TeamName'    => $name,
            'TeamIconUrl' => $iconUrl,
            'Win'         => 0,
            'Loss'        => 0,
            'TotalGames'  => 0,
        ];
    }

    private function updateTeam($team, $win, $loss)
    {
        $updated = (object)[
            'TeamName'    => $team->TeamName,
            'TeamIconUrl' => $team->TeamIconUrl,
            'Win'         => $team->Win + $win,
            'Loss'        => $team->Loss + $loss,
            'TotalGames'  => $team->TotalGames + 1,
        ];

        $updated->WinRatio  = $updated->Win / $updated->TotalGames * 100;
        $updated->LossRatio = $updated->Loss / $updated->TotalGames * 100;

        return $updated;
    }

    public function getTeamRatios()
    {
        $return = array_filter($this->getAllMatches()
            , function ($match)
            {
                return $match->MatchIsFinished;
            });

        $return = array_map(function ($v)
        {
            $results = array_reduce($v->MatchResults, function ($carry, $item)
            {
                $carry['Team1'] += $item->PointsTeam1;
                $carry['Team2'] += $item->PointsTeam2;

                return $carry;
            }, ['Team1' => 0, 'Team2' => 0]);

            return (object)[
                'MatchID'        => $v->MatchID
                , 'Team1'        => $v->Team1->TeamName
                , 'Team1IconUrl' => $v->Team1->TeamIconUrl
                , 'Team2'        => $v->Team2->TeamName
                , 'Team2IconUrl' => $v->Team2->TeamIconUrl
                , 'Team1Results' => $results['Team1']
                , 'Team2Results' => $results['Team2'],
            ];
        }, $return);

        $return = array_reduce($return, function ($carry, $item)
        {
            $winner = ($item->Team1Results > $item->Team2Results);
            $loser  = !$winner;

            $team1 = trim($item->Team1);
            $team2 = trim($item->Team2);

            $carry[$team1] = (!isset($carry[$item->Team1])) ?
                $this->updateTeam($this->getEmptyTeam($team1, $item->Team1IconUrl), $this->addToWinner($winner), $this->addToLoser($winner)) :
                $this->updateTeam($carry[$team1], $this->addToWinner($winner), $this->addToLoser($winner));

            $carry[$team2] = (!isset($carry[$item->Team2])) ?
                $this->updateTeam($this->getEmptyTeam($team2, $item->Team2IconUrl), $this->addToWinner($loser), $this->addToLoser($loser)) :
                $this->updateTeam($carry[$team2], $this->addToWinner($loser), $this->addToLoser($loser));

            return $carry;
        }, []);

        sort($return);

        return $return;
    }
}

