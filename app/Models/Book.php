<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'penulis',
        'status',
    ];

    public function relations()
    {
        return $this->hasMany(BookRelation::class, 'book_id');
    }
}
