<?php

namespace App\DataTables;

use App\Models\Ecole;
use Illuminate\Routing\Route;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EcolesDataTable extends DataTable
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
          
            ->editColumn('filieres', function ($ecole) {
                return $this->getFilieres($ecole);
            })
            ->editColumn('created_at', function ($ecole) {
                return $this->getDate($ecole);
            })
           
            ->editColumn('action', function ($ecole) {
                return $this->button(
                          'schools.edit', 
                          $ecole->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'schools.destroy', 
                          $ecole->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this filiere?')
                      );
            })
            
            
            
            ->addColumn('action', 'ecoles.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Ecole $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ecole $model)
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
                    ->setTableId('ecoles-table')
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
        return 'Ecoles_' . date('YmdHis');
    }

    protected function getDate($ecole)
    {
        if (!$ecole->active) {
            return $this->badge('Not published', 'warning');
        }

        $updated = $ecole->updated_at > $ecole->created_at;
        $html = $this->badge($updated ? 'Last update' : 'Published', 'success');

        $html .= '<br>' . formatDate($updated ? $ecole->updated_at : $ecole->created_at) . __(' at ') . formatHour($updated ? $ecole->updated_at : $ecole->created_at);

        return $html;
    }

    /**
     * Get categories.
     *
     * @param \App\Models\ecole $ecole
     * @return string
     */
    protected function getFilieres($ecole)
    {
        $html = '';

        foreach ($ecole->filieres as $filiere) {
            $html .= $filiere->title . '<br>';
        }

        return $html;
    }
}
