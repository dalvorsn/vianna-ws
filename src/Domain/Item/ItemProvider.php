<?php
declare(strict_types=1);

namespace App\Domain\Item;
use JsonSerializable;

/**
 * @OA\Schema(required={"tipo", "codigo_fornecedor", "nome"}, @OA\Xml(name="ItemProvider"))
 */

class ItemProvider implements JsonSerializable
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
     * @OA\Property()
     * @var int
     */
    public $codigo_item;

    /**
     * @OA\Property()
     * @var string
     */
    public $lote;

    /**
     * @OA\Property()
     * @var \DateTime
     */
    public $data_aquisicao;

    public function __construct(?int $codigo, ?string $tipo, ?string $codigo_fornecedor, ?string $nome, ?int $codigo_item, ?string $lote, ?DateTime $data_aquisicao)
    {
        $this->codigo = $codigo;
        $this->tipo = $tipo;
        $this->codigo_fornecedor = $codigo_fornecedor;
        $this->nome = $nome;
        $this->codigo_item = $codigo_item;
        $this->lote = $lote;
        $this->data_aquisicao = $data_aquisicao;
    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, null, null, null, null, null, null);
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
            'codigo_item' => $this->codigo_item,
            'lote' => $this->lote,
            'data_aquisicao' => $this->data_aquisicao,
        ];
    }
}
