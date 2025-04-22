<?php

namespace App\Services;

interface ServiceInterface {
    public function all();
    public function find($id);
    public function create($data);
    public function update($data, $id  );
    public function delete($id);
    public function searchAndPaginate($searchBy,$keyword, $limit);
}