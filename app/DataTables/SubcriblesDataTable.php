<?php

namespace App\DataTables;

use App\Models\Subcrible;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubcriblesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($testimonial) {
                return formatDate($testimonial->created_at) . __(' at ') . formatHour($testimonial->created_at);
            })
            ->editColumn('name', function ($testimonial) {
                return $testimonial->name . ($testimonial->user_id ? $this->badge('User', 'primary', 2) : '');
            })
            ->editColumn('email', function ($testimonial) {
                return '<a href = "mailto: ' . $testimonial->email . '">' . $testimonial->email . '</a>';
            })
            ->editColumn('action', function ($testimonial) {
                return $this->button(
                          'testimonials.destroy', 
                          $testimonial->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this testimonial?')
                      );
            })
            ->addColumn('action', 'subcriblesdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SubcriblesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubcriblesDataTable $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('subcriblesdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Subcribles_' . date('YmdHis');
    }
}