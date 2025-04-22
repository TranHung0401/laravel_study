<?php
namespace App\Repositories;

use App\Repositories\RepositoriesInterface;

abstract class BaseRepositories implements RepositoriesInterface{
    protected $model;

    public function __construct() {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();

    public function all(){
        return $this->model->all();
    }
    public function find($id){
        return $this->model->findOrFail($id);
    }
    public function create($data){
        return $this->model->create($data);
    }
    public function update($data, $id){
        $object = $this->model->find($id);
        return $object->update($data);
    }
    public function delete($id){
        $object = $this->model->find($id);
        return $object->delete();
    }

    public function searchAndPaginate($searchBy,$keyword, $limit) {
        $data = $this->model;
        if(!empty($keyword)){
            $data = $data->where($searchBy,'like','%'.$keyword.'%')
            ->orderBy('id','desc');
        }
        $data = $data->paginate($limit)->appends(['search'=> $keyword]);

        return $data;
    
}

}