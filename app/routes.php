<?php
declare(strict_types=1);

use App\Application\Actions\Token;

use App\Application\Actions\Item\ViewItemAction;
use App\Application\Actions\Item\ListItemsAction;
use App\Application\Actions\Item\CreateItemAction;
use App\Application\Actions\Item\UpdateItemAction;
use App\Application\Actions\Item\DeleteItemAction;

use App\Application\Actions\Item\Tools\ViewItemToolsAction;
use App\Application\Actions\Item\Tools\ListItemsToolsAction;
use App\Application\Actions\Item\Tools\CreateItemToolsAction;
use App\Application\Actions\Item\Tools\UpdateItemToolsAction;
use App\Application\Actions\Item\Tools\DeleteItemToolsAction;

use App\Application\Actions\Item\Furniture\ViewItemFurnitureAction;
use App\Application\Actions\Item\Furniture\ListItemsFurnituresAction;
use App\Application\Actions\Item\Furniture\CreateItemFurnitureAction;
use App\Application\Actions\Item\Furniture\UpdateItemFurnitureAction;
use App\Application\Actions\Item\Furniture\DeleteItemFurnitureAction;

use App\Application\Actions\Item\Office\ViewItemOfficeAction;
use App\Application\Actions\Item\Office\ListItemsOfficeAction;
use App\Application\Actions\Item\Office\CreateItemOfficeAction;
use App\Application\Actions\Item\Office\UpdateItemOfficeAction;
use App\Application\Actions\Item\Office\DeleteItemOfficeAction;

use App\Application\Actions\Person\CreatePersonAction;
use App\Application\Actions\Person\DeletePersonAction;
use App\Application\Actions\Person\ListPersonsAction;
use App\Application\Actions\Person\UpdatePersonAction;
use App\Application\Actions\Person\ViewPersonAction;
use App\Application\Actions\Person\GetPersonTypeAction;

use App\Application\Actions\Person\Employee\CreatePersonEmployeeAction;
use App\Application\Actions\Person\Employee\DeletePersonEmployeeAction;
use App\Application\Actions\Person\Employee\ListPersonsEmployeeAction;
use App\Application\Actions\Person\Employee\UpdatePersonEmployeeAction;
use App\Application\Actions\Person\Employee\ViewPersonEmployeeAction;

use App\Application\Actions\Person\Customer\CreatePersonCustomerAction;
use App\Application\Actions\Person\Customer\DeletePersonCustomerAction;
use App\Application\Actions\Person\Customer\ListPersonsCustomerAction;
use App\Application\Actions\Person\Customer\UpdatePersonCustomerAction;
use App\Application\Actions\Person\Customer\ViewPersonCustomerAction;
use App\Application\Actions\Person\Customer\FindPersonCustomerAction;

use App\Application\Actions\Person\Provider\CreatePersonProviderAction;
use App\Application\Actions\Person\Provider\DeletePersonProviderAction;
use App\Application\Actions\Person\Provider\ListPersonsProviderAction;
use App\Application\Actions\Person\Provider\UpdatePersonProviderAction;
use App\Application\Actions\Person\Provider\ViewPersonProviderAction;

use App\Application\Actions\ServiceOrder\CreateServiceOrderAction;
use App\Application\Actions\ServiceOrder\DeleteServiceOrderAction;
use App\Application\Actions\ServiceOrder\ListServiceOrdersAction;
use App\Application\Actions\ServiceOrder\UpdateServiceOrderAction;
use App\Application\Actions\ServiceOrder\ViewServiceOrderAction;

use App\Application\Actions\ServiceOrder\Employee\CreateServiceOrderEmployeeAction;
use App\Application\Actions\ServiceOrder\Employee\DeleteServiceOrderEmployeeAction;
use App\Application\Actions\ServiceOrder\Employee\ListServiceOrderEmployeesAction;
use App\Application\Actions\ServiceOrder\Employee\UpdateServiceOrderEmployeeAction;
use App\Application\Actions\ServiceOrder\Employee\ViewServiceOrderEmployeeAction;

