<?php

namespace App\DataTables;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
// use Yajra\DataTables\Html\Editor\Editor;
// use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PasiensDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', fn ($row) => $this->addElement($row))
            ->addColumn('created_at', fn ($row) => \Carbon\Carbon::parse($row->created_at)->diffForHumans())
            ->setRowAttr(["class" => "text-dark h6"])
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pasien $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pasiens-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center text-dark'),
            Column::make('id'),
            Column::make('no_kartu'),
            Column::make('no_hp'),
            Column::make('alamat'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pasiens_' . date('YmdHis');
    }

    private function addElement(array | object  $attr): string
    {
        $groupBtn = '<div class="btn-group">{child}</div>';
        $actionBtn = '<a href="pasien/' . $attr->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="pasien/' . $attr->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
        return str_replace("{child}", $actionBtn, $groupBtn);
    }
}
