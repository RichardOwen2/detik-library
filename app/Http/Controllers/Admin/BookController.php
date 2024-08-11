<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\BookService;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BookController extends Controller
{
    private $bookService;
    private $categoryService;

    public function __construct(BookService $bookService, CategoryService $categoryService)
    {
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $category_id = ($request->category_id === '*' || !$request->category_id) ? null : $request->category_id;
        $books = $this->bookService->get($category_id);
        $categories = $this->categoryService->get();

        return view('pages.admin.books.index', compact([
            'categories', 'books',
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg',
            'file' => 'required|file|mimes:pdf',
        ]);

        $cover = $request->file('cover');
        $file = $request->file('file');

        $category = $this->categoryService->find($request->category_id);

        if (!$category) {
            throw new HttpException(404, 'Kategori tidak ditemukan');
        }

        $this->bookService->store(
            auth()->id(),
            $request->category_id,
            $request->title,
            $request->description,
            $request->amount,
            $cover,
            $file
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil disimpan',
        ]);
    }

    public function show($id)
    {
        $book = $this->bookService->find($id);
        $categories = $this->categoryService->get();

        return view('pages.admin.books.detail.index', compact([
            'book', 'categories',
        ]));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg',
            'file' => 'nullable|file|mimes:pdf',
        ]);

        $cover = $request->file('cover');
        $file = $request->file('file');

        $category = $this->categoryService->find($request->category_id);

        if (!$category) {
            throw new HttpException(404, 'Kategori tidak ditemukan');
        }

        $this->bookService->update(
            $id,
            $request->category_id,
            $request->title,
            $request->description,
            $request->amount,
            $cover,
            $file
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil diperbarui',
        ]);
    }

    public function destroy($id)
    {
        $this->bookService->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Buku berhasil dihapus',
        ]);
    }
}
