<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timesamps = false;
    protected $fillable = ['ProductCategoryName'];

    protected $primarkey =  'CategoryID';
    protected $table = 'category';
}
