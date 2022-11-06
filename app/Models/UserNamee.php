<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNamee extends Model
{
    public $timesamps = false;
    protected $fillable = ['UserName','Address','PhoneNumber','Email'];
    
    protected $primarkey =  'UserId';
    protected $table = 'user';
}
