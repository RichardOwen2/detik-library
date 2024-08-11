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

    public function index()
    {
        // $categories =

        return view('pages.user.books.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover' => 'required|image',
            'file' => 'required|file',
        ]);

        $cover = $request->file('cover');
        $file = $request->file('file');

        $category = $this->categoryService->find(auth()->id(), $request->category_id);

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

        return view('pages.user.books.detail.index', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'cover' => 'image',
            'file' => 'file',
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
