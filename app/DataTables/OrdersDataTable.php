<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class OrdersDataTable extends DataTable
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
            ->editColumn('action', function ($order) {
                return $this->button(
                          'orders.destroy', 
                          $order->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this order?')
                      );
            })
            ->addColumn('action', 'orders.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */


    public function query(Order $order)
    {
        $query = $order->newQuery();

        if(Route::currentRouteNamed('testimonials.indexnew')) {
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
                    ->setTableId('orders-table')
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
            Column::make('id')->title(__('ID')),
   
            Column::make('last_name')->title(__('Nom ')), 
            Column::make('first_name')->title(__('Prénom')),
          
            Column::make('phone')->title(__('Téléphone')),
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
        return 'Orders_' . date('YmdHis');
    }
}
