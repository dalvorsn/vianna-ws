<?php
declare(strict_types=1);

namespace App\Domain\Person;
use JsonSerializable;

/**
 * @OA\Schema(required={"codigo", "nome", "email", "cpf", "cnpj", "data_nascimento", "endereco", "telefone"}, @OA\Xml(name="Person"))
 */

class Person implements JsonSerializable
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
    public $nome;

    /**
     * @OA\Property()
     * @var string
     */
    public $email;

    /**
     * @OA\Property()
     * @var string
     */
    public $cpf;

    /**
     * @OA\Property()
     * @var string
     */
    public $cnpj;

    /**
     * @OA\Property(
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
     public $data_nascimento;
     
    /**
     * @OA\Property()
     * @var string
     */
    public $endereco;

    /**
     * @OA\Property()
     * @var string
     */
    public $telefone;

    
    public function __construct(?int $codigo, ?string $nome, ?string $email, ?string $cpf, ?string $cnpj, ?DateTime $data_nascimento, ?string $endereco, ?string $telefone)
    {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->cnpj = $cnpj;
        $this->data_nascimento = $data_nascimento;
        $this->endereco = $endereco;
        $this->telefone = $telefone;

    }

    public static function convertClass(object $object)
    {   
        $new = new self(null, null, null, null, null, null, null, null);
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
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'data_nascimento' => $this->data_nascimento,
            'endereco' => $this->endereco,
            'telefone' => $this->telefone,

        ];
    }
}
