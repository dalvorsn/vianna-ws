<?php
declare(strict_types=1);
namespace App\Application\Actions\Person;

use App\Application\Actions\Action;
use DateTime;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

/**
* @OA\Get(
*     path="/people/{codigo}/type",
*     security={{"bearerAuth":{}}},
*     summary="Get person type by codigo",
*     description="Returns a single person",
*     tags={"people"},
*     @OA\Parameter(
*         description="Identificator of person to return",
*         in="path",
*         name="codigo",
*         required=true,
*         @OA\Schema(
*           type="integer",
*           format="int64"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Returning a codigo_tipo",
*     ),
*     @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*     ),
*     @OA\Response(
*         response="404",
*         description="Person not found"
*     ),
* )
*/

class GetPersonTypeAction extends Action
{
    protected function action(): Response
    {
        $codigo = $this->resolveArg("codigo");

        $query = "
        SELECT 
          (
            select codigo_tipo from pessoas_clientes pc where codigo_pessoa = p.codigo
            UNION
            select codigo_tipo from pessoas_fornecedores pf where codigo_pessoa = p.codigo
            UNION 
            select codigo_tipo from pessoas_funcionarios pe where codigo_pessoa = p.codigo
          limit 1 ) as codigo_tipo
        FROM pessoas p
        WHERE p.codigo = :codigo";

        $item = $this->fetchResult($query, [
            "codigo" => $codigo
        ], "Person not found.");

        return $this->respondWithData($item['codigo_tipo']);
    }
}
