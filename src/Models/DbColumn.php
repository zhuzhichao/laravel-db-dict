<?php
namespace Zhuzhichao\LaravelDbDict\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DbColumn extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'table_id',
        'name',
        'type',
        'default',
        'key',
        'is_nullable',
        'extra',
        'comment',
        'alias',
        'description',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function table()
    {
        return $this->belongsTo(DbTable::class);
    }
}