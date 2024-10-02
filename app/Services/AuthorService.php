<?php

namespace App\Services;

use App\Helpers\ServiceHelper;
use App\Repositories\Interfaces\AuthorInterface;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class AuthorService
{
    public function __construct(protected AuthorInterface $authorRepository) {}

    public function get()
    {
        return $this->authorRepository->get();
    }

    public function paginate($limit, $page)
    {
        return $this->authorRepository->paginate($limit, $page);
    }

    public function find($id)
    {
        $data = $this->authorRepository->find($id);

        if (!$data) {
            throw new InvalidArgumentException('Author not found', 404);
        }

        return $data;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $createAuthor = $this->authorRepository->create($data);
            ServiceHelper::clearCache('authors');
            DB::commit();

            return $createAuthor;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }

    public function update($id, array $data)
    {
        $author = $this->find($id);

        DB::beginTransaction();
        try {
            $updateData = $this->authorRepository->update($author->id, $data);
            ServiceHelper::clearCache('authors');

            DB::commit();

            return $updateData;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        $author = $this->find($id);

        DB::beginTransaction();
        try {
            $deleteData = $this->authorRepository->delete($author->id);
            ServiceHelper::clearCache('authors');

            DB::commit();

            return $deleteData;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }
}
