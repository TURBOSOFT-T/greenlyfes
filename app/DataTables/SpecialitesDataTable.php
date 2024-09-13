<?php

namespace App\DataTables;

use App\Models\Specialite;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SpecialitesDataTable extends DataTable
{

    use DataTableTrait;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('hopitals_count', function ($specialite) {
                return $specialite->hopitals_count; 
            })
          
            ->editColumn('action', function ($specialite) {
                return $this->button(
                          'specialites.edit', 
                          $specialite->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'specialites.destroy', 
                          $specialite->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this specialite?')
                      );
            })
            ->addColumn('action', 'specialites.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Specialite $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query1(Specialite $model)
    {
        return $model->newQuery();
    }

    public function query(Specialite $specialite)
    {
        return $specialite->withCount('hopitals');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('specialites-table')
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
            Column::make('slug')->title(__('Slug')),
            Column::make('body')->title(__('Description')),
            Column::make('hopitals_count')->title(__('Hopitaux')),
            
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
        return 'Specialites_' . date('YmdHis');
    }
}
