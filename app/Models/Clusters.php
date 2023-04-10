<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clusters extends Model
{
    use HasFactory;
    protected  $table = 'clusters';
    protected $fillable = ['cluster', 'ip', 'port', 'user', 'password', 'description'];
}
