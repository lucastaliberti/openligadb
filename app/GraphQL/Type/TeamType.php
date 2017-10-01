<?php

namespace App\GraphQL\Type;

use App\Models\Team;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Carbon\Carbon;

class TeamType extends GraphQLType
{
    protected $attributes = [
        'name'        => 'Team',
        'description' => 'A Team',
        'model'       => Team::class,
    ];

    public function fields()
    {
        return [
            'TeamId'         => [
                'type'        => Type::nonNull(Type::int()),
            ],
            'TeamName'   => [
                'type'        => Type::string(),
            ],
            'ShortName' => [
                'type'        => Type::string(),
            ],
            'TeamIconUrl' => [
                'type'        => Type::string(),
            ],
        ];
    }
}