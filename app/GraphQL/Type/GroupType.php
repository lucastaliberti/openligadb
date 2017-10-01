<?php

namespace App\GraphQL\Type;

use App\Models\Team;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Carbon\Carbon;

class GroupType extends GraphQLType
{
    protected $attributes = [
        'name'        => 'Group',
        'description' => 'A Group',
        'model'       => Team::class,
    ];

    public function fields()
    {
        return [
            'GroupOrderID'         => [
                'type'        => Type::nonNull(Type::int()),
            ],
            'GroupName'   => [
                'type'        => Type::string(),
            ],
            'GroupID' => [
                'type'        => Type::int(),
            ],
        ];
    }
}