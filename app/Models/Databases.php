<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databases extends Model
{
    use HasFactory;
    protected  $table = 'databases';
    protected $fillable = ['c_name', 'c_id', 'db_name', 'ip', 'port', 'user', 'password', 'last_backup', 'period_hour', 'backup_max_count'];

    public function cluster(){
        return $this->hasOne(Clusters::class, 'id', 'c_id');
    }
}
