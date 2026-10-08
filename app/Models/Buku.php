<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    protected $table = 'BUKU';
    protected $fillable = ['category_id', 'title', 'author', 'published_year', 'stock'];

    public function MengambilKategory(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }
}