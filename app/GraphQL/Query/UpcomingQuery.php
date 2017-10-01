<?php

namespace App\GraphQL\Query;

use App\Http\BundesLigaHttp;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class UpcomingQuery extends Query
{
    protected $attributes = [
        'name' => 'Upcoming query',
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('match'));
    }

    public function resolve($root, $args)
    {

        $client = new BundesLigaHttp();
        $return = $client->getUpcomingMatches();
        return $return;
    }
}