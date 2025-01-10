@extends('back.layout')
{{-- @section('content') --}}
<!-- resources/views/layouts/app.blade.php -->

<head>
    <!-- Add this in the head section -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@section('main')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Gestion des témoignages</h2>
            </div>

        </div>
    </div>
    <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Auteur</th>


            <th>Email</th>
            <th>Status</th>
            <th>Message</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($testimonials as $temoin)
            <tr>

                <td>{{ $temoin->id }}</td>
                <td>{{ $temoin->name ?? ' ' }}</td>


                <td>{{ $temoin->email ?? ' ' }}</td>
                <td>
                    @if ($temoin->active)
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
                
                <td>{{ $temoin->message }}</td>
                <td>

                    <!-- Add your action buttons here (approve, disapprove, delete) -->
                    <!-- Approve/Disapprove Button -->
                    @if ($temoin->active)
                        <button class="btn btn-warning btn-sm"
                            onclick="confirmAction('{{ route('testimoniales.disapprove', $temoin->id) }}', 'Disapprove', 'Really disapprove this testimonial?')">
                            <i class="fas fa-times"></i> Disapprove
                        </button>
                    @else
                        <button class="btn btn-success btn-sm"
                            onclick="confirmAction('{{ route('testimoniales.approve', $temoin->id) }}', 'Approve', 'Really approve this testimonial?')">
                            <i class="fas fa-check"></i> Approve
                        </button>
                    @endif

                    <!-- Delete Button -->
                    <button class="btn btn-danger btn-sm"
                        onclick="confirmDelete('{{ route('testimoniale.destroy', $temoin->id) }}')">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>



                </td>
            </tr>
        @endforeach
    </table>

    <div class="pagination">
        {{ $testimonials->links('pagination::bootstrap-4') }}
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmAction(url, action, message) {
        Swal.fire({
            title: action,
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + action,
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function confirmDelete(url) {
        Swal.fire({
            title: 'Delete',
            text: 'Are you sure you want to delete this testimonial?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
