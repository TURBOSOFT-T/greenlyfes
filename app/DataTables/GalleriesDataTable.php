<?php

namespace App\DataTables;

use App\Models\Gallerie;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GalleriesDataTable extends DataTable
{
    use DataTableTrait;

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($gallery) {
                return $this->button(
                    'savegalleries.show',
                    $gallery->id,
                    'info',
                    __('Voir Détails'),
                    'eye'
                ) . ' '. $this->deleteButton(
                          'galleries.destroy', 
                          $gallery->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this Gallery?')
                      );
            })
            ->addColumn('action', 'galleries.action');
    }
    protected function deleteButton($route, $id, $type, $text, $icon, $confirmation = null)
    {
        $url = route($route, $id);
        $csrfToken = csrf_token();
        $confirmationText = $confirmation ?? 'Êtes-vous sûr de vouloir supprimer cet élément ?';
    
        return "
        <button type='button' class='btn btn-$type' onclick=\"
            Swal.fire({
                title: '$confirmationText',
                text: 'Cette action est irréversible !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('$url', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '$csrfToken',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            Swal.fire(
                                'Supprimé !',
                                'La gallerie a été supprimée avec succès.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Erreur !',
                                'Un problème est survenu lors de la suppression.',
                                'error'
                            );
                        }
                    })
                    .catch(() => {
                        Swal.fire(
                            'Erreur !',
                            'Un problème est survenu lors de la suppression.',
                            'error'
                        );
                    });
                }
            });
        \">
            <i class='fas fa-$icon'></i> $text
        </button>
        ";
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Gallery $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Gallerie $model)
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
                    ->setTableId('galleries-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('titre')->title(__('Title')),
       //     Column::make('slug')->title(__('Slug')),
            Column::make('description')->title(__('Description')),

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
        return 'Galleries_' . date('YmdHis');
    }
}
