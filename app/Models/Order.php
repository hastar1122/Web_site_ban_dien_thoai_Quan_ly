<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timesamps = false;
    protected $fillable = ['OrderID','CustomerID','EmployeeID','OrderDate','TotalPrice','OrderStatusID','OrderCode', 'Address'];

    protected $primarkey =  'OrderID';
    protected $table = 'order';


}
