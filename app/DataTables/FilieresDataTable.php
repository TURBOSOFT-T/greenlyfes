<?php

namespace App\DataTables;

use App\Models\Filiere;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FilieresDataTable extends DataTable
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
            ->addColumn('ecoles_count', function ($filiere) {
                return $filiere->ecoles_count; // Adds the school count to the DataTable
            })
          
            ->editColumn('action', function ($filiere) {
                return $this->button(
                          'filieres.edit', 
                          $filiere->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'filieres.destroy', 
                          $filiere->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this filiere?')
                      );
            })
            

            ->addColumn('action', 'filieres.action');
    }

   
  

    public function query(Filiere $filiere)
    {
        return $filiere->withCount('ecoles');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('filieres-table')
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
           
          //  Column::make('id'),
            Column::make('title')->title(__('Title')),
          //  Column::make('slug')->title(__('Slug')),
            Column::make('body')->title(__('Description')),
            Column::computed('ecoles_count')->title(__('Ecoles'))->addClass('text-center align-middle'),
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
        return 'Filieres_' . date('YmdHis');
    }
}
