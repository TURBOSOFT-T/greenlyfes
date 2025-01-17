<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class PostsDataTable extends DataTable
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
            ->editColumn('categories', function ($post) {
                return $this->getCategories($post);
            })
            ->editColumn('created_at', function ($post) {
                return $this->getDate($post);
            })
            ->editColumn('comments_count', function ($post) {
                return $this->badge($post->comments_count, 'secondary');
            })
            ->editColumn('action', function ($post) {

                $buttons = $this->button(
                    'posts.display',
                    $post->slug,
                    'success',
                    __('Show'),
                    'eye',
                    '',
                    '_blank'
                );

                if (Route::currentRouteName() === 'posts.indexnew') {
                    return $buttons;
                }

                $buttons .= $this->button(
                    'posts.edit',
                    $post->id,
                    'warning',
                    __('Edit'),
                    'edit'
                );

                if ($post->user_id === auth()->id()) {
                    $buttons .= $this->button(
                        'posts.create',
                        $post->id,
                        'info',
                        __('Clone'),
                        'clone'
                    );
                }

                return $buttons . $this->deleteButton(
                    'posts.destroy',
                    $post->id,
                    'danger',
                    __('Delete'),
                    'trash-alt',
                    __('Really delete this post?')
                );
            })
            ->rawColumns(['categories', 'comments_count', 'action', 'created_at']);
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
                                'Le post a été supprimé avec succès.',
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
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $post)
    {
        $query = isRole('redac') ? auth()->user()->posts() : $post->newQuery();

        if (Route::currentRouteNamed('posts.indexnew')) {
            $query->has('unreadNotifications');
        }

        return $query->select(
            'posts.id',
            'slug',
            'title',
            'active',
            'posts.created_at',
            'posts.updated_at',
            'user_id'
        )
            ->with(
                'user:id,name',
                'categories:title'
            )
            ->withCount('comments');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('posts-table')
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
        $columns = [
            Column::make('title')->title(__('Title'))
        ];

        if (auth()->user()->role === 'admin') {
            array_push(
                $columns,
                Column::make('user.name')->title(__('Author'))
            );
        }

        array_push(
            $columns,
            Column::computed('categories')->title(__('Categories')),
            Column::computed('comments_count')->title(__('Comments'))->addClass('text-center align-middle'),
            Column::make('created_at')->title(__('Date')),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center')
        );

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Posts_' . date('YmdHis');
    }


    /**
     * Get zone date.
     *
     * @param \App\Models\Post $post
     * @return string
     */
    protected function getDate($post)
    {
        if (!$post->active) {
            return $this->badge('Not published', 'warning');
        }

        $updated = $post->updated_at > $post->created_at;
        $html = $this->badge($updated ? 'Last update' : 'Published', 'success');

        $html .= '<br>' . formatDate($updated ? $post->updated_at : $post->created_at) . __(' at ') . formatHour($updated ? $post->updated_at : $post->created_at);

        return $html;
    }

    /**
     * Get categories.
     *
     * @param \App\Models\Post $post
     * @return string
     */
    protected function getCategories($post)
    {
        $html = '';

        foreach ($post->categories as $category) {
            $html .= $category->title . '<br>';
        }

        return $html;
    }
}
