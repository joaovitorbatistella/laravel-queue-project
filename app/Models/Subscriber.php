<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $table = 'subscriber';
  
    protected $primaryKey = 'id';
  
    protected $fillable = [
        'id',
        'name',
        'email',
    ];    
}
