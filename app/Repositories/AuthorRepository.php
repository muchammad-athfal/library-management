<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorInterface;

class AuthorRepository implements AuthorInterface
{
    protected $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function get()
    {
        return $this->author->get();
    }

    public function paginate($limit = 10)
    {
        return $this->author->paginate($limit);
    }

    public function find($id)
    {
        return $this->author->find($id);
    }

    public function create(array $data)
    {
        return $this->author->create($data);
    }

    public function update($id, array $data)
    {
        $author = $this->find($id);
        $author->update($data);

        return $author;
    }

    public function delete($id)
    {
        $author = $this->find($id);
        $author->delete();

        return $author;
    }
}