use App\Application\Actions\ServiceOrder\Tools\CreateServiceOrderToolsAction;
use App\Application\Actions\ServiceOrder\Tools\DeleteServiceOrderToolsAction;
use App\Application\Actions\ServiceOrder\Tools\ListServiceOrderToolssAction;
use App\Application\Actions\ServiceOrder\Tools\UpdateServiceOrderToolsAction;
use App\Application\Actions\ServiceOrder\Tools\ViewServiceOrderToolsAction;

use App\Application\Actions\ServiceOrder\Client\CreateServiceOrderClientAction;
use App\Application\Actions\ServiceOrder\Client\DeleteServiceOrderClientAction;
use App\Application\Actions\ServiceOrder\Client\ListServiceOrderClientsAction;
use App\Application\Actions\ServiceOrder\Client\UpdateServiceOrderClientAction;
use App\Application\Actions\ServiceOrder\Client\ViewServiceOrderClientAction;

use App\Application\Actions\Launch\CreateLaunchAction;
use App\Application\Actions\Launch\DeleteLaunchAction;
use App\Application\Actions\Launch\ListLaunchsAction;
use App\Application\Actions\Launch\UpdateLaunchAction;
use App\Application\Actions\Launch\ViewLaunchAction;

use App\Application\Actions\Launch\Types\CreateLaunchTypeAction;
use App\Application\Actions\Launch\Types\DeleteLaunchTypeAction;
use App\Application\Actions\Launch\Types\ListLaunchTypesAction;
use App\Application\Actions\Launch\Types\UpdateLaunchTypeAction;
use App\Application\Actions\Launch\Types\ViewLaunchTypeAction;

