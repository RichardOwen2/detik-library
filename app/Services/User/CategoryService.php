<?php

namespace App\Services\User;

use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class CategoryService.
 */
class CategoryService
{
    public function get($user_id)
    {
        return Category::where('user_id', $user_id)->get();
    }

    public function getWithPagination($user_id, $page = 1, $count = 10)
    {
        return Category::where('user_id', $user_id)->paginate($count, ['*'], 'page', $page);
    }

    public function find($user_id, $id)
    {
        $category = Category::where('user_id', $user_id)->find($id);

        if (!$category) {
            throw new HttpException(404, 'Kategori tidak ditemukan');
        }

        return $category;
    }

    public function store($user_id, $name)
    {
        Category::create([
            'user_id' => $user_id,
            'name' => $name,
        ]);
    }

    public function update($user_id, $id, $name)
    {
        $category = $this->find($user_id, $id);

        $category->update([
            'name' => $name,
        ]);
    }

    public function delete($user_id, $id)
    {
        $category = Category::where('user_id', $user_id)->find($id);

        if (!$category) {
            throw new HttpException(404, 'Kategori tidak ditemukan');
        }

        if ($category->books->count() > 0) {
            throw new HttpException(400, 'Kategori tidak bisa dihapus karena memiliki buku');
        }

        $category->delete();
    }

    public function datatable($user_id)
    {
        $query = Category::where('user_id', $user_id);

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return view('pages.user.categories.menu', compact('query'));
            })
            ->addColumn('book_count', function ($query) {
                return $query->books->count() . ' Buku';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
