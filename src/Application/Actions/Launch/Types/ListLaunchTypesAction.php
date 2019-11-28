<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch\Types;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/launch-type",
*     summary="Return all launch type",
*     tags={"launch-type"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/LaunchTypes")
*         )
*     ),
* )
*/


class ListLaunchTypesAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM lancamentos_tipos";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "descricao" => $item["descricao"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
