<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    protected $table = 'tblBookAuthor';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['BookID','AuthorID','AuthorDate','Remark'];
}
