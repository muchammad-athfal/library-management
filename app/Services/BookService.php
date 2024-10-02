<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
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

    public function paginate($limit, $page)
    {
        return $this->bookRepository->paginate($limit, $page);
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
            ServiceHelper::clearCache('books');

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
            $updateData = $this->bookRepository->update($book->id, $data);
            ServiceHelper::clearCache('books');

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
            ServiceHelper::clearCache('books');

            DB::commit();

            return $deleteData;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }
}
