<?php

namespace App\DataTables;

use App\Models\Inscription;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class InscriptionsDataTable extends DataTable
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
            ->editColumn('action', function ($inscription) {
                return $this->button(
                          'inscriptions.edit', 
                          $inscription->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'inscriptions.destroy', 
                          $inscription->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this inscription?')
                      );
            })
            ->addColumn('action', 'inscriptions.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Inscription $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inscription $model)
    {
$query = $model->newQuery();
        if(Route::currentRouteNamed('inscriptions.indexnew')) {
            $query->has('unreadNotifications');
        }
        return $query;
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('inscriptions-table')
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
            Column::make('nom')->title(__('Nom')),
            //  Column::make('slug')->title(__('Slug')),
              Column::make('prenom')->title(__('Prenom')),
              Column::make('email')->title(__('Email')),
              Column::make('telephone')->title(__('Telephone')),
              Column:: make('created_at')->title(__('Date inscription')),

       
            
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
        return 'Inscriptions_' . date('YmdHis');
    }
}
