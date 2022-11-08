<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    protected $table = 'user';
    
    protected $fillable = ['name', 'email', 'image', 'birthdate'];
    
    public function posts(){
        return $this->hasMany('App\Models\Post', 'idUser');
    }
    
    public function comments(){
        return $this->hasMany('App\Models\Comment', 'idUser');
    }
}
