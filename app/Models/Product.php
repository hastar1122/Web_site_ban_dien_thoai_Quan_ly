<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timesamps = false;
    protected $fillable = ['ProductID','ProductParentID','ProductCode','ProductName','CatergoryID','BrandID','Price','OutwardPrice','ProductDescription','Amount','Image'];
    
    protected $primarkey =  'ProductID';
    protected $table = 'product';
}
