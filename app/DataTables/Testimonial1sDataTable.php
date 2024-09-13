<?php

namespace App\DataTables;

use App\Models\Testimonial;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class TestimonialsDataTable extends DataTable
{
    
    use DataTableTrait;



   /*  public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($testimonial) {
                $approveButton = '';
                $disapproveButton = '';
                $deleteButton = '';
    
                $approveUrl = route('testimoniales.approve', $testimonial->id);
                $disapproveUrl = route('testimoniales.disapprove', $testimonial->id);
                $deleteUrl = route('testimoniales.destroy', $testimonial->id);
    
                if ($testimonial->active) {
                    $disapproveButton = '
                        <form method="POST" action="' . $disapproveUrl . '" style="display:inline;">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm(\'' . __('Really disapprove this testimonial?') . '\')">
                                <i class="fas fa-times"></i> ' . __('Disapprove') . '
                            </button>
                        </form>';
                } else {
                    $approveButton = '
                        <form method="POST" action="' . $approveUrl . '" style="display:inline;">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm(\'' . __('Really approve this testimonial?') . '\')">
                                <i class="fas fa-check"></i> ' . __('Approve') . '
                            </button>
                        </form>';
                }
    
                $deleteButton = '
                    <form method="POST" action="' . $deleteUrl . '" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'' . __('Really delete this testimonial?') . '\')">
                            <i class="fas fa-trash-alt"></i> ' . __('Delete') . '
                        </button>
                    </form>';
    
                return $approveButton . ' ' . $disapproveButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action']);
    }
    
 */



      public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($testimonial) {
                return $this->button(
                          'testimoniales.edit', 
                          $testimonial->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'testimoniales.destroy',

                          $testimonial->id,
                          'danger',
                          __('Delete'),
                          'trash-alt'
                      );
            })
            
            ->addColumn('action', 'testimonials.action');
    }  
 
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Testimonial $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Testimonial $testimonial)
    {
        $query = $testimonial->newQuery();

        if(Route::currentRouteNamed('testimonials.indexnew')) {
            $query->has('unreadNotifications');
        }
        return $query;
    }
 
   
   public function html()
    {
        return $this->builder()
                    ->setTableId('testimonials-table')
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
   
          /*   Column::make('name')->title(__('Name')), */
            Column::make('email')->title(__('Email')),
            Column::make('active')->title(__('Active')),
        
            Column::make('created_at')->title(__('Date')),
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
        return 'Testimonials_' . date('YmdHis');
    }
}


