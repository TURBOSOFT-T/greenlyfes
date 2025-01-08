<?php

namespace App\DataTables;

use App\Models\Reservation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReservationsDataTable extends DataTable
{

    use DataTableTrait;
  
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            

            ->editColumn('action', function ($order) {
                return $this->button(
                          'reservations.destroy', 
                          $order->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this Reservation  ?')
                      );
            })
            ->addColumn('action', 'reservations.action');
    }

   
    public function query(Reservation $model)
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
                    ->setTableId('reservations-table')
                    ->columns($this->getColumns())
                   
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->lengthMenu();
    }

   
    protected function getColumns()
    {
        return [
            Column::make('id')->title(__('ID')),
   
            Column::make('nom')->title(__('Nom ')), 
            Column::make('prenom')->title(__('Prénom')),
          
            Column::make('telephone')->title(__('Téléphone')),
            Column::make('email')->title(__('Email')),
         
        
            Column::make('created_at')->title(__('Date commande')),
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
        return 'Reservations_' . date('YmdHis');
    }
}

