<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\User;

class UsersQuery extends Query
{

    protected $attributes = [
        'name' => 'Users query',
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args()
    {
        return [
            'id'    => [
                'name'   => 'id'
                , 'type' => Type::string(),
            ],
            'email' => [
                'name'   => 'email'
                , 'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return [
            (object)["id" => "John", "email" => "john@gmail.com"],
            (object)["id" => "Jane", "email" => "jane@gmail.com"],
        ];
    }

}