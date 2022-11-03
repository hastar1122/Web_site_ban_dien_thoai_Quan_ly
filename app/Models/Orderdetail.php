<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    public $timesamps = false;
    protected $fillable = ['OrderID','ProductID','Amount','TotalPrice','OrderCode'];
    
    protected $primarkey =  'OrderDetailID';
    protected $table = 'orderdetail';
    
    // public function product(){
    //     return $this->belongsTo('App\Models\Product','ProductID');
    // }
}
