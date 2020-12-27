<?php

namespace Spatie\LaravelRay\Payloads;

use Illuminate\Database\Eloquent\Model;
use Spatie\Ray\ArgumentConvertor;
use Spatie\Ray\Payloads\Payload;

class ModelPayload extends Payload
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getType(): string
    {
        return 'eloquent_model';
    }

    public function getContent(): array
    {
        $content = [
            'class_name' => get_class($this->model),
            'attributes' => ArgumentConvertor::convertToPrimitive($this->model->attributesToArray()),

        ];

        $relations = $this->model->relationsToArray();

        if (count($relations)) {
            $content['relations'] = ArgumentConvertor::convertToPrimitive($relations);
        }

        return $content;
    }
}
