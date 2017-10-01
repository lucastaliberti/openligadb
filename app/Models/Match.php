<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function Team1(){
        return $this->hasOne(Team::class);
    }

    public function Team2(){
        return $this->hasOne(Team::class);
    }

    public function Group(){
        return $this->hasOne(Group::class);
    }
}
