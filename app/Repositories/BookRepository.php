<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookInterface;
use Illuminate\Support\Facades\Cache;

class BookRepository implements BookInterface
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function get()
    {
        return $this->book->get();
    }

    public function paginate($limit, $page)
    {
        $cacheKey = "books_page_{$page}_limit_{$limit}";
        return Cache::remember($cacheKey, 600, function () use ($limit, $page) {
            return $this->book->paginate($limit, ['*'], 'page', $page);
        });
    }

    public function find($id)
    {
        return $this->book->find($id);
    }

    public function create(array $data)
    {
        return $this->book->create($data);
    }

    public function update($id, array $data)
    {
        $book = $this->find($id);
        $book->update($data);

        return $book;
    }

    public function delete($id)
    {
        $book = $this->find($id);
        $book->delete();

        return $book;
    }
}
