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

    protected $casts = [
        'is_nullable' => 'boolean'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function table()
    {
        return $this->belongsTo(DbTable::class);
    }

    public function getIsNullableAttribute($value)
    {
        return $value ? '<span class="label label-success">YES</span>' : '<span class="label label-warning">NO</span>';
    }

    public function getKeyAttribute($value)
    {
        
        return $value ? $value : '';
    }
}