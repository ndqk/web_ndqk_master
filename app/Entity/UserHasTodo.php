<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class UserHasTodo extends Model
{
    protected $table = 'user_has_todos';

    protected $fillable = ['user_id', 'todo_id'];

    public function user(){
        return $this->belongsTo('App\Entity\User', 'user_id', 'id');
    }
}