use App\Application\Actions\Launch\Income\CreateLaunchIncomeTypeAction;
use App\Application\Actions\Launch\Income\DeleteLaunchIncomeTypeAction;
use App\Application\Actions\Launch\Income\ListLaunchIncomeTypesAction;
use App\Application\Actions\Launch\Income\UpdateLaunchIncomeTypeAction;
use App\Application\Actions\Launch\Income\ViewLaunchIncomeTypeAction;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

  $app->redirect('/', '/doc', 301);

  $app->post('/token', Token::class);
  
  $app->group('/items', function (Group $group) use ($app) {
    $group->get('', ListItemsAction::class);
    $group->get('/{codigo}', ViewItemAction::class);
    $group->post('', CreateItemAction::class);
    $group->put('', UpdateItemAction::class);
    $group->delete('/{codigo}', DeleteItemAction::class);
  });

  $app->group('/items-tools', function (Group $group) use ($app) {
    $group->get('', ListItemsToolsAction::class);
    $group->get('/{codigo}', ViewItemToolsAction::class);
    $group->post('', CreateItemToolsAction::class);
    $group->put('', UpdateItemToolsAction::class);
    $group->delete('/{codigo}', DeleteItemToolsAction::class);
  });

  $app->group('/items-furniture', function (Group $group) use ($app) {
    $group->get('', ListItemsFurnituresAction::class);
    $group->get('/{codigo}', ViewItemFurnitureAction::class);
    $group->post('', CreateItemFurnitureAction::class);
    $group->put('', UpdateItemFurnitureAction::class);
    $group->delete('/{codigo}', DeleteItemFurnitureAction::class);
  });

  $app->group('/items-office', function (Group $group) use ($app) {
    $group->get('', ListItemsOfficeAction::class);
    $group->get('/{codigo}', ViewItemOfficeAction::class);
    $group->post('', CreateItemOfficeAction::class);
    $group->put('', UpdateItemOfficeAction::class);
    $group->delete('/{codigo}', DeleteItemOfficeAction::class);        
  });

  $app->group('/people', function (Group $group) use ($app) {
    $group->post('', CreatePersonAction::class);
    $group->delete('/{codigo}', DeletePersonAction::class);
    $group->get('', ListPersonsAction::class);
    $group->put('', UpdatePersonAction::class);
    $group->get('/{codigo}', ViewPersonAction::class);

    $group->get('/{codigo}/type', GetPersonTypeAction::class);
  });

  $app->group('/people-employee', function (Group $group) use ($app) {
    $group->post('', CreatePersonEmployeeAction::class);
    $group->delete('/{codigo}', DeletePersonEmployeeAction::class);
    $group->get('', ListPersonsEmployeeAction::class);
    $group->put('', UpdatePersonEmployeeAction::class);
    $group->get('/{codigo}', ViewPersonEmployeeAction::class);
  });

  $app->group('/people-customer', function (Group $group) use ($app) {
    $group->post('', CreatePersonCustomerAction::class);
    $group->delete('/{codigo}', DeletePersonCustomerAction::class);
    $group->get('', ListPersonsCustomerAction::class);
    $group->put('', UpdatePersonCustomerAction::class);
    $group->get('/{codigo}', ViewPersonCustomerAction::class);

    $group->get('/find-by-person/{codigo_pessoa}', FindPersonCustomerAction::class);
  });

  $app->group('/people-provider', function (Group $group) use ($app) {
    $group->post('', CreatePersonProviderAction::class);
    $group->delete('/{codigo}', DeletePersonProviderAction::class);
    $group->get('', ListPersonsProviderAction::class);
    $group->put('', UpdatePersonProviderAction::class);
    $group->get('/{codigo}', ViewPersonProviderAction::class);
  });

  $app->group('/os', function (Group $group) use ($app) {
    $group->post('', CreateServiceOrderAction::class);
    $group->delete('/{codigo}', DeleteServiceOrderAction::class);
    $group->get('', ListServiceOrdersAction::class);
    $group->put('', UpdateServiceOrderAction::class);
    $group->get('/{codigo}', ViewServiceOrderAction::class);
  });

  $app->group('/os-employee', function (Group $group) use ($app) {
    $group->post('', CreateServiceOrderEmployeeAction::class);
    $group->delete('/{codigo}', DeleteServiceOrderEmployeeAction::class);
    $group->get('', ListServiceOrderEmployeesAction::class);
    $group->put('', UpdateServiceOrderEmployeeAction::class);
    $group->get('/{codigo}', ViewServiceOrderEmployeeAction::class);
  });

  $app->group('/os-tools', function (Group $group) use ($app) {
    $group->post('', CreateServiceOrderToolsAction::class);
    $group->delete('/{codigo}', DeleteServiceOrderToolsAction::class);
    $group->get('', ListServiceOrderToolssAction::class);
    $group->put('', UpdateServiceOrderToolsAction::class);
    $group->get('/{codigo}', ViewServiceOrderToolsAction::class);
  });

  $app->group('/os-client', function (Group $group) use ($app) {
    $group->post('', CreateServiceOrderClientAction::class);
    $group->delete('/{codigo}', DeleteServiceOrderClientAction::class);
    $group->get('', ListServiceOrderClientsAction::class);
    $group->put('', UpdateServiceOrderClientAction::class);
    $group->get('/{codigo}', ViewServiceOrderClientAction::class);
  });

  $app->group('/launch', function (Group $group) use ($app) {
    $group->post('', CreateLaunchAction::class);
    $group->delete('/{codigo}', DeleteLaunchAction::class);
    $group->get('', ListLaunchsAction::class);
    $group->put('', UpdateLaunchAction::class);
    $group->get('/{codigo}', ViewLaunchAction::class);
  });

  $app->group('/launch-type', function (Group $group) use ($app) {
    $group->post('', CreateLaunchTypeAction::class);
    $group->delete('/{codigo}', DeleteLaunchTypeAction::class);
    $group->get('', ListLaunchTypesAction::class);
    $group->put('', UpdateLaunchTypeAction::class);
    $group->get('/{codigo}', ViewLaunchTypeAction::class);
  });

  $app->group('/launch-income', function (Group $group) use ($app) {
    $group->post('', CreateLaunchIncomeTypeAction::class);
    $group->delete('/{codigo}', DeleteLaunchIncomeTypeAction::class);
    $group->get('', ListLaunchIncomeTypesAction::class);
    $group->put('', UpdateLaunchIncomeTypeAction::class);
    $group->get('/{codigo}', ViewLaunchIncomeTypeAction::class);
  });  
};
