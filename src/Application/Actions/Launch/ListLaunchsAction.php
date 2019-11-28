<?php
declare(strict_types=1);
namespace App\Application\Actions\Launch;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/launch",
*     summary="Return all launch",
*     tags={"launch"},
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/Launch")
*         )
*     ),
* )
*/


class ListLaunchsAction extends Action
{
    protected function action(): Response
    {
        $query = "SELECT * FROM lancamentos";
        $items = $this->fetchResults($query);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "tipo" => $item["tipo"],
                "valor" => $item["valor"],
                "data_vencimento" => $item["data_vencimento"],

            ]);
        }

        return $this->respondWithData($ret);
    }
}
