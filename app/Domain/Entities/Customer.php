<?php

namespace App\Domain\Entities;

use Raiadrogasil\Common\Entity\BaseEntity;

class Customer extends BaseEntity
{
    public $table = 'customer';

    /**
     * atributos disponiveis
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'cpf',
        'cep',
        'created_at',
        'updated_at',
    ];


    /**
     * atributos que sofrerao cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
