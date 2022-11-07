<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timesamps = false;
    protected $fillable = ['OrderStatus'];
    
    protected $primarkey =  'OrderStatusID';
    protected $table = 'orderstatus';
    
}
