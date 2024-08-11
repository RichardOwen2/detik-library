<?php

namespace App\Services\User;

use App\Models\Book;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class BookService.
 */
class BookService
{
    public function get($user_id, $category_id = null)
    {
        $books = Book::where('user_id', $user_id);

        if ($category_id) {
            $books->where('category_id', $category_id);
        }

        return $books->get();
    }

    public function getWithPagination($user_id, $page = 1, $count = 10)
    {
        return Book::where('user_id', $user_id)->paginate($count, ['*'], 'page', $page);
    }

    public function find($user_id, $id)
    {
        $book = Book::where('user_id', $user_id)->find($id);

        if (!$book) {
            throw new HttpException(404, 'Buku tidak ditemukan');
        }

        return $book;
    }

    public function store($user_id, $category_id, $title, $description, $amount, $cover, $file)
    {
        $coverPath = $user_id . '_' . time() . '_' . $cover->getClientOriginalName();
        $cover->storeAs('public/book/covers', $coverPath);

        $filePath = $user_id . '_' . time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/book/files', $filePath);

        Book::create([
            'user_id' => $user_id,
            'category_id' => $category_id,
            'title' => $title,
            'description' => $description,
            'amount' => $amount,
            'cover' => $coverPath,
            'file' => $filePath,
        ]);
    }

    public function update($user_id, $id, $category_id, $title, $description, $amount, $cover, $file)
    {
        $book = $this->find($user_id, $id);

        $coverPath = $book->cover;
        if ($cover) {
            $coverPath = $book->user_id . '_' . time() . '_' . $cover->getClientOriginalName();
            $cover->storeAs('public/book/covers', $coverPath);
        }

        $filePath = $book->file;
        if ($file) {
            $filePath = $book->user_id . '_' . time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/book/files', $filePath);
        }

        $book->update([
            'title' => $title,
            'category_id' => $category_id,
            'description' => $description,
            'amount' => $amount,
            'cover' => $coverPath,
            'file' => $filePath,
        ]);
    }

    public function delete($user_id, $id)
    {
        $book = $this->find($user_id, $id);

        if (!$book) {
            throw new HttpException(404, 'Buku tidak ditemukan');
        }

        $book->delete();
    }
}
