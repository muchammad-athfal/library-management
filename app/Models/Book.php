<?php

namespace App\Models;

use App\Http\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $guarded = ['id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
