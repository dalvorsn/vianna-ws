<?php
declare(strict_types=1);

namespace App\Domain\ServiceOrder;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "codigo_ordem_servico", "codigo_funcionario"}, @OA\Xml(name="ServiceOrderEmployee"))
 */

class ServiceOrderEmployee implements JsonSerializable
{
    /**
     * @OA\Property()
     * @var int
     */
    public $codigo;

    /**
     * @OA\Property()
     * @var int
     */
    public $codigo_ordem_servico;

    /**
     * @OA\Property()
     * @var int
     */
    public $codigo_funcionario;

    
    public function __construct(?int $codigo, ?int $codigo_ordem_servico, ?int $codigo_funcionario)
    {
        $this->codigo = $codigo;
        $this->codigo_ordem_servico = $codigo_ordem_servico;
        $this->codigo_funcionario = $codigo_funcionario;

    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, null, null);
        $attributes = get_class_vars(get_class($new));
        foreach ($attributes as $key => $value)
        {   
            if(property_exists($object, $key)) {
                $new->{$key} = $object->{$key};
            }
        }

        return $new;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'codigo' => $this->codigo,
            'codigo_ordem_servico' => $this->codigo_ordem_servico,
            'codigo_funcionario' => $this->codigo_funcionario,

        ];
    }
}
