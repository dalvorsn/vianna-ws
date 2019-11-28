<?php
declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use PDO;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="API to consume logistic data"
 * )
 */

abstract class Action
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
    * PDO instance connection
    */
    protected $db;


    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger, PDO $conn)
    {
        $this->logger = $logger;
        $this->db = $conn;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @return array|object
     * @throws HttpBadRequestException
     */
    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param  string $name
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    /**
     * @param  array|object|null $data
     * @return Response
     */
    protected function respondWithData($data = null): Response
    {
        $payload = new ActionPayload(200, $data);
        return $this->respond($payload);
    }

    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);
        return $this->response->withHeader('Content-Type', 'application/json');
    }

    protected function fetchResult(String $query, Array $params, String $message = "Resource not found.") {
        $stm = $this->db->prepare($query);
        $stm->execute($params);

        $ret = $stm->fetch();
        if(!$ret) {
            throw new \App\Domain\DomainException\DomainRecordNotFoundException($message);
        }

        return $ret;
    }

    protected function fetchResults(String $query, Array $params = []) {
        $stm = $this->db->prepare($query);
        $stm->execute($params);

        return $stm->fetchAll();
    }    

    protected function delete(String $query, Array $params = [])
    {   
        $stm = $this->db->prepare($query);
        $stm->execute($params);
        return $stm->rowCount();
    }

    protected function insert(String $query, Array $params = [])
    {   
        $stm = $this->db->prepare($query);
        $stm->execute($params);
        return $this->db->lastInsertId();
    }

    protected function update(String $query, Array $params = [])
    {   
        $stm = $this->db->prepare($query);
        $stm->execute($params);
        return $stm->rowCount();
    }
}
