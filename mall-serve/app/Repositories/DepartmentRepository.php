<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class DepartmentRepository extends Repository 
{
    public function  model() 
    {
        return 'App\Models\Department';
    }
    
    public function  setModelAppends() 
    {
//         dd($this->model);
        $this->model->setAppends(['type_text','user','phone']);
        
//         $this->model->addVisible(['type_text','user','phone']);
    }
    
    /**
     * 这才有效果的 上面这个没效果
     * @param unknown $collection
     * @param unknown $attributes
     * @return unknown
     */
    public static function  setVisible($collection, $attributes) 
    {
        foreach ($collection as &$model) {
            $model->setAppends($attributes);
        }
        return $collection;
    }
}