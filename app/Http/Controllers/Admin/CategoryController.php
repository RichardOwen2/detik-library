<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('pages.user.categories.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $this->categoryService->store(auth()->id(), $request->name);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil disimpan',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $this->categoryService->update($id, $request->name);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil diperbarui',
        ]);
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus',
        ]);
    }
}
