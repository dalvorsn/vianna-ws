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
    
    public function __construct(?string $token)
    {
        $this->token = $token;

    }

    public static function convertClass(object $object)
    {   
        $new = new self(null);
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
            'token' => $this->token
        ];
    }
}
