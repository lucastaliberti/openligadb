<?php

namespace App\GraphQL\Query;

use App\Http\BundesLigaHttp;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class TeamQuery extends Query
{
    protected $attributes = [
        'name' => 'Team query',
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('team_ratio'));
    }

    public function resolve($root, $args)
    {

        $client = new BundesLigaHttp();
        $return = $client->getTeamRatios();
        return $return;
    }
}