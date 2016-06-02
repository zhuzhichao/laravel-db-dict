<?php
namespace Zhuzhichao\LaravelDbDict\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DbTable extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'alias',
        'description',
        'is_hidden',
    ];

    protected $casts = [
        'is_nullable' => 'boolean'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo(DbCategory::class);
    }

    public function columns()
    {
        return $this->hasMany(DbColumn::class, 'table_id');
    }
}