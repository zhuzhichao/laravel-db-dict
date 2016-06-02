<?php
namespace Zhuzhichao\LaravelDbDict\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Zhuzhichao\LaravelDbDict\Models\DbColumn;
use Zhuzhichao\LaravelDbDict\Models\DbTable;

class DictController extends Controller
{

    public function index()
    {
        /** @var Collection $tables */
        $tables = DbTable::orderBy('name', 'asc')->get();

        $tableId = $tables->first() ? $tables->first()->id : 0;
        // Get All Columns By TableId
        $columns = DbColumn::whereTableId($tableId)->get();

        return view('LarevelDbDict::index')->withTables($tables)->withColumns($columns);
    }
}