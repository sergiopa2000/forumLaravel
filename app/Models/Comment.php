<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = 'comment';
    
    protected $fillable = ['message', 'idPost', 'idUser'];
    
    public function user(){
        return $this->belongsTo('App\Models\User', 'idUser');
    }
    public function post(){
        return $this->belongsTo('App\Models\Post', 'idPost');
    }
}
