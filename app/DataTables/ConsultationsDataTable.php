<?php

namespace App\DataTables;

use App\Models\Consultation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class ConsultationsDataTable extends DataTable
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
            ->editColumn('action', function ($consultation) {
                return  $this->button(
                    'consultations.edit',
                    $consultation->id,
                    'warning',
                    __('Edit'),
                    'edit'
                ) . $this->button(
                    'inscriptions.destroy',
                    $consultation->id,
                    'danger',
                    __('Delete'),
                    'trash-alt',
                    __('Really delete this consultation?')
                );
            })
            ->addColumn('action', 'consultations.action');
    }

    public function query(Consultation $model)
    {
        $query = $model->newQuery();
        if (Route::currentRouteNamed('consultations.indexnew')) {
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
            ->setTableId('consultations-table')
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
            Column::make('created_at')->title(__('Date consultation')),
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
        return 'Consultations_' . date('YmdHis');
    }
}
