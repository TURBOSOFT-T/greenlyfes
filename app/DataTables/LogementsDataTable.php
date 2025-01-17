<?php

namespace App\DataTables;

use App\Models\Logement;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LogementsDataTable extends DataTable
{   

    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($logement) {
                return $this->button(
                          'logements.edit', 
                          $logement->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->deleteButton(
                          'logements.destroy', 
                          $logement->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this Logement?')
                      );
            })
            ->addColumn('action', 'logements.action');
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
                                'La catégorie a été supprimée avec succès.',
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
     * @param \App\Models\Logement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Logement $model)
    {
        return $model->newQuery();
    }

    public function query1(Logement $logement)
    {
        return $logement->withCount('books');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('logements-table')
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
            Column::make('title')->title(__('Title')),
            Column::make('slug')->title(__('Slug')),
          //  Column::make('description')->title(__('Descrition')),
           // Column::computed('books_count')->title(__('Posts'))->addClass('text-center align-middle'),
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
        return 'Logements_' . date('YmdHis');
    }
}
