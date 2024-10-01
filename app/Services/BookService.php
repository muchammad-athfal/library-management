<?php

namespace App\Services;

use App\Repositories\Interfaces\BookInterface;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class BookService
{
    public function __construct(protected BookInterface $bookRepository) {}

    public function get()
    {
        return $this->bookRepository->get();
    }

    public function paginate($limit)
    {
        return $this->bookRepository->paginate($limit);
    }

    public function find($id)
    {
        $data = $this->bookRepository->find($id);

        if (!$data) {
            throw new InvalidArgumentException('Book not found', 404);
        }

        return $data;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $createAuthor = $this->bookRepository->create($data);
            DB::commit();

            return $createAuthor;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }

    public function update($id, array $data)
    {
        $book = $this->find($id);

        DB::beginTransaction();
        try {
            $updateData = $this->bookRepository->update($book->id, $data);;
            DB::commit();

            return $updateData;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        $book = $this->find($id);

        DB::beginTransaction();
        try {
            $deleteData = $this->bookRepository->delete($book->id);
            DB::commit();

            return $deleteData;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }
}
