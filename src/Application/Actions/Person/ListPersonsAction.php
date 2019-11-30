<?php
declare(strict_types=1);
namespace App\Application\Actions\Person;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/people",
*     security={{"bearerAuth":{}}},
*     summary="Return all person",
*     tags={"people"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/Person")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/


class ListPersonsAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM pessoas";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "nome" => $item["nome"],
                "email" => $item["email"],
                "cpf" => $item["cpf"],
                "cnpj" => $item["cnpj"],
                "data_nascimento" => $item["data_nascimento"],
                "endereco" => $item["endereco"],
                "telefone" => $item["telefone"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
