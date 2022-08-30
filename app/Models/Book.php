<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'isbn',
        'number_of_pages',
        'authors',
        'country',
        'release_date',
        'publisher'
    ];
    protected $casts = [
        'authors' => 'array',
    ];
}
