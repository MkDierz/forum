<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content'];
    public function Tag()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function Reply()
    {
        return $this->hasMany('App\Reply');
    }
}
