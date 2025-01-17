<?php

namespace App\DataTables;

use App\Models\Book;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class BooksDataTable extends DataTable
{
    use DataTableTrait;
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('rooms_count', function ($book) {
                return $this->badge($book->rooms_count, 'secondary');
            })
            ->editColumn('action', function ($book) {
                return $this->button(
                    'savebooks.show',
                    $book->id,
                    'info',
                    __('Voir Détails'),
                    'eye'
                ) . ' ' . $this->button(
                        'savebooks.edit',
                        $book->id,
                        'warning',
                        __('Edit'),
                        'edit'
                    ) . $this->deleteButton(
                        'books.destroy',
                        $book->id,
                        'danger',
                        __('Delete'),
                        'trash-alt',
                        __('Really delete this Book?')
                    );
            })
           ->addColumn('action', 'books.action');

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
                                ' Suppression avec succès.',
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


    public function query(Book $post)
    {
        $query = isRole('redac') ? auth()->user()->books() : $post->newQuery();

        if (Route::currentRouteNamed('books.indexnew')) {
            $query->has('unreadNotifications');
        }

        return $query->select(
            'books.id',
            'slug',
            'name',
            'active',
            'books.created_at',
            'books.updated_at',
            'user_id'
        )
            ->with(
             
                'logements:title'
            )
           ;
    }

  /* 
    public function query(Book $model)
    {
        $query = $model->newQuery();
        if (Route::currentRouteNamed('books.indexnew')) {
            $query->has('unreadNotifications');
        }
        return $query;
    } */
  
    public function html()
    {
        return $this->builder()
            ->setTableId('books-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->lengthMenu();
    }

  
    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('Title')),
            Column::make('slug')->title(__('Slug')),
         //   Column::make('meta_description')->title(__('Description')),
         Column::make('created_at')->title(__('Date')),

            //  Column::make('description')->title(__('Descrition')),
          //    Column::computed('rooms_count')->title(__('Rooms'))->addClass('text-center align-middle'),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }

   
    protected function filename()
    {
        return 'Books_' . date('YmdHis');
    }
}
