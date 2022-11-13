<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    public $timesamps = false;
    protected $fillable = ['CategoryID', 'AttributeID'];

    protected $primarkey =  'CategoryVariationID';
    protected $table = 'categoryattribute';
}
