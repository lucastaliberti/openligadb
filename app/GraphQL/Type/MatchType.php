<?php

namespace App\GraphQL\Type;

use App\Models\Match;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Carbon\Carbon;

class MatchType extends GraphQLType
{
    protected $attributes = [
        'name'        => 'Match',
        'description' => 'A Match',
        'model'       => Match::class,
    ];

    public function fields()
    {
        return [

            'MatchID'         => [
                'type'        => Type::nonNull(Type::int()),
            ],
            'MatchDateTime'   => [
                'type'        => Type::string(),
            ],
            'MatchDateTimeUTC' => [
                'type'        => Type::string(),
            ],
            'TimeZoneID' => [
                'type'        => Type::string(),
            ],
            'LeagueId'         => [
                'type'        => Type::int(),
            ],
            'LeagueName' => [
                'type'        => Type::string(),
            ],
            'Group' => [
                'type'        => GraphQL::type('group'),
            ],
            'Team1' => [
                'type'        => GraphQL::type('team'),
            ],
            'Team2' => [
                'type'        => GraphQL::type('team'),
            ]
        ];
    }
}