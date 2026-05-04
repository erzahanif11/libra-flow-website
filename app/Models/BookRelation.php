<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'next_book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function nextBook()
    {
        return $this->belongsTo(Book::class, 'next_book_id');
    }
}
