<?php
declare(strict_types=1);

namespace App\Domain\Launch;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "tipo", "valor", "data_vencimento"}, @OA\Xml(name="Launch"))
 */

class Launch implements JsonSerializable
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
    public $tipo;

    /**
     * @OA\Property()
     * @var double
     */
    public $valor;

    /**
     * @OA\Property(
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
     public $data_vencimento;

    
    public function __construct(?int $codigo, ?int $tipo, ?double $valor, ?DateTime $data_vencimento)
    {
        $this->codigo = $codigo;
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->data_vencimento = $data_vencimento;

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
            'tipo' => $this->tipo,
            'valor' => $this->valor,
            'data_vencimento' => $this->data_vencimento,

        ];
    }
}
