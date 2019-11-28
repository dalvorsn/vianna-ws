<?php
declare(strict_types=1);

namespace App\Domain\Launch;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "descricao"}, @OA\Xml(name="LaunchTypes"))
 */

class LaunchTypes implements JsonSerializable
{
    /**
     * @OA\Property()
     * @var int
     */
    public $codigo;

    /**
     * @OA\Property()
     * @var string
     */
    public $descricao;

    
    public function __construct(?int $codigo, ?string $descricao)
    {
        $this->codigo = $codigo;
        $this->descricao = $descricao;

    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, null);
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
            'descricao' => $this->descricao,

        ];
    }
}
