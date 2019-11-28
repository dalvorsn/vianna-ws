<?php
declare(strict_types=1);

namespace App\Domain\Item;
use JsonSerializable;

/**
 * @OA\Schema(required={"tipo", "codigo_fornecedor", "nome"}, @OA\Xml(name="Item"))
 */

class Item implements JsonSerializable
{
    /**
     * @OA\Property()
     * @var int|null
     */
    public $codigo;

    /**
     * @OA\Property()
     * @var int
     */
    public $tipo;

    /**
     * @OA\Property()
     * @var int
     */
    public $codigo_fornecedor;

    /**
     * @OA\Property()
     * @var string
     */
    public $nome;

    /**
     * @param int|null  $codigo
     * @param int       $tipo
     * @param int       $codigo_fornecedor
     * @param string    $nome
     */
    public function __construct(?int $codigo, string $tipo, string $codigo_fornecedor, string $nome)
    {
        $this->codigo = $codigo;
        $this->tipo = $tipo;
        $this->codigo_fornecedor = $codigo_fornecedor;
        $this->nome = $nome;
    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, "", "", "");
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
            'tipo' => $this->tipo,
            'codigo_fornecedor' => $this->codigo_fornecedor,
            'nome' => $this->nome,
        ];
    }
}
