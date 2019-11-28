<?php
declare(strict_types=1);

namespace App\Domain\Launch;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "codigo_lancamento", "codigo_fornecedor", "pago", "descricao", "data_pagamento"}, @OA\Xml(name="LaunchIncome"))
 */

class LaunchIncome implements JsonSerializable
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
    public $codigo_lancamento;

    /**
     * @OA\Property()
     * @var int
     */
    public $codigo_fornecedor;

    /**
     * @OA\Property()
     * @var bool
     */
    public $pago;

    /**
     * @OA\Property()
     * @var string
     */
    public $descricao;

    /**
     * @OA\Property(
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
     public $data_pagamento;

    
    public function __construct(?int $codigo, ?int $codigo_lancamento, ?int $codigo_fornecedor, ?bool $pago, ?string $descricao, ?DateTime $data_pagamento)
    {
        $this->codigo = $codigo;
        $this->codigo_lancamento = $codigo_lancamento;
        $this->codigo_fornecedor = $codigo_fornecedor;
        $this->pago = $pago;
        $this->descricao = $descricao;
        $this->data_pagamento = $data_pagamento;

    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, null, null, null, null, null);
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
            'codigo_lancamento' => $this->codigo_lancamento,
            'codigo_fornecedor' => $this->codigo_fornecedor,
            'pago' => $this->pago,
            'descricao' => $this->descricao,
            'data_pagamento' => $this->data_pagamento,

        ];
    }
}
