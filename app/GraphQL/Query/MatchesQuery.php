<?php

namespace App\GraphQL\Query;

use App\Http\BundesLigaHttp;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class MatchesQuery extends Query
{
    protected $attributes = [
        'name' => 'All matches query',
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('match'));
    }

    public function resolve($root, $args)
    {

        $client = new BundesLigaHttp();
        $return = $client->getAllMatches();
        return $return;
    }
}