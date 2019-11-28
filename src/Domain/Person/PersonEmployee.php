<?php
declare(strict_types=1);

namespace App\Domain\Person;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "codigo_tipo", "codigo_pessoa", "cargo", "salario"}, @OA\Xml(name="PersonEmployee"))
 */

class PersonEmployee implements JsonSerializable
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
    public $codigo_tipo;

    /**
     * @OA\Property()
     * @var int
     */
    public $codigo_pessoa;

    /**
     * @OA\Property()
     * @var string
     */
    public $cargo;

    /**
     * @OA\Property()
     * @var double
     */
    public $salario;

    
    public function __construct(?int $codigo, ?int $codigo_tipo, ?int $codigo_pessoa, ?string $cargo, ?double $salario)
    {
        $this->codigo = $codigo;
        $this->codigo_tipo = $codigo_tipo;
        $this->codigo_pessoa = $codigo_pessoa;
        $this->cargo = $cargo;
        $this->salario = $salario;

    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, null, null, null, null);
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
            'codigo_tipo' => $this->codigo_tipo,
            'codigo_pessoa' => $this->codigo_pessoa,
            'cargo' => $this->cargo,
            'salario' => $this->salario,

        ];
    }
}
