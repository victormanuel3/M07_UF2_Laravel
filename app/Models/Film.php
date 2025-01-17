<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url'
    ];

    public function isFilm($title) {
        return Film::where('name', $title)->exists();
    }
}
