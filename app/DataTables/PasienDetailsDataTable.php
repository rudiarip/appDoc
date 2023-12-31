<?php

namespace App\DataTables;

use App\Models\PasienDetail;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use function Laravel\Prompts\alert;

class PasienDetailsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
            $dataTable = (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', fn($row) => $this->addElement($row))
            ->addColumn('nama', fn($row) => $row["nama"])
            ->addColumn('tgl_lahir', fn($row) => $row->tgl_lahir)
            ->addColumn('no_kartu', fn($row) => $row["no_kartu"])
            ->addColumn('alamat', fn($row) => $row["alamat"])
            ->addColumn('no_hp', fn($row) => $row["no_hp"])
            ->rawColumns(['alamat', 'no_kartu', 'no_hp', 'action'])
            ->setRowAttr(["class" => "text-dark h6"])
            ->setRowId('id');

        // Customize the search behavior for the 'nama' column
        $dataTable->filterColumn('nama', function ($query, $keyword) {
            $query->where('nama', 'LIKE', '%' . $keyword . '%'); // Adjust the search criteria as needed
        });

        return $dataTable;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PasienDetail $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->leftJoin('pasiens as p', 'p.id', '=', 'pasien_details.id_pasien')
            ->select('p.*', 'pasien_details.nama', 'pasien_details.tgl_lahir', 'pasien_details.id as id_detail');

        return $this->applyScopes($query); // This line applies any DataTables specific scopes

        // Additional custom search logic
        $searchValue = $this->request->input('search.value');

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('nama', 'like', '%' . $searchValue . '%')
                  ->orWhere('alamat', 'like', '%' . $searchValue . '%')
                  ->orWhere('no_kartu', 'like', '%' . $searchValue . '%')
                  ->orWhere('no_hp', 'like', '%' . $searchValue . '%');
            });
        }

        return $query;
    
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pasien-detail')
            // ->setTableAttributes()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->searching(true)
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

            // Column::make('id'),
            Column::make('no_kartu')->name("p.no_kartu"),
            Column::make('nama')->name('pasien_details.nama'),
            Column::make('alamat')->name('p.alamat'),
            Column::make('no_hp')->width(100)->name("p.no_hp"),
            Column::make('tgl_lahir')->width(100)->name('pasien_details.tgl_lahir'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center text-dark'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PasienDetails_' . date('YmdHis');
    }

    private function addElement(array | object  $attr): string
    {
        $id_detail = $attr["id_detail"];
        $deleteBtn = '<button type="button" data-id="' . $id_detail . '" class="delete-pasien btn btn-danger btn-sm">Delete</button>';
        $editBtn = '<button data-id="' . $id_detail . '" class="edit-pasien btn btn-success btn-sm">Edit</button>';
        $detailBtn = '<a href="' . route('detail.view-detail', $attr["id"]) . '" data-id="' . $id_detail . '" data-id-pasien="' . $attr["id"] . '" class="detail-pasien btn btn-warning btn-sm">Detail</a>';
        $groupBtn = '<div class="d-flex justify-content-between">' . $detailBtn . $editBtn . $deleteBtn . '</div>';
        return $groupBtn;
    }
}
