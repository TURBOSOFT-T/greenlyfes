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
                    ) . $this->button(
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

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Book $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    /* public function query(Book $model)
    {
        return $model->newQuery();
    } */
    public function query(Book $model)
    {
        $query = $model->newQuery();
        if (Route::currentRouteNamed('books.indexnew')) {
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
            ->setTableId('books-table')
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
        return 'Books_' . date('YmdHis');
    }
}
