<?php
declare(strict_types=1);

namespace App\Domain\Item;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "codigo_item", "data_aquisicao"}, @OA\Xml(name="ItemTool"))
 */

class ItemTool implements JsonSerializable
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
    public $codigo_item

    /**
    * @OA\Property(
    *     format="datetime",
    *     type="string"
    * )
    *
    * @var \DateTime
    */
    public $data_aquisicao
    
    function __construct(?int $codigo, ?int $codigo_item, ?DateTime $data_aquisicao)
    {
        $this->codigo = $codigo;
        $this->codigo_item = $codigo_item;
        $this->data_aquisicao = $data_aquisicao;
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
            'codigo_item' => $this->codigo_item,
            'data_aquisicao' => $this->data_aquisicao,
        ];
    }
}