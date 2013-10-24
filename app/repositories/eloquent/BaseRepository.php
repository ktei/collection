<?php

namespace Rui\Collection\Repositories\Eloquent;


abstract class BaseRepository {

    protected $model = null;

    public function findOrFail($id) {
        if ($this->model == null) {
            throwException(new \Exception('No model name is set.'));
        }
        return call_user_func($this->model . '::findOrFail', $id);
    }

    protected function createModel($className, array $params) {
        $model = new $className;
        $this->setAttributes($model, $params);
        $model->save();
        return $model;
    }

    protected function updateModel($className, array $params) {
        $model = call_user_func($className . '::findOrFail', $params['id']);
        $this->setAttributes($model, $params);
        $model->save();
    }

    protected function setAttributes($model, array $params) {
        foreach ($params as $key => $val) {
            $model->$key = $val;
        }
    }
}