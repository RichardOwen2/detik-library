<?php

namespace App\Services\Admin;

use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class CategoryService.
 */
class CategoryService
{
    public function get()
    {
        return Category::all();
    }

    public function getWithPagination($page = 1, $count = 10)
    {
        return Category::paginate($count, ['*'], 'page', $page);
    }

    public function find($id)
    {
        $category = Category::find($id);

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

    public function update($id, $name)
    {
        $category = $this->find($id);

        if (!$category) {
            throw new HttpException(404, 'Kategori tidak ditemukan');
        }

        $category->update([
            'name' => $name,
        ]);
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            throw new HttpException(404, 'Kategori tidak ditemukan');
        }

        $category->delete();
    }
}
