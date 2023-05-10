<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected  $table = 'logs';
    protected $fillable = ['c_name', 'db_name', 'message', 'status', 'last_backup'];
}
