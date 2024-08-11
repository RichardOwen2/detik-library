@extends('layouts.app')
@section('title', 'Books')

@section('modal')
    @include('pages.user.books.modal.add')
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">List Buku</span>
        </h3>

        <div class="d-flex">
            <div class="card-toolbar me-2">
                <a href="{{ route('books.export') }}" target="_blank" class="btn btn-sm btn-success">
                    Export Buku
                </a>
            </div>
            <div class="card-toolbar me-2">
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add_book">
                    Tambah Buku
                </a>
            </div>
        </div>
    </div>

    <div class="mb-4 mt-3 d-flex justify-content-end">
        <div>
            <select class="form-select form-select-solid mw-500px" data-control="select2" data-hide-search="true" id="filter_category"
                data-placeholder="">
                <option value="*">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="row">
        @if ($books->isEmpty())
            <div class="col-12">
                <div class="alert alert-info">
                    Tidak ada data
                </div>
            </div>
        @endif
        @foreach ($books as $book)
            @include('components.book', [
                'href' => route('books.show', $book->id),
                'title' => $book->title,
                'image' => asset('storage/book/covers/' . $book->cover),
                'category' => $book->category->name,
            ])
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const category_id = urlParams.get('category_id');

            if (category_id !== null && category_id !== '*') {
                $('#filter_category').val(category_id).trigger('change');
            }

            $('#filter_category').change(function() {
                const category_id = $(this).val();
                window.location.href = `?category_id=${category_id}`;
            });
        });
    </script>
@endsection
