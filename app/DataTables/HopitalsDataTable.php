<?php

namespace App\DataTables;

use App\Models\Hopital;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HopitalsDataTable extends DataTable
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
            ->editColumn('action', function ($hopital) {
                return $this->button(
                          'hospitals.edit', 
                          $hopital->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'hospitals.destroy', 
                          $hopital->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this Hospital?')
                      );
            })
            ->addColumn('action', 'hopitals.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Hopital $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hopital $model)
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
                    ->setTableId('hopitals-table')
                    ->columns($this->getColumns())
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
       
            Column::make('id'),
            Column::make('title')->title(__('Title')),
            //  Column::make('slug')->title(__('Slug')),
              Column::make('body')->title(__('Description')),

            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Hopitals_' . date('YmdHis');
    }
}
