<?php
declare(strict_types=1);
namespace App\Application\Actions\Person\Provider;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/people-provider",
*     summary="Return all provider",
*     tags={"people-provider"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/PersonProvider")
*         )
*     ),
* )
*/


class ListPersonsProviderAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM pessoas_fornecedores";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "codigo_tipo" => $item["codigo_tipo"],
                "codigo_pessoa" => $item["codigo_pessoa"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
