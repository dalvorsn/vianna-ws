<?php
declare(strict_types=1);

namespace App\Domain\ServiceOrder;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "codigo_atendimento_cliente", "data_chamado", "data_prevista", "data_de_execucao"}, @OA\Xml(name="ServiceOrder"))
 */

class ServiceOrder implements JsonSerializable
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
    public $codigo_atendimento_cliente;

    /**
     * @OA\Property(
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
     public $data_chamado;

    /**
     * @OA\Property(
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
     public $data_prevista;

    /**
     * @OA\Property(
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
     public $data_de_execucao;

    
    public function __construct(?int $codigo, ?int $codigo_atendimento_cliente, ?DateTime $data_chamado, ?DateTime $data_prevista, ?DateTime $data_de_execucao)
    {
        $this->codigo = $codigo;
        $this->codigo_atendimento_cliente = $codigo_atendimento_cliente;
        $this->data_chamado = $data_chamado;
        $this->data_prevista = $data_prevista;
        $this->data_de_execucao = $data_de_execucao;

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
            'codigo_atendimento_cliente' => $this->codigo_atendimento_cliente,
            'data_chamado' => $this->data_chamado,
            'data_prevista' => $this->data_prevista,
            'data_de_execucao' => $this->data_de_execucao,

        ];
    }
}
