<?php

namespace App\GraphQL\Type;

use App\Models\TeamRatio;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Carbon\Carbon;

class TeamRatioType extends GraphQLType
{
    protected $attributes = [
        'name'        => 'TeamRatio',
        'description' => 'A TeamRatio',
        'model'       => TeamRatio::class,
    ];

    public function fields()
    {
        return [
            'TeamName'            => [
                'type' => Type::string(),
            ],
            'TeamIconUrl' => [
                'type' => Type::string(),
            ],
            'Win'                 => [
                'type' => Type::int(),
            ],
            'Loss'                => [
                'type' => Type::int(),
            ],
            'TotalGames'          => [
                'type' => Type::int(),
            ],
            'WinRation'           => [
                'type' => Type::float(),
            ],
            'LossRation'          => [
                'type' => Type::float(),
            ],
        ];
    }
}