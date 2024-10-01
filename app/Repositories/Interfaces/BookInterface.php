<?php

namespace App\Repositories\Interfaces;

interface BookInterface
{
    public function get();
    public function paginate($limit);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
