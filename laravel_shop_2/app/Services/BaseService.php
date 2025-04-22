<?php
namespace App\Services;
class BaseService implements ServiceInterface {
    public $repository;
    public function all(){
        return $this->repository->all();
    }
    public function find($id){
        return $this->repository->find($id);
    }
    public function create($data){
        return $this->repository->create($data);
    }
    public function update($data, $id){
        return $this->repository->update($data,$id);
    }
    public function delete($id) {
        return $this->repository->delete($id);
    }

    public function searchAndPaginate($searchBy,$keyword, $limit = 5) {
        return $this->repository->searchAndPaginate($searchBy,$keyword, $limit);
    }
}