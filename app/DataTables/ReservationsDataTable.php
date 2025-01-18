<?php

namespace App\DataTables;

use App\Models\Reservation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class ReservationsDataTable extends DataTable
{

    use DataTableTrait;
    
  
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

         
            ->editColumn('etat', function ($reservation) {
                // Exemple : ajouter une classe ou un badge basé sur la valeur de l'état
                switch ($reservation->etat) {
                    case 'attente':
                        return '<span class="badge badge-warning">' . __('En attente') . '</span>';
                    case 'confirmé':
                        return '<span class="badge badge-success">' . __('Confirmé') . '</span>';
                    case 'annulé':
                        return '<span class="badge badge-danger">' . __('Annulé') . '</span>';
                    default:
                        return $reservation->etat;
                }
            })
            ->rawColumns(['etat', 'action']) // Per

            

            ->editColumn('action', function ($reservation) {
                // Bouton "Voir les détails"
                $viewButton = '<a href="' . route('reservations.show', $reservation->id) . '" class="btn btn-info btn-sm" title="' . __('Voir les détails') . '">
                                <i class="fas fa-eye"></i> 
                              </a>';


                              $editButton = '<a href="' . route('editreservations.edit', $reservation->id) . '" class="btn btn-warning btn-sm" title="' . __('Modifier') . '">
                              <i class="fas fa-edit"></i> 
                            </a>';

                // Bouton "Supprimer"
                $deleteButton = $this->deleteButton(
                    'reservations.destroy', 
                    $reservation->id, 
                    'danger', 
                    __('Delete'), 
                    'trash-alt', 
                    __('Really delete this Reservation  ?')
                );

                // Retourner les deux boutons
                return $viewButton . ' ' . $editButton . ' ' . $deleteButton;
            })
            ->addColumn('action', 'reservations.action');
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
    

    public function query(Reservation $reservation)
    {
        
        $query = isRole('redac') ? 
            $reservation->whereHas('room.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) : 
            $reservation->newQuery();

        if(Route::currentRouteNamed('reservations.indexnew')) {
            $query->has('unreadNotifications');
        }

        return $query->with('user:id,name,valid', 'room:id,title,slug');
    }


 
    public function html()
    {
        return $this->builder()
                    ->setTableId('reservations-table')
                    ->columns($this->getColumns())
                   
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons([
                        Button::make('create')
                            ->text('<i class="fas fa-plus"></i> ' . __('Ajouter une Réservation'))
                            ->action("window.location = '" . route('reservations.create') . "';")
                            ->className('btn btn-primary'),
                    ])
                    ->lengthMenu([10, 25, 50, 100]); // Options de pagination
    }

   
    protected function getColumns()
    {
        return [
            Column::make('id')->title(__('ID')),
   
            Column::make('nom')->title(__('Nom ')), 
            Column::make('prenom')->title(__('Prénom')),
          
            Column::make('telephone')->title(__('Téléphone')),
            Column::make('email')->title(__('Email')),
            Column::make('mode')->title(__('Mode de paiement')),
            Column::make('etat')->title(__('État')), 
         
        
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

