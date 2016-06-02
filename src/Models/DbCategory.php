<?php
namespace Zhuzhichao\LaravelDbDict\Models;

use Illuminate\Database\Eloquent\Model;

class DbCategory extends Model
{

    protected $fillable = [
        'name',
        'remark'
    ];

    public function tables()
    {
        return $this->hasMany(DbTable::class);
    }
}