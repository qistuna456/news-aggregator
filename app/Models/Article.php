<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'source_id',
        'title',
        'summary',
        'content',
        'author',
        'url',
        'url_to_image',
        'category',
        'published_at',
        'raw',
    ];

    protected $casts = [
        'raw' => 'array',
        'published_at' => 'datetime',
    ];

    /**
     * An article belongs to one source.
     */
    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
