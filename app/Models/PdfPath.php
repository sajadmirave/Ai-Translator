<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfPath extends Model
{
    use HasFactory;
    protected $table = "path";
    public $timestamps = false;
}
