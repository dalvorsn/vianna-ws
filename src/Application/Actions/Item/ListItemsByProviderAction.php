<?php
declare(strict_types=1);
namespace App\Application\Actions\Item;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
* @OA\Get(
*     path="/items/{codigo_fornecedor}/provider",
*     security={{"bearerAuth":{}}},
*     summary="Return all provider items",
*     tags={"items"},
*     @OA\Parameter(
*         description="Identification code of provider",
*         in="path",
*         name="codigo_fornecedor",
*         required=true,
*         @OA\Schema(
*           type="integer",
*           format="int64"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="successful operation",
*         @OA\JsonContent(
*            type="array",
*            @OA\Items(ref="#/components/schemas/ItemProvider")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
* )
*/


class ListItemsByProviderAction extends Action
{
    protected function action(): Response
    {
        $codigo_fornecedor = $this->resolveArg("codigo_fornecedor");

        $query = 
        "SELECT 
            i.codigo, i.tipo, i.codigo_fornecedor, i.nome, 
            ime.codigo AS codigo_item, ime.lote, ime.data_aquisicao
        FROM itens_materiais_escritorio ime 
            INNER JOIN itens i 
                ON i.codigo = ime.codigo_item
        WHERE 
            codigo_fornecedor = :codigo_fornecedor";

        $items = $this->fetchResults($query, [ "codigo_fornecedor" => $codigo_fornecedor ]);

        $ret = [];
        foreach( $items as $item ) {
            array_push($ret, [
                "codigo" => $item["codigo"],
                "tipo" => $item["tipo"],
                "codigo_fornecedor" => $item["codigo_fornecedor"],
                "nome" => utf8_encode($item["nome"]),
                "codigo_item" => $item["codigo_item"],
                "lote" => utf8_encode($item["lote"]),
                "data_aquisicao" => $item["data_aquisicao"],
            ]);
        }

        return $this->respondWithData($ret);
    }
}
