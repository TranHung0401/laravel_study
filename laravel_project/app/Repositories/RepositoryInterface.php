<?php
namespace App\Repositories;
interface RepositoryInterface {
    public function getAll();

    public function find($id);

    public function create($attributies = []);

    public function update($attributies = [], $id);

    public function delete($id);
}