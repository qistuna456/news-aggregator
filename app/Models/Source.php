<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'base_url',
    ];

    /**
     * A source has many articles.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
