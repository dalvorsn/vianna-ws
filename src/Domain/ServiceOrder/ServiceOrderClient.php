<?php
declare(strict_types=1);

namespace App\Domain\ServiceOrder;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "codigo_cliente", "codigo_funcionario", "descricao"}, @OA\Xml(name="ServiceOrderClient"))
 */

class ServiceOrderClient implements JsonSerializable
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
    public $codigo_cliente;

    /**
     * @OA\Property()
     * @var int
     */
    public $codigo_funcionario;

    /**
     * @OA\Property()
     * @var string
     */
    public $descricao;

    
    public function __construct(?int $codigo, ?int $codigo_cliente, ?int $codigo_funcionario, ?string $descricao)
    {
        $this->codigo = $codigo;
        $this->codigo_cliente = $codigo_cliente;
        $this->codigo_funcionario = $codigo_funcionario;
        $this->descricao = $descricao;

    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, null, null, null);
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
            'codigo_cliente' => $this->codigo_cliente,
            'codigo_funcionario' => $this->codigo_funcionario,
            'descricao' => $this->descricao,

        ];
    }
}
