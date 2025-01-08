<?php

namespace App\DataTables;

use App\Models\Room;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoomsDataTable extends DataTable
{
   
    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            ->editColumn('action', function ($room) {
                return $this->button(
                    'saverooms.show',
                    $room->id,
                    'info',
                    __('Voir Détails'),
                    'eye'
                ) . ' ' . $this->button(
                        'saverooms.edit',
                        $room->id,
                        'warning',
                        __('Edit'),
                        'edit'
                    ) . $this->button(
                        'rooms.destroy',
                        $room->id,
                        'danger',
                        __('Delete'),
                        'trash-alt',
                        __('Really delete this room?')
                    );
            })
        
            ->addColumn('action', 'rooms.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model)
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
                    ->setTableId('rooms-table')
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
            Column::make('name')->title(__('Title')),
            Column::make('slug')->title(__('Slug')),
            Column::make('meta_description')->title(__('Description')),

            //  Column::make('description')->title(__('Descrition')),
            //  Column::computed('posts_count')->title(__('Posts'))->addClass('text-center align-middle'),
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
        return 'Rooms_' . date('YmdHis');
    }
}
