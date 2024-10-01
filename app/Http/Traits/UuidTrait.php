<?php

namespace App\Http\Traits;

use Ramsey\Uuid\Rfc4122\UuidV8;

trait UuidTrait
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->keyType = 'string';
            $model->incrementing = false;

            $model->{$model->getKeyName()} = $model->{$model->getKeyName()} ?: (string) UuidV8::uuid4()->toString();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
