<?php
namespace Zhuzhichao\LaravelDbDict\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Request;
use Zhuzhichao\LaravelDbDict\Models\DbColumn;
use Zhuzhichao\LaravelDbDict\Models\DbTable;

class DictController extends Controller
{

    public function index()
    {
        /** @var Collection $tables */
        $tables = DbTable::orderBy('name', 'asc')->get();

        $tableId = Request::has('table_id') ? Request::input('table_id') : ( $tables->first() ? $tables->first()->id : 0 );
        /** @var DbTable $currentTable */
        $currentTable = DbTable::find($tableId);
        // Get All Columns By TableId
        $columns = $currentTable->columns;

        return view('LarevelDbDict::index')->withTables($tables)->withColumns($columns)->withCurrentTable($currentTable);
    }

    public function updateColumn($column_id)
    {
        /** @var DbColumn $column */
        $column = DbColumn::find($column_id);

        if (empty( $column )) {
            return [ ];
        }

        $column->update([ 'description' => Request::input('description') ]);

        return $column;
    }

    public function updateTable($table_id)
    {
        /** @var DbTable $table */
        $table = DbTable::find($table_id);

        if (empty( $table )) {
            return [ ];
        }

        $table->update([ 'description' => Request::input('description') ]);

        return $table;
    }

    public function postDictSync()
    {
        \Artisan::call('db:dict-sync');

        return [
            'success' => true
        ];
    }
}