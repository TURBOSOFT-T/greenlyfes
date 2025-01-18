<?php

namespace App\DataTables;

use App\Models\Room;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class RoomsDataTable extends DataTable
{
   
    use DataTableTrait;

    public function dataTable($query)
{
    return datatables()
        ->eloquent($query)

        ->editColumn('action', function ($room) {
            // Bouton pour afficher les détails de la chambre
            $viewButton = $this->button(
                'saverooms.show',
                $room->id,
                'info',
                __('Voir Détails'),
                'eye'
            );

            // Bouton pour éditer la chambre
            $editButton = $this->button(
                'saverooms.edit',
                $room->id,
                'warning',
                __('Edit'),
                'edit'
            );

            // Bouton pour supprimer la chambre
            $deleteButton = $this->deleteButton(
                'rooms.destroy',
                $room->id,
                'danger',
                __('Delete'),
                'trash-alt',
                __('Really delete this room?')
            );

            // Nouveau bouton pour créer une réservation pour cette chambre
            $reservationButton = $this->button(
                'reservation.create',
                ['room_id' => $room->id ],
                'success',
                __('Ajouter Réservation'),
                'plus-circle'
            );

            // Retourner tous les boutons combinés
            return $viewButton . ' ' . $editButton . ' ' . $deleteButton . ' ' . $reservationButton;
        })
        
        ->addColumn('action', 'rooms.action');
}
protected function button($route, $parameters, $type, $text, $icon)
{
    $url = route($route, $parameters);

    return "
        <a href='$url' class='btn btn-$type btn-sm' title='$text'>
            <i class='fas fa-$icon'></i> $text
        </a>
    ";
}

    public function dataTable1($query)
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
                    ) . $this->deleteButton(
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
                                'La chambre a été supprimée avec succès.',
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
     * @param \App\Models\Room $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room $model)
    {

        $query = isRole('redac')? auth()->user()->rooms() : $model->newQuery();

        if (Route::currentRouteNamed('rooms.indexnew')) {
            $query->has('unreadNotifications');
        }
        return $query;
        
    
    }
    public function query1(Room $room)
    {
        $query = isRole('redac') ? auth()->user()->rooms() : $room->newQuery();

        if (Route::currentRouteNamed('rooms.indexnew')) {
            $query->has('unreadNotifications');
        }

        return $query->select(
            'rooms.id',
            'slug',
            'title',
            'active',
            'rooms.created_at',
            'rooms.updated_at',
            'user_id'
        )
            ->with(
             
                'book:title'
            )
           ;
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
            Column::make('created_at')->title(__('Date')),
          

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
