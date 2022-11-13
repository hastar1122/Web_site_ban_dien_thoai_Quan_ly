<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $timesamps = false;
    protected $fillable = ['AttributeName'];

    protected $primarkey =  'AttributeID';
    protected $table = 'attribute';
}
