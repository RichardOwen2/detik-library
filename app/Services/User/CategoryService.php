<?php

namespace App\Services\User;

use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

        $category->delete();
    }
}
