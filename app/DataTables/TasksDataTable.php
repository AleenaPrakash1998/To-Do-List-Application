<?php

namespace App\DataTables;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TasksDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'pages.tasks._columns.action')
            ->rawColumns(['action'])
            ->setRowId('id');
    }


    public function query(Task $model): QueryBuilder
    {

        $user = auth()->user();

        return $model->newQuery()
            ->with(['user']) // Eager load the user relationship
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id) // User-created tasks
                ->orWhereHas('sharedUsers', function ($query) use ($user) {
                    $query->where('user_id', $user->id); // Shared tasks
                });
            });

    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tasks-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'bSort' => false,
            ]);
    }


    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('user.name'),
            Column::make('title'),
            Column::make('description'),
            Column::make('due_date'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->addClass('text-center'),
        ];
    }


    protected function filename(): string
    {
        return 'Tasks_' . date('YmdHis');
    }
}
