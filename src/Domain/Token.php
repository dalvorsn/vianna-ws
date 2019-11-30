<?php
declare(strict_types=1);

namespace App\Domain;
use JsonSerializable;

/**
 * @OA\Schema(required={"token"}, @OA\Xml(name="Token"))
 */

class Token implements JsonSerializable
{
    /**
     * @OA\Property()
     * @var string
     */
    public $token;

    /**
     * @OA\Property()
     * @var int
     */
    public $codigo_pessoa;
    
    public function __construct(?string $token, ?int $codigo_pessoa)
    {
        $this->token = $token;
        $this->codigo_pessoa = $codigo_pessoa;
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
            'token' => $this->token,
            'codigo_pessoa' => $this->codigo_pessoa,
        ];
    }
}
