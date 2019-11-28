<?php
declare(strict_types=1);

namespace App\Domain\Item;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo_item", "lote", "data_aquisicao"}, @OA\Xml(name="ItemOffice"))
 */

class ItemOffice implements JsonSerializable
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
    public $codigo_item;

    /**
     * @OA\Property()
     * @var string
     */
    public $lote;

    /**
     * @OA\Property(
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    public $data_aquisicao;

    /**
     * @param int|null  $codigo
     * @param int       $codigo_item
     * @param string    $lote
     * @param datetime  $data_aquisicao
     */
    
  function __construct(?int $codigo, ?int $codigo_item, ?string $lote, ?DateTime $data_aquisicao)
  {
    $this->codigo = $codigo;
    $this->codigo_item = $codigo_item;
    $this->lote = $lote;
    $this->data_aquisicao = $data_aquisicao;
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
            'codigo_item' => $this->codigo_item,
            'lote' => $this->lote,
            'data_aquisicao' => $this->data_aquisicao,
        ];
    }
}