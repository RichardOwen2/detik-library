@extends('layouts.app')
@section('title', $book->title)

@section('modal')
    @include('pages.admin.books.detail.modal.edit')
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">{{ $book->title }}</span>
        </h3>

        <div class="d-flex">
            <div class="card-toolbar me-2">
                <button class="btn btn-sm btn-primary" onclick="onEditBook()">
                    Edit
                </button>
            </div>
            <div class="card-toolbar me-2">
                <button class="btn btn-sm btn-danger" onclick="onDeleteBook()">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('storage/book/covers/' . $book->cover) }}" alt="{{ $book->title }}"
                                class="w-100 h-500px">
                        </div>
                        <div class="col-8">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fs-1">{{ $book->title }}</h3>
                                <div class="badge badge-light-success">{{ $book->category->name }}</div>
                            </div>
                            <p>Jumlah: {{ $book->amount }}</p>
                            <p>File: <a href="{{ asset('storage/book/files/' . $book->file) }}" target="_blank">Download</a>
                            <div>Deskripsi :</div>
                            <p>{{ $book->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function onEditBook() {
            $('#modal_edit_book [name="category_id"]').val('{{ $book->category_id }}').trigger('change');
            $('#modal_edit_book [name="title"]').val('{{ $book->title }}');
            $('#modal_edit_book [name="description"]').val('{{ $book->description }}');
            $('#modal_edit_book [name="amount"]').val('{{ $book->amount }}');
            $('#modal_edit_book').modal('show');
        }

        function onDeleteBook() {
            Swal.fire({
                title: 'Delete!',
                text: `Apakah Anda yakin ingin menghapus?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 107, 85)',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Yes, Delete!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.books.destroy', ['id' => $book->id]) }}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('admin.books.index') }}";
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            const data = xhr.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
