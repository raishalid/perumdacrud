<?php

namespace PHPMaker2023\crudperumdautama;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Exception\HttpNotFoundException;

// Handle Routes
return function (App $app) {
    // beritas
    $app->map(["GET","POST","OPTIONS"], '/BeritasList[/{id}]', BeritasController::class . ':list')->add(PermissionMiddleware::class)->setName('BeritasList-beritas-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/BeritasAdd[/{id}]', BeritasController::class . ':add')->add(PermissionMiddleware::class)->setName('BeritasAdd-beritas-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/BeritasView[/{id}]', BeritasController::class . ':view')->add(PermissionMiddleware::class)->setName('BeritasView-beritas-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/BeritasEdit[/{id}]', BeritasController::class . ':edit')->add(PermissionMiddleware::class)->setName('BeritasEdit-beritas-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/BeritasDelete[/{id}]', BeritasController::class . ':delete')->add(PermissionMiddleware::class)->setName('BeritasDelete-beritas-delete'); // delete
    $app->group(
        '/beritas',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', BeritasController::class . ':list')->add(PermissionMiddleware::class)->setName('beritas/list-beritas-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', BeritasController::class . ':add')->add(PermissionMiddleware::class)->setName('beritas/add-beritas-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', BeritasController::class . ':view')->add(PermissionMiddleware::class)->setName('beritas/view-beritas-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', BeritasController::class . ':edit')->add(PermissionMiddleware::class)->setName('beritas/edit-beritas-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', BeritasController::class . ':delete')->add(PermissionMiddleware::class)->setName('beritas/delete-beritas-delete-2'); // delete
        }
    );

    // chart_of_accounts
    $app->map(["GET","POST","OPTIONS"], '/ChartOfAccountsList[/{id}]', ChartOfAccountsController::class . ':list')->add(PermissionMiddleware::class)->setName('ChartOfAccountsList-chart_of_accounts-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ChartOfAccountsAdd[/{id}]', ChartOfAccountsController::class . ':add')->add(PermissionMiddleware::class)->setName('ChartOfAccountsAdd-chart_of_accounts-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ChartOfAccountsView[/{id}]', ChartOfAccountsController::class . ':view')->add(PermissionMiddleware::class)->setName('ChartOfAccountsView-chart_of_accounts-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ChartOfAccountsEdit[/{id}]', ChartOfAccountsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ChartOfAccountsEdit-chart_of_accounts-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ChartOfAccountsDelete[/{id}]', ChartOfAccountsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ChartOfAccountsDelete-chart_of_accounts-delete'); // delete
    $app->group(
        '/chart_of_accounts',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ChartOfAccountsController::class . ':list')->add(PermissionMiddleware::class)->setName('chart_of_accounts/list-chart_of_accounts-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ChartOfAccountsController::class . ':add')->add(PermissionMiddleware::class)->setName('chart_of_accounts/add-chart_of_accounts-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ChartOfAccountsController::class . ':view')->add(PermissionMiddleware::class)->setName('chart_of_accounts/view-chart_of_accounts-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ChartOfAccountsController::class . ':edit')->add(PermissionMiddleware::class)->setName('chart_of_accounts/edit-chart_of_accounts-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ChartOfAccountsController::class . ':delete')->add(PermissionMiddleware::class)->setName('chart_of_accounts/delete-chart_of_accounts-delete-2'); // delete
        }
    );

    // companies
    $app->map(["GET","POST","OPTIONS"], '/CompaniesList[/{id}]', CompaniesController::class . ':list')->add(PermissionMiddleware::class)->setName('CompaniesList-companies-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CompaniesAdd[/{id}]', CompaniesController::class . ':add')->add(PermissionMiddleware::class)->setName('CompaniesAdd-companies-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CompaniesView[/{id}]', CompaniesController::class . ':view')->add(PermissionMiddleware::class)->setName('CompaniesView-companies-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CompaniesEdit[/{id}]', CompaniesController::class . ':edit')->add(PermissionMiddleware::class)->setName('CompaniesEdit-companies-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CompaniesDelete[/{id}]', CompaniesController::class . ':delete')->add(PermissionMiddleware::class)->setName('CompaniesDelete-companies-delete'); // delete
    $app->group(
        '/companies',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', CompaniesController::class . ':list')->add(PermissionMiddleware::class)->setName('companies/list-companies-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', CompaniesController::class . ':add')->add(PermissionMiddleware::class)->setName('companies/add-companies-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', CompaniesController::class . ':view')->add(PermissionMiddleware::class)->setName('companies/view-companies-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', CompaniesController::class . ':edit')->add(PermissionMiddleware::class)->setName('companies/edit-companies-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', CompaniesController::class . ':delete')->add(PermissionMiddleware::class)->setName('companies/delete-companies-delete-2'); // delete
        }
    );

    // contacts
    $app->map(["GET","POST","OPTIONS"], '/ContactsList[/{id}]', ContactsController::class . ':list')->add(PermissionMiddleware::class)->setName('ContactsList-contacts-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ContactsAdd[/{id}]', ContactsController::class . ':add')->add(PermissionMiddleware::class)->setName('ContactsAdd-contacts-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ContactsView[/{id}]', ContactsController::class . ':view')->add(PermissionMiddleware::class)->setName('ContactsView-contacts-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ContactsEdit[/{id}]', ContactsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ContactsEdit-contacts-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ContactsDelete[/{id}]', ContactsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ContactsDelete-contacts-delete'); // delete
    $app->group(
        '/contacts',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ContactsController::class . ':list')->add(PermissionMiddleware::class)->setName('contacts/list-contacts-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ContactsController::class . ':add')->add(PermissionMiddleware::class)->setName('contacts/add-contacts-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ContactsController::class . ':view')->add(PermissionMiddleware::class)->setName('contacts/view-contacts-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ContactsController::class . ':edit')->add(PermissionMiddleware::class)->setName('contacts/edit-contacts-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ContactsController::class . ':delete')->add(PermissionMiddleware::class)->setName('contacts/delete-contacts-delete-2'); // delete
        }
    );

    // customers
    $app->map(["GET","POST","OPTIONS"], '/CustomersList[/{id}]', CustomersController::class . ':list')->add(PermissionMiddleware::class)->setName('CustomersList-customers-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/CustomersAdd[/{id}]', CustomersController::class . ':add')->add(PermissionMiddleware::class)->setName('CustomersAdd-customers-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/CustomersView[/{id}]', CustomersController::class . ':view')->add(PermissionMiddleware::class)->setName('CustomersView-customers-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/CustomersEdit[/{id}]', CustomersController::class . ':edit')->add(PermissionMiddleware::class)->setName('CustomersEdit-customers-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/CustomersDelete[/{id}]', CustomersController::class . ':delete')->add(PermissionMiddleware::class)->setName('CustomersDelete-customers-delete'); // delete
    $app->group(
        '/customers',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', CustomersController::class . ':list')->add(PermissionMiddleware::class)->setName('customers/list-customers-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', CustomersController::class . ':add')->add(PermissionMiddleware::class)->setName('customers/add-customers-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', CustomersController::class . ':view')->add(PermissionMiddleware::class)->setName('customers/view-customers-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', CustomersController::class . ':edit')->add(PermissionMiddleware::class)->setName('customers/edit-customers-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', CustomersController::class . ':delete')->add(PermissionMiddleware::class)->setName('customers/delete-customers-delete-2'); // delete
        }
    );

    // departements
    $app->map(["GET","POST","OPTIONS"], '/DepartementsList[/{id}]', DepartementsController::class . ':list')->add(PermissionMiddleware::class)->setName('DepartementsList-departements-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DepartementsAdd[/{id}]', DepartementsController::class . ':add')->add(PermissionMiddleware::class)->setName('DepartementsAdd-departements-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DepartementsView[/{id}]', DepartementsController::class . ':view')->add(PermissionMiddleware::class)->setName('DepartementsView-departements-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DepartementsEdit[/{id}]', DepartementsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DepartementsEdit-departements-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DepartementsDelete[/{id}]', DepartementsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DepartementsDelete-departements-delete'); // delete
    $app->group(
        '/departements',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', DepartementsController::class . ':list')->add(PermissionMiddleware::class)->setName('departements/list-departements-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', DepartementsController::class . ':add')->add(PermissionMiddleware::class)->setName('departements/add-departements-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', DepartementsController::class . ':view')->add(PermissionMiddleware::class)->setName('departements/view-departements-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', DepartementsController::class . ':edit')->add(PermissionMiddleware::class)->setName('departements/edit-departements-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', DepartementsController::class . ':delete')->add(PermissionMiddleware::class)->setName('departements/delete-departements-delete-2'); // delete
        }
    );

    // division
    $app->map(["GET","POST","OPTIONS"], '/DivisionList[/{id}]', DivisionController::class . ':list')->add(PermissionMiddleware::class)->setName('DivisionList-division-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DivisionAdd[/{id}]', DivisionController::class . ':add')->add(PermissionMiddleware::class)->setName('DivisionAdd-division-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DivisionView[/{id}]', DivisionController::class . ':view')->add(PermissionMiddleware::class)->setName('DivisionView-division-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DivisionEdit[/{id}]', DivisionController::class . ':edit')->add(PermissionMiddleware::class)->setName('DivisionEdit-division-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DivisionDelete[/{id}]', DivisionController::class . ':delete')->add(PermissionMiddleware::class)->setName('DivisionDelete-division-delete'); // delete
    $app->group(
        '/division',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', DivisionController::class . ':list')->add(PermissionMiddleware::class)->setName('division/list-division-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', DivisionController::class . ':add')->add(PermissionMiddleware::class)->setName('division/add-division-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', DivisionController::class . ':view')->add(PermissionMiddleware::class)->setName('division/view-division-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', DivisionController::class . ':edit')->add(PermissionMiddleware::class)->setName('division/edit-division-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', DivisionController::class . ':delete')->add(PermissionMiddleware::class)->setName('division/delete-division-delete-2'); // delete
        }
    );

    // document_histories
    $app->map(["GET","POST","OPTIONS"], '/DocumentHistoriesList[/{id}]', DocumentHistoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('DocumentHistoriesList-document_histories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DocumentHistoriesAdd[/{id}]', DocumentHistoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('DocumentHistoriesAdd-document_histories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DocumentHistoriesView[/{id}]', DocumentHistoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('DocumentHistoriesView-document_histories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DocumentHistoriesEdit[/{id}]', DocumentHistoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('DocumentHistoriesEdit-document_histories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DocumentHistoriesDelete[/{id}]', DocumentHistoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('DocumentHistoriesDelete-document_histories-delete'); // delete
    $app->group(
        '/document_histories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', DocumentHistoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('document_histories/list-document_histories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', DocumentHistoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('document_histories/add-document_histories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', DocumentHistoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('document_histories/view-document_histories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', DocumentHistoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('document_histories/edit-document_histories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', DocumentHistoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('document_histories/delete-document_histories-delete-2'); // delete
        }
    );

    // document_item_taxes
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemTaxesList[/{id}]', DocumentItemTaxesController::class . ':list')->add(PermissionMiddleware::class)->setName('DocumentItemTaxesList-document_item_taxes-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemTaxesAdd[/{id}]', DocumentItemTaxesController::class . ':add')->add(PermissionMiddleware::class)->setName('DocumentItemTaxesAdd-document_item_taxes-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemTaxesView[/{id}]', DocumentItemTaxesController::class . ':view')->add(PermissionMiddleware::class)->setName('DocumentItemTaxesView-document_item_taxes-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemTaxesEdit[/{id}]', DocumentItemTaxesController::class . ':edit')->add(PermissionMiddleware::class)->setName('DocumentItemTaxesEdit-document_item_taxes-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemTaxesDelete[/{id}]', DocumentItemTaxesController::class . ':delete')->add(PermissionMiddleware::class)->setName('DocumentItemTaxesDelete-document_item_taxes-delete'); // delete
    $app->group(
        '/document_item_taxes',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', DocumentItemTaxesController::class . ':list')->add(PermissionMiddleware::class)->setName('document_item_taxes/list-document_item_taxes-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', DocumentItemTaxesController::class . ':add')->add(PermissionMiddleware::class)->setName('document_item_taxes/add-document_item_taxes-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', DocumentItemTaxesController::class . ':view')->add(PermissionMiddleware::class)->setName('document_item_taxes/view-document_item_taxes-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', DocumentItemTaxesController::class . ':edit')->add(PermissionMiddleware::class)->setName('document_item_taxes/edit-document_item_taxes-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', DocumentItemTaxesController::class . ':delete')->add(PermissionMiddleware::class)->setName('document_item_taxes/delete-document_item_taxes-delete-2'); // delete
        }
    );

    // document_items
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemsList[/{id}]', DocumentItemsController::class . ':list')->add(PermissionMiddleware::class)->setName('DocumentItemsList-document_items-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemsAdd[/{id}]', DocumentItemsController::class . ':add')->add(PermissionMiddleware::class)->setName('DocumentItemsAdd-document_items-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemsView[/{id}]', DocumentItemsController::class . ':view')->add(PermissionMiddleware::class)->setName('DocumentItemsView-document_items-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemsEdit[/{id}]', DocumentItemsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DocumentItemsEdit-document_items-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DocumentItemsDelete[/{id}]', DocumentItemsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DocumentItemsDelete-document_items-delete'); // delete
    $app->group(
        '/document_items',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', DocumentItemsController::class . ':list')->add(PermissionMiddleware::class)->setName('document_items/list-document_items-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', DocumentItemsController::class . ':add')->add(PermissionMiddleware::class)->setName('document_items/add-document_items-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', DocumentItemsController::class . ':view')->add(PermissionMiddleware::class)->setName('document_items/view-document_items-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', DocumentItemsController::class . ':edit')->add(PermissionMiddleware::class)->setName('document_items/edit-document_items-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', DocumentItemsController::class . ':delete')->add(PermissionMiddleware::class)->setName('document_items/delete-document_items-delete-2'); // delete
        }
    );

    // document_totals
    $app->map(["GET","POST","OPTIONS"], '/DocumentTotalsList[/{id}]', DocumentTotalsController::class . ':list')->add(PermissionMiddleware::class)->setName('DocumentTotalsList-document_totals-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DocumentTotalsAdd[/{id}]', DocumentTotalsController::class . ':add')->add(PermissionMiddleware::class)->setName('DocumentTotalsAdd-document_totals-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DocumentTotalsView[/{id}]', DocumentTotalsController::class . ':view')->add(PermissionMiddleware::class)->setName('DocumentTotalsView-document_totals-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DocumentTotalsEdit[/{id}]', DocumentTotalsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DocumentTotalsEdit-document_totals-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DocumentTotalsDelete[/{id}]', DocumentTotalsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DocumentTotalsDelete-document_totals-delete'); // delete
    $app->group(
        '/document_totals',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', DocumentTotalsController::class . ':list')->add(PermissionMiddleware::class)->setName('document_totals/list-document_totals-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', DocumentTotalsController::class . ':add')->add(PermissionMiddleware::class)->setName('document_totals/add-document_totals-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', DocumentTotalsController::class . ':view')->add(PermissionMiddleware::class)->setName('document_totals/view-document_totals-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', DocumentTotalsController::class . ':edit')->add(PermissionMiddleware::class)->setName('document_totals/edit-document_totals-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', DocumentTotalsController::class . ':delete')->add(PermissionMiddleware::class)->setName('document_totals/delete-document_totals-delete-2'); // delete
        }
    );

    // documents
    $app->map(["GET","POST","OPTIONS"], '/DocumentsList[/{id}]', DocumentsController::class . ':list')->add(PermissionMiddleware::class)->setName('DocumentsList-documents-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DocumentsAdd[/{id}]', DocumentsController::class . ':add')->add(PermissionMiddleware::class)->setName('DocumentsAdd-documents-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DocumentsView[/{id}]', DocumentsController::class . ':view')->add(PermissionMiddleware::class)->setName('DocumentsView-documents-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DocumentsEdit[/{id}]', DocumentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('DocumentsEdit-documents-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DocumentsDelete[/{id}]', DocumentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('DocumentsDelete-documents-delete'); // delete
    $app->group(
        '/documents',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', DocumentsController::class . ':list')->add(PermissionMiddleware::class)->setName('documents/list-documents-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', DocumentsController::class . ':add')->add(PermissionMiddleware::class)->setName('documents/add-documents-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', DocumentsController::class . ':view')->add(PermissionMiddleware::class)->setName('documents/view-documents-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', DocumentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('documents/edit-documents-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', DocumentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('documents/delete-documents-delete-2'); // delete
        }
    );

    // failed_jobs
    $app->map(["GET","POST","OPTIONS"], '/FailedJobsList[/{id}]', FailedJobsController::class . ':list')->add(PermissionMiddleware::class)->setName('FailedJobsList-failed_jobs-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/FailedJobsAdd[/{id}]', FailedJobsController::class . ':add')->add(PermissionMiddleware::class)->setName('FailedJobsAdd-failed_jobs-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/FailedJobsView[/{id}]', FailedJobsController::class . ':view')->add(PermissionMiddleware::class)->setName('FailedJobsView-failed_jobs-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/FailedJobsEdit[/{id}]', FailedJobsController::class . ':edit')->add(PermissionMiddleware::class)->setName('FailedJobsEdit-failed_jobs-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/FailedJobsDelete[/{id}]', FailedJobsController::class . ':delete')->add(PermissionMiddleware::class)->setName('FailedJobsDelete-failed_jobs-delete'); // delete
    $app->group(
        '/failed_jobs',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', FailedJobsController::class . ':list')->add(PermissionMiddleware::class)->setName('failed_jobs/list-failed_jobs-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', FailedJobsController::class . ':add')->add(PermissionMiddleware::class)->setName('failed_jobs/add-failed_jobs-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', FailedJobsController::class . ':view')->add(PermissionMiddleware::class)->setName('failed_jobs/view-failed_jobs-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', FailedJobsController::class . ':edit')->add(PermissionMiddleware::class)->setName('failed_jobs/edit-failed_jobs-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', FailedJobsController::class . ':delete')->add(PermissionMiddleware::class)->setName('failed_jobs/delete-failed_jobs-delete-2'); // delete
        }
    );

    // funding_sources
    $app->map(["GET","POST","OPTIONS"], '/FundingSourcesList[/{id}]', FundingSourcesController::class . ':list')->add(PermissionMiddleware::class)->setName('FundingSourcesList-funding_sources-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/FundingSourcesAdd[/{id}]', FundingSourcesController::class . ':add')->add(PermissionMiddleware::class)->setName('FundingSourcesAdd-funding_sources-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/FundingSourcesView[/{id}]', FundingSourcesController::class . ':view')->add(PermissionMiddleware::class)->setName('FundingSourcesView-funding_sources-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/FundingSourcesEdit[/{id}]', FundingSourcesController::class . ':edit')->add(PermissionMiddleware::class)->setName('FundingSourcesEdit-funding_sources-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/FundingSourcesDelete[/{id}]', FundingSourcesController::class . ':delete')->add(PermissionMiddleware::class)->setName('FundingSourcesDelete-funding_sources-delete'); // delete
    $app->group(
        '/funding_sources',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', FundingSourcesController::class . ':list')->add(PermissionMiddleware::class)->setName('funding_sources/list-funding_sources-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', FundingSourcesController::class . ':add')->add(PermissionMiddleware::class)->setName('funding_sources/add-funding_sources-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', FundingSourcesController::class . ':view')->add(PermissionMiddleware::class)->setName('funding_sources/view-funding_sources-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', FundingSourcesController::class . ':edit')->add(PermissionMiddleware::class)->setName('funding_sources/edit-funding_sources-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', FundingSourcesController::class . ':delete')->add(PermissionMiddleware::class)->setName('funding_sources/delete-funding_sources-delete-2'); // delete
        }
    );

    // investors
    $app->map(["GET","POST","OPTIONS"], '/InvestorsList[/{id}]', InvestorsController::class . ':list')->add(PermissionMiddleware::class)->setName('InvestorsList-investors-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/InvestorsAdd[/{id}]', InvestorsController::class . ':add')->add(PermissionMiddleware::class)->setName('InvestorsAdd-investors-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/InvestorsView[/{id}]', InvestorsController::class . ':view')->add(PermissionMiddleware::class)->setName('InvestorsView-investors-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/InvestorsEdit[/{id}]', InvestorsController::class . ':edit')->add(PermissionMiddleware::class)->setName('InvestorsEdit-investors-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/InvestorsDelete[/{id}]', InvestorsController::class . ':delete')->add(PermissionMiddleware::class)->setName('InvestorsDelete-investors-delete'); // delete
    $app->group(
        '/investors',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', InvestorsController::class . ':list')->add(PermissionMiddleware::class)->setName('investors/list-investors-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', InvestorsController::class . ':add')->add(PermissionMiddleware::class)->setName('investors/add-investors-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', InvestorsController::class . ':view')->add(PermissionMiddleware::class)->setName('investors/view-investors-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', InvestorsController::class . ':edit')->add(PermissionMiddleware::class)->setName('investors/edit-investors-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', InvestorsController::class . ':delete')->add(PermissionMiddleware::class)->setName('investors/delete-investors-delete-2'); // delete
        }
    );

    // items
    $app->map(["GET","POST","OPTIONS"], '/ItemsList[/{id}]', ItemsController::class . ':list')->add(PermissionMiddleware::class)->setName('ItemsList-items-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ItemsAdd[/{id}]', ItemsController::class . ':add')->add(PermissionMiddleware::class)->setName('ItemsAdd-items-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ItemsView[/{id}]', ItemsController::class . ':view')->add(PermissionMiddleware::class)->setName('ItemsView-items-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ItemsEdit[/{id}]', ItemsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ItemsEdit-items-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ItemsDelete[/{id}]', ItemsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ItemsDelete-items-delete'); // delete
    $app->group(
        '/items',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ItemsController::class . ':list')->add(PermissionMiddleware::class)->setName('items/list-items-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ItemsController::class . ':add')->add(PermissionMiddleware::class)->setName('items/add-items-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ItemsController::class . ':view')->add(PermissionMiddleware::class)->setName('items/view-items-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ItemsController::class . ':edit')->add(PermissionMiddleware::class)->setName('items/edit-items-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ItemsController::class . ':delete')->add(PermissionMiddleware::class)->setName('items/delete-items-delete-2'); // delete
        }
    );

    // items_categories
    $app->map(["GET","POST","OPTIONS"], '/ItemsCategoriesList[/{id}]', ItemsCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('ItemsCategoriesList-items_categories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ItemsCategoriesAdd[/{id}]', ItemsCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('ItemsCategoriesAdd-items_categories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ItemsCategoriesView[/{id}]', ItemsCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('ItemsCategoriesView-items_categories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ItemsCategoriesEdit[/{id}]', ItemsCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('ItemsCategoriesEdit-items_categories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ItemsCategoriesDelete[/{id}]', ItemsCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('ItemsCategoriesDelete-items_categories-delete'); // delete
    $app->group(
        '/items_categories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ItemsCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('items_categories/list-items_categories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ItemsCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('items_categories/add-items_categories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ItemsCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('items_categories/view-items_categories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ItemsCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('items_categories/edit-items_categories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ItemsCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('items_categories/delete-items_categories-delete-2'); // delete
        }
    );

    // kategori_beritas
    $app->map(["GET","POST","OPTIONS"], '/KategoriBeritasList[/{id}]', KategoriBeritasController::class . ':list')->add(PermissionMiddleware::class)->setName('KategoriBeritasList-kategori_beritas-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/KategoriBeritasAdd[/{id}]', KategoriBeritasController::class . ':add')->add(PermissionMiddleware::class)->setName('KategoriBeritasAdd-kategori_beritas-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/KategoriBeritasView[/{id}]', KategoriBeritasController::class . ':view')->add(PermissionMiddleware::class)->setName('KategoriBeritasView-kategori_beritas-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/KategoriBeritasEdit[/{id}]', KategoriBeritasController::class . ':edit')->add(PermissionMiddleware::class)->setName('KategoriBeritasEdit-kategori_beritas-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/KategoriBeritasDelete[/{id}]', KategoriBeritasController::class . ':delete')->add(PermissionMiddleware::class)->setName('KategoriBeritasDelete-kategori_beritas-delete'); // delete
    $app->group(
        '/kategori_beritas',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', KategoriBeritasController::class . ':list')->add(PermissionMiddleware::class)->setName('kategori_beritas/list-kategori_beritas-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', KategoriBeritasController::class . ':add')->add(PermissionMiddleware::class)->setName('kategori_beritas/add-kategori_beritas-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', KategoriBeritasController::class . ':view')->add(PermissionMiddleware::class)->setName('kategori_beritas/view-kategori_beritas-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', KategoriBeritasController::class . ':edit')->add(PermissionMiddleware::class)->setName('kategori_beritas/edit-kategori_beritas-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', KategoriBeritasController::class . ':delete')->add(PermissionMiddleware::class)->setName('kategori_beritas/delete-kategori_beritas-delete-2'); // delete
        }
    );

    // migrations
    $app->map(["GET","POST","OPTIONS"], '/MigrationsList[/{id}]', MigrationsController::class . ':list')->add(PermissionMiddleware::class)->setName('MigrationsList-migrations-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/MigrationsAdd[/{id}]', MigrationsController::class . ':add')->add(PermissionMiddleware::class)->setName('MigrationsAdd-migrations-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/MigrationsView[/{id}]', MigrationsController::class . ':view')->add(PermissionMiddleware::class)->setName('MigrationsView-migrations-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/MigrationsEdit[/{id}]', MigrationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('MigrationsEdit-migrations-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/MigrationsDelete[/{id}]', MigrationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('MigrationsDelete-migrations-delete'); // delete
    $app->group(
        '/migrations',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', MigrationsController::class . ':list')->add(PermissionMiddleware::class)->setName('migrations/list-migrations-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', MigrationsController::class . ':add')->add(PermissionMiddleware::class)->setName('migrations/add-migrations-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', MigrationsController::class . ':view')->add(PermissionMiddleware::class)->setName('migrations/view-migrations-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', MigrationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('migrations/edit-migrations-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', MigrationsController::class . ':delete')->add(PermissionMiddleware::class)->setName('migrations/delete-migrations-delete-2'); // delete
        }
    );

    // model_has_permissions
    $app->map(["GET","POST","OPTIONS"], '/ModelHasPermissionsList[/{keys:.*}]', ModelHasPermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('ModelHasPermissionsList-model_has_permissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ModelHasPermissionsAdd[/{keys:.*}]', ModelHasPermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('ModelHasPermissionsAdd-model_has_permissions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ModelHasPermissionsView[/{keys:.*}]', ModelHasPermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('ModelHasPermissionsView-model_has_permissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ModelHasPermissionsEdit[/{keys:.*}]', ModelHasPermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ModelHasPermissionsEdit-model_has_permissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ModelHasPermissionsDelete[/{keys:.*}]', ModelHasPermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ModelHasPermissionsDelete-model_has_permissions-delete'); // delete
    $app->group(
        '/model_has_permissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{keys:.*}]', ModelHasPermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('model_has_permissions/list-model_has_permissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{keys:.*}]', ModelHasPermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('model_has_permissions/add-model_has_permissions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{keys:.*}]', ModelHasPermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('model_has_permissions/view-model_has_permissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{keys:.*}]', ModelHasPermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('model_has_permissions/edit-model_has_permissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{keys:.*}]', ModelHasPermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('model_has_permissions/delete-model_has_permissions-delete-2'); // delete
        }
    );

    // model_has_roles
    $app->map(["GET","POST","OPTIONS"], '/ModelHasRolesList[/{keys:.*}]', ModelHasRolesController::class . ':list')->add(PermissionMiddleware::class)->setName('ModelHasRolesList-model_has_roles-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ModelHasRolesAdd[/{keys:.*}]', ModelHasRolesController::class . ':add')->add(PermissionMiddleware::class)->setName('ModelHasRolesAdd-model_has_roles-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ModelHasRolesView[/{keys:.*}]', ModelHasRolesController::class . ':view')->add(PermissionMiddleware::class)->setName('ModelHasRolesView-model_has_roles-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ModelHasRolesEdit[/{keys:.*}]', ModelHasRolesController::class . ':edit')->add(PermissionMiddleware::class)->setName('ModelHasRolesEdit-model_has_roles-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ModelHasRolesDelete[/{keys:.*}]', ModelHasRolesController::class . ':delete')->add(PermissionMiddleware::class)->setName('ModelHasRolesDelete-model_has_roles-delete'); // delete
    $app->group(
        '/model_has_roles',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{keys:.*}]', ModelHasRolesController::class . ':list')->add(PermissionMiddleware::class)->setName('model_has_roles/list-model_has_roles-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{keys:.*}]', ModelHasRolesController::class . ':add')->add(PermissionMiddleware::class)->setName('model_has_roles/add-model_has_roles-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{keys:.*}]', ModelHasRolesController::class . ':view')->add(PermissionMiddleware::class)->setName('model_has_roles/view-model_has_roles-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{keys:.*}]', ModelHasRolesController::class . ':edit')->add(PermissionMiddleware::class)->setName('model_has_roles/edit-model_has_roles-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{keys:.*}]', ModelHasRolesController::class . ':delete')->add(PermissionMiddleware::class)->setName('model_has_roles/delete-model_has_roles-delete-2'); // delete
        }
    );

    // organization
    $app->map(["GET","POST","OPTIONS"], '/OrganizationList[/{id}]', OrganizationController::class . ':list')->add(PermissionMiddleware::class)->setName('OrganizationList-organization-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/OrganizationAdd[/{id}]', OrganizationController::class . ':add')->add(PermissionMiddleware::class)->setName('OrganizationAdd-organization-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/OrganizationView[/{id}]', OrganizationController::class . ':view')->add(PermissionMiddleware::class)->setName('OrganizationView-organization-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/OrganizationEdit[/{id}]', OrganizationController::class . ':edit')->add(PermissionMiddleware::class)->setName('OrganizationEdit-organization-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/OrganizationDelete[/{id}]', OrganizationController::class . ':delete')->add(PermissionMiddleware::class)->setName('OrganizationDelete-organization-delete'); // delete
    $app->group(
        '/organization',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', OrganizationController::class . ':list')->add(PermissionMiddleware::class)->setName('organization/list-organization-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', OrganizationController::class . ':add')->add(PermissionMiddleware::class)->setName('organization/add-organization-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', OrganizationController::class . ':view')->add(PermissionMiddleware::class)->setName('organization/view-organization-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', OrganizationController::class . ':edit')->add(PermissionMiddleware::class)->setName('organization/edit-organization-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', OrganizationController::class . ':delete')->add(PermissionMiddleware::class)->setName('organization/delete-organization-delete-2'); // delete
        }
    );

    // password_reset_tokens
    $app->map(["GET","POST","OPTIONS"], '/PasswordResetTokensList[/{_email:.*}]', PasswordResetTokensController::class . ':list')->add(PermissionMiddleware::class)->setName('PasswordResetTokensList-password_reset_tokens-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PasswordResetTokensAdd[/{_email:.*}]', PasswordResetTokensController::class . ':add')->add(PermissionMiddleware::class)->setName('PasswordResetTokensAdd-password_reset_tokens-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PasswordResetTokensView[/{_email:.*}]', PasswordResetTokensController::class . ':view')->add(PermissionMiddleware::class)->setName('PasswordResetTokensView-password_reset_tokens-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PasswordResetTokensEdit[/{_email:.*}]', PasswordResetTokensController::class . ':edit')->add(PermissionMiddleware::class)->setName('PasswordResetTokensEdit-password_reset_tokens-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PasswordResetTokensDelete[/{_email:.*}]', PasswordResetTokensController::class . ':delete')->add(PermissionMiddleware::class)->setName('PasswordResetTokensDelete-password_reset_tokens-delete'); // delete
    $app->group(
        '/password_reset_tokens',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{_email:.*}]', PasswordResetTokensController::class . ':list')->add(PermissionMiddleware::class)->setName('password_reset_tokens/list-password_reset_tokens-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{_email:.*}]', PasswordResetTokensController::class . ':add')->add(PermissionMiddleware::class)->setName('password_reset_tokens/add-password_reset_tokens-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{_email:.*}]', PasswordResetTokensController::class . ':view')->add(PermissionMiddleware::class)->setName('password_reset_tokens/view-password_reset_tokens-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{_email:.*}]', PasswordResetTokensController::class . ':edit')->add(PermissionMiddleware::class)->setName('password_reset_tokens/edit-password_reset_tokens-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{_email:.*}]', PasswordResetTokensController::class . ':delete')->add(PermissionMiddleware::class)->setName('password_reset_tokens/delete-password_reset_tokens-delete-2'); // delete
        }
    );

    // permissions2
    $app->map(["GET","POST","OPTIONS"], '/Permissions2List[/{id}]', Permissions2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Permissions2List-permissions2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/Permissions2Add[/{id}]', Permissions2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('Permissions2Add-permissions2-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/Permissions2View[/{id}]', Permissions2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('Permissions2View-permissions2-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/Permissions2Edit[/{id}]', Permissions2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('Permissions2Edit-permissions2-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/Permissions2Delete[/{id}]', Permissions2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Permissions2Delete-permissions2-delete'); // delete
    $app->group(
        '/permissions2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', Permissions2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('permissions2/list-permissions2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', Permissions2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('permissions2/add-permissions2-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', Permissions2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('permissions2/view-permissions2-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', Permissions2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('permissions2/edit-permissions2-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', Permissions2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('permissions2/delete-permissions2-delete-2'); // delete
        }
    );

    // personal_access_tokens
    $app->map(["GET","POST","OPTIONS"], '/PersonalAccessTokensList[/{id}]', PersonalAccessTokensController::class . ':list')->add(PermissionMiddleware::class)->setName('PersonalAccessTokensList-personal_access_tokens-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PersonalAccessTokensAdd[/{id}]', PersonalAccessTokensController::class . ':add')->add(PermissionMiddleware::class)->setName('PersonalAccessTokensAdd-personal_access_tokens-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PersonalAccessTokensView[/{id}]', PersonalAccessTokensController::class . ':view')->add(PermissionMiddleware::class)->setName('PersonalAccessTokensView-personal_access_tokens-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PersonalAccessTokensEdit[/{id}]', PersonalAccessTokensController::class . ':edit')->add(PermissionMiddleware::class)->setName('PersonalAccessTokensEdit-personal_access_tokens-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PersonalAccessTokensDelete[/{id}]', PersonalAccessTokensController::class . ':delete')->add(PermissionMiddleware::class)->setName('PersonalAccessTokensDelete-personal_access_tokens-delete'); // delete
    $app->group(
        '/personal_access_tokens',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', PersonalAccessTokensController::class . ':list')->add(PermissionMiddleware::class)->setName('personal_access_tokens/list-personal_access_tokens-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', PersonalAccessTokensController::class . ':add')->add(PermissionMiddleware::class)->setName('personal_access_tokens/add-personal_access_tokens-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', PersonalAccessTokensController::class . ':view')->add(PermissionMiddleware::class)->setName('personal_access_tokens/view-personal_access_tokens-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', PersonalAccessTokensController::class . ':edit')->add(PermissionMiddleware::class)->setName('personal_access_tokens/edit-personal_access_tokens-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', PersonalAccessTokensController::class . ':delete')->add(PermissionMiddleware::class)->setName('personal_access_tokens/delete-personal_access_tokens-delete-2'); // delete
        }
    );

    // project_categories
    $app->map(["GET","POST","OPTIONS"], '/ProjectCategoriesList[/{id}]', ProjectCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('ProjectCategoriesList-project_categories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProjectCategoriesAdd[/{id}]', ProjectCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('ProjectCategoriesAdd-project_categories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProjectCategoriesView[/{id}]', ProjectCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('ProjectCategoriesView-project_categories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProjectCategoriesEdit[/{id}]', ProjectCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProjectCategoriesEdit-project_categories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProjectCategoriesDelete[/{id}]', ProjectCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProjectCategoriesDelete-project_categories-delete'); // delete
    $app->group(
        '/project_categories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ProjectCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('project_categories/list-project_categories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ProjectCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('project_categories/add-project_categories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ProjectCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('project_categories/view-project_categories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ProjectCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('project_categories/edit-project_categories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ProjectCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('project_categories/delete-project_categories-delete-2'); // delete
        }
    );

    // project_files
    $app->map(["GET","POST","OPTIONS"], '/ProjectFilesList[/{id}]', ProjectFilesController::class . ':list')->add(PermissionMiddleware::class)->setName('ProjectFilesList-project_files-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProjectFilesAdd[/{id}]', ProjectFilesController::class . ':add')->add(PermissionMiddleware::class)->setName('ProjectFilesAdd-project_files-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProjectFilesView[/{id}]', ProjectFilesController::class . ':view')->add(PermissionMiddleware::class)->setName('ProjectFilesView-project_files-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProjectFilesEdit[/{id}]', ProjectFilesController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProjectFilesEdit-project_files-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProjectFilesDelete[/{id}]', ProjectFilesController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProjectFilesDelete-project_files-delete'); // delete
    $app->group(
        '/project_files',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ProjectFilesController::class . ':list')->add(PermissionMiddleware::class)->setName('project_files/list-project_files-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ProjectFilesController::class . ':add')->add(PermissionMiddleware::class)->setName('project_files/add-project_files-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ProjectFilesController::class . ':view')->add(PermissionMiddleware::class)->setName('project_files/view-project_files-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ProjectFilesController::class . ':edit')->add(PermissionMiddleware::class)->setName('project_files/edit-project_files-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ProjectFilesController::class . ':delete')->add(PermissionMiddleware::class)->setName('project_files/delete-project_files-delete-2'); // delete
        }
    );

    // project_investors
    $app->map(["GET","POST","OPTIONS"], '/ProjectInvestorsList[/{id}]', ProjectInvestorsController::class . ':list')->add(PermissionMiddleware::class)->setName('ProjectInvestorsList-project_investors-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProjectInvestorsAdd[/{id}]', ProjectInvestorsController::class . ':add')->add(PermissionMiddleware::class)->setName('ProjectInvestorsAdd-project_investors-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProjectInvestorsView[/{id}]', ProjectInvestorsController::class . ':view')->add(PermissionMiddleware::class)->setName('ProjectInvestorsView-project_investors-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProjectInvestorsEdit[/{id}]', ProjectInvestorsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProjectInvestorsEdit-project_investors-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProjectInvestorsDelete[/{id}]', ProjectInvestorsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProjectInvestorsDelete-project_investors-delete'); // delete
    $app->group(
        '/project_investors',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ProjectInvestorsController::class . ':list')->add(PermissionMiddleware::class)->setName('project_investors/list-project_investors-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ProjectInvestorsController::class . ':add')->add(PermissionMiddleware::class)->setName('project_investors/add-project_investors-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ProjectInvestorsController::class . ':view')->add(PermissionMiddleware::class)->setName('project_investors/view-project_investors-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ProjectInvestorsController::class . ':edit')->add(PermissionMiddleware::class)->setName('project_investors/edit-project_investors-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ProjectInvestorsController::class . ':delete')->add(PermissionMiddleware::class)->setName('project_investors/delete-project_investors-delete-2'); // delete
        }
    );

    // project_providers
    $app->map(["GET","POST","OPTIONS"], '/ProjectProvidersList[/{id}]', ProjectProvidersController::class . ':list')->add(PermissionMiddleware::class)->setName('ProjectProvidersList-project_providers-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProjectProvidersAdd[/{id}]', ProjectProvidersController::class . ':add')->add(PermissionMiddleware::class)->setName('ProjectProvidersAdd-project_providers-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProjectProvidersView[/{id}]', ProjectProvidersController::class . ':view')->add(PermissionMiddleware::class)->setName('ProjectProvidersView-project_providers-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProjectProvidersEdit[/{id}]', ProjectProvidersController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProjectProvidersEdit-project_providers-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProjectProvidersDelete[/{id}]', ProjectProvidersController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProjectProvidersDelete-project_providers-delete'); // delete
    $app->group(
        '/project_providers',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ProjectProvidersController::class . ':list')->add(PermissionMiddleware::class)->setName('project_providers/list-project_providers-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ProjectProvidersController::class . ':add')->add(PermissionMiddleware::class)->setName('project_providers/add-project_providers-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ProjectProvidersController::class . ':view')->add(PermissionMiddleware::class)->setName('project_providers/view-project_providers-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ProjectProvidersController::class . ':edit')->add(PermissionMiddleware::class)->setName('project_providers/edit-project_providers-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ProjectProvidersController::class . ':delete')->add(PermissionMiddleware::class)->setName('project_providers/delete-project_providers-delete-2'); // delete
        }
    );

    // project_statuses
    $app->map(["GET","POST","OPTIONS"], '/ProjectStatusesList[/{id}]', ProjectStatusesController::class . ':list')->add(PermissionMiddleware::class)->setName('ProjectStatusesList-project_statuses-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProjectStatusesAdd[/{id}]', ProjectStatusesController::class . ':add')->add(PermissionMiddleware::class)->setName('ProjectStatusesAdd-project_statuses-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProjectStatusesView[/{id}]', ProjectStatusesController::class . ':view')->add(PermissionMiddleware::class)->setName('ProjectStatusesView-project_statuses-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProjectStatusesEdit[/{id}]', ProjectStatusesController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProjectStatusesEdit-project_statuses-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProjectStatusesDelete[/{id}]', ProjectStatusesController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProjectStatusesDelete-project_statuses-delete'); // delete
    $app->group(
        '/project_statuses',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ProjectStatusesController::class . ':list')->add(PermissionMiddleware::class)->setName('project_statuses/list-project_statuses-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ProjectStatusesController::class . ':add')->add(PermissionMiddleware::class)->setName('project_statuses/add-project_statuses-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ProjectStatusesController::class . ':view')->add(PermissionMiddleware::class)->setName('project_statuses/view-project_statuses-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ProjectStatusesController::class . ':edit')->add(PermissionMiddleware::class)->setName('project_statuses/edit-project_statuses-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ProjectStatusesController::class . ':delete')->add(PermissionMiddleware::class)->setName('project_statuses/delete-project_statuses-delete-2'); // delete
        }
    );

    // projects
    $app->map(["GET","POST","OPTIONS"], '/ProjectsList[/{id}]', ProjectsController::class . ':list')->add(PermissionMiddleware::class)->setName('ProjectsList-projects-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProjectsAdd[/{id}]', ProjectsController::class . ':add')->add(PermissionMiddleware::class)->setName('ProjectsAdd-projects-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProjectsView[/{id}]', ProjectsController::class . ':view')->add(PermissionMiddleware::class)->setName('ProjectsView-projects-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProjectsEdit[/{id}]', ProjectsController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProjectsEdit-projects-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProjectsUpdate', ProjectsController::class . ':update')->add(PermissionMiddleware::class)->setName('ProjectsUpdate-projects-update'); // update
    $app->map(["GET","POST","OPTIONS"], '/ProjectsDelete[/{id}]', ProjectsController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProjectsDelete-projects-delete'); // delete
    $app->group(
        '/projects',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ProjectsController::class . ':list')->add(PermissionMiddleware::class)->setName('projects/list-projects-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ProjectsController::class . ':add')->add(PermissionMiddleware::class)->setName('projects/add-projects-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ProjectsController::class . ':view')->add(PermissionMiddleware::class)->setName('projects/view-projects-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ProjectsController::class . ':edit')->add(PermissionMiddleware::class)->setName('projects/edit-projects-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('UPDATE_ACTION') . '', ProjectsController::class . ':update')->add(PermissionMiddleware::class)->setName('projects/update-projects-update-2'); // update
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ProjectsController::class . ':delete')->add(PermissionMiddleware::class)->setName('projects/delete-projects-delete-2'); // delete
        }
    );

    // role_has_permissions
    $app->map(["GET","POST","OPTIONS"], '/RoleHasPermissionsList[/{keys:.*}]', RoleHasPermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('RoleHasPermissionsList-role_has_permissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/RoleHasPermissionsAdd[/{keys:.*}]', RoleHasPermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('RoleHasPermissionsAdd-role_has_permissions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/RoleHasPermissionsView[/{keys:.*}]', RoleHasPermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('RoleHasPermissionsView-role_has_permissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/RoleHasPermissionsEdit[/{keys:.*}]', RoleHasPermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('RoleHasPermissionsEdit-role_has_permissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/RoleHasPermissionsDelete[/{keys:.*}]', RoleHasPermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('RoleHasPermissionsDelete-role_has_permissions-delete'); // delete
    $app->group(
        '/role_has_permissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{keys:.*}]', RoleHasPermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('role_has_permissions/list-role_has_permissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{keys:.*}]', RoleHasPermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('role_has_permissions/add-role_has_permissions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{keys:.*}]', RoleHasPermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('role_has_permissions/view-role_has_permissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{keys:.*}]', RoleHasPermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('role_has_permissions/edit-role_has_permissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{keys:.*}]', RoleHasPermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('role_has_permissions/delete-role_has_permissions-delete-2'); // delete
        }
    );

    // roles
    $app->map(["GET","POST","OPTIONS"], '/RolesList[/{id}]', RolesController::class . ':list')->add(PermissionMiddleware::class)->setName('RolesList-roles-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/RolesAdd[/{id}]', RolesController::class . ':add')->add(PermissionMiddleware::class)->setName('RolesAdd-roles-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/RolesView[/{id}]', RolesController::class . ':view')->add(PermissionMiddleware::class)->setName('RolesView-roles-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/RolesEdit[/{id}]', RolesController::class . ':edit')->add(PermissionMiddleware::class)->setName('RolesEdit-roles-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/RolesDelete[/{id}]', RolesController::class . ':delete')->add(PermissionMiddleware::class)->setName('RolesDelete-roles-delete'); // delete
    $app->group(
        '/roles',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', RolesController::class . ':list')->add(PermissionMiddleware::class)->setName('roles/list-roles-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', RolesController::class . ':add')->add(PermissionMiddleware::class)->setName('roles/add-roles-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', RolesController::class . ':view')->add(PermissionMiddleware::class)->setName('roles/view-roles-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', RolesController::class . ':edit')->add(PermissionMiddleware::class)->setName('roles/edit-roles-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', RolesController::class . ':delete')->add(PermissionMiddleware::class)->setName('roles/delete-roles-delete-2'); // delete
        }
    );

    // sector_categories
    $app->map(["GET","POST","OPTIONS"], '/SectorCategoriesList[/{id}]', SectorCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('SectorCategoriesList-sector_categories-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/SectorCategoriesAdd[/{id}]', SectorCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('SectorCategoriesAdd-sector_categories-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/SectorCategoriesView[/{id}]', SectorCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('SectorCategoriesView-sector_categories-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/SectorCategoriesEdit[/{id}]', SectorCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('SectorCategoriesEdit-sector_categories-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/SectorCategoriesDelete[/{id}]', SectorCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('SectorCategoriesDelete-sector_categories-delete'); // delete
    $app->group(
        '/sector_categories',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', SectorCategoriesController::class . ':list')->add(PermissionMiddleware::class)->setName('sector_categories/list-sector_categories-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', SectorCategoriesController::class . ':add')->add(PermissionMiddleware::class)->setName('sector_categories/add-sector_categories-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', SectorCategoriesController::class . ':view')->add(PermissionMiddleware::class)->setName('sector_categories/view-sector_categories-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', SectorCategoriesController::class . ':edit')->add(PermissionMiddleware::class)->setName('sector_categories/edit-sector_categories-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', SectorCategoriesController::class . ':delete')->add(PermissionMiddleware::class)->setName('sector_categories/delete-sector_categories-delete-2'); // delete
        }
    );

    // sector_features
    $app->map(["GET","POST","OPTIONS"], '/SectorFeaturesList[/{id}]', SectorFeaturesController::class . ':list')->add(PermissionMiddleware::class)->setName('SectorFeaturesList-sector_features-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/SectorFeaturesAdd[/{id}]', SectorFeaturesController::class . ':add')->add(PermissionMiddleware::class)->setName('SectorFeaturesAdd-sector_features-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/SectorFeaturesView[/{id}]', SectorFeaturesController::class . ':view')->add(PermissionMiddleware::class)->setName('SectorFeaturesView-sector_features-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/SectorFeaturesEdit[/{id}]', SectorFeaturesController::class . ':edit')->add(PermissionMiddleware::class)->setName('SectorFeaturesEdit-sector_features-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/SectorFeaturesDelete[/{id}]', SectorFeaturesController::class . ':delete')->add(PermissionMiddleware::class)->setName('SectorFeaturesDelete-sector_features-delete'); // delete
    $app->group(
        '/sector_features',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', SectorFeaturesController::class . ':list')->add(PermissionMiddleware::class)->setName('sector_features/list-sector_features-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', SectorFeaturesController::class . ':add')->add(PermissionMiddleware::class)->setName('sector_features/add-sector_features-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', SectorFeaturesController::class . ':view')->add(PermissionMiddleware::class)->setName('sector_features/view-sector_features-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', SectorFeaturesController::class . ':edit')->add(PermissionMiddleware::class)->setName('sector_features/edit-sector_features-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', SectorFeaturesController::class . ':delete')->add(PermissionMiddleware::class)->setName('sector_features/delete-sector_features-delete-2'); // delete
        }
    );

    // sectors
    $app->map(["GET","POST","OPTIONS"], '/SectorsList[/{id}]', SectorsController::class . ':list')->add(PermissionMiddleware::class)->setName('SectorsList-sectors-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/SectorsAdd[/{id}]', SectorsController::class . ':add')->add(PermissionMiddleware::class)->setName('SectorsAdd-sectors-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/SectorsView[/{id}]', SectorsController::class . ':view')->add(PermissionMiddleware::class)->setName('SectorsView-sectors-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/SectorsEdit[/{id}]', SectorsController::class . ':edit')->add(PermissionMiddleware::class)->setName('SectorsEdit-sectors-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/SectorsDelete[/{id}]', SectorsController::class . ':delete')->add(PermissionMiddleware::class)->setName('SectorsDelete-sectors-delete'); // delete
    $app->group(
        '/sectors',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', SectorsController::class . ':list')->add(PermissionMiddleware::class)->setName('sectors/list-sectors-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', SectorsController::class . ':add')->add(PermissionMiddleware::class)->setName('sectors/add-sectors-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', SectorsController::class . ':view')->add(PermissionMiddleware::class)->setName('sectors/view-sectors-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', SectorsController::class . ':edit')->add(PermissionMiddleware::class)->setName('sectors/edit-sectors-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', SectorsController::class . ':delete')->add(PermissionMiddleware::class)->setName('sectors/delete-sectors-delete-2'); // delete
        }
    );

    // services
    $app->map(["GET","POST","OPTIONS"], '/ServicesList[/{id}]', ServicesController::class . ':list')->add(PermissionMiddleware::class)->setName('ServicesList-services-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ServicesAdd[/{id}]', ServicesController::class . ':add')->add(PermissionMiddleware::class)->setName('ServicesAdd-services-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ServicesView[/{id}]', ServicesController::class . ':view')->add(PermissionMiddleware::class)->setName('ServicesView-services-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ServicesEdit[/{id}]', ServicesController::class . ':edit')->add(PermissionMiddleware::class)->setName('ServicesEdit-services-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ServicesDelete[/{id}]', ServicesController::class . ':delete')->add(PermissionMiddleware::class)->setName('ServicesDelete-services-delete'); // delete
    $app->group(
        '/services',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', ServicesController::class . ':list')->add(PermissionMiddleware::class)->setName('services/list-services-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', ServicesController::class . ':add')->add(PermissionMiddleware::class)->setName('services/add-services-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', ServicesController::class . ':view')->add(PermissionMiddleware::class)->setName('services/view-services-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', ServicesController::class . ':edit')->add(PermissionMiddleware::class)->setName('services/edit-services-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', ServicesController::class . ':delete')->add(PermissionMiddleware::class)->setName('services/delete-services-delete-2'); // delete
        }
    );

    // sessions
    $app->map(["GET","POST","OPTIONS"], '/SessionsList[/{id:.*}]', SessionsController::class . ':list')->add(PermissionMiddleware::class)->setName('SessionsList-sessions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/SessionsAdd[/{id:.*}]', SessionsController::class . ':add')->add(PermissionMiddleware::class)->setName('SessionsAdd-sessions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/SessionsView[/{id:.*}]', SessionsController::class . ':view')->add(PermissionMiddleware::class)->setName('SessionsView-sessions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/SessionsEdit[/{id:.*}]', SessionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('SessionsEdit-sessions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/SessionsDelete[/{id:.*}]', SessionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('SessionsDelete-sessions-delete'); // delete
    $app->group(
        '/sessions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id:.*}]', SessionsController::class . ':list')->add(PermissionMiddleware::class)->setName('sessions/list-sessions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id:.*}]', SessionsController::class . ':add')->add(PermissionMiddleware::class)->setName('sessions/add-sessions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id:.*}]', SessionsController::class . ':view')->add(PermissionMiddleware::class)->setName('sessions/view-sessions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id:.*}]', SessionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('sessions/edit-sessions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id:.*}]', SessionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('sessions/delete-sessions-delete-2'); // delete
        }
    );

    // taxes
    $app->map(["GET","POST","OPTIONS"], '/TaxesList[/{id}]', TaxesController::class . ':list')->add(PermissionMiddleware::class)->setName('TaxesList-taxes-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TaxesAdd[/{id}]', TaxesController::class . ':add')->add(PermissionMiddleware::class)->setName('TaxesAdd-taxes-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TaxesView[/{id}]', TaxesController::class . ':view')->add(PermissionMiddleware::class)->setName('TaxesView-taxes-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TaxesEdit[/{id}]', TaxesController::class . ':edit')->add(PermissionMiddleware::class)->setName('TaxesEdit-taxes-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TaxesDelete[/{id}]', TaxesController::class . ':delete')->add(PermissionMiddleware::class)->setName('TaxesDelete-taxes-delete'); // delete
    $app->group(
        '/taxes',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', TaxesController::class . ':list')->add(PermissionMiddleware::class)->setName('taxes/list-taxes-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', TaxesController::class . ':add')->add(PermissionMiddleware::class)->setName('taxes/add-taxes-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', TaxesController::class . ':view')->add(PermissionMiddleware::class)->setName('taxes/view-taxes-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', TaxesController::class . ':edit')->add(PermissionMiddleware::class)->setName('taxes/edit-taxes-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', TaxesController::class . ':delete')->add(PermissionMiddleware::class)->setName('taxes/delete-taxes-delete-2'); // delete
        }
    );

    // transaction
    $app->map(["GET","POST","OPTIONS"], '/TransactionList[/{id}]', TransactionController::class . ':list')->add(PermissionMiddleware::class)->setName('TransactionList-transaction-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TransactionAdd[/{id}]', TransactionController::class . ':add')->add(PermissionMiddleware::class)->setName('TransactionAdd-transaction-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TransactionView[/{id}]', TransactionController::class . ':view')->add(PermissionMiddleware::class)->setName('TransactionView-transaction-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TransactionEdit[/{id}]', TransactionController::class . ':edit')->add(PermissionMiddleware::class)->setName('TransactionEdit-transaction-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TransactionDelete[/{id}]', TransactionController::class . ':delete')->add(PermissionMiddleware::class)->setName('TransactionDelete-transaction-delete'); // delete
    $app->group(
        '/transaction',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', TransactionController::class . ':list')->add(PermissionMiddleware::class)->setName('transaction/list-transaction-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', TransactionController::class . ':add')->add(PermissionMiddleware::class)->setName('transaction/add-transaction-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', TransactionController::class . ':view')->add(PermissionMiddleware::class)->setName('transaction/view-transaction-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', TransactionController::class . ':edit')->add(PermissionMiddleware::class)->setName('transaction/edit-transaction-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', TransactionController::class . ':delete')->add(PermissionMiddleware::class)->setName('transaction/delete-transaction-delete-2'); // delete
        }
    );

    // transaction_type
    $app->map(["GET","POST","OPTIONS"], '/TransactionTypeList[/{id}]', TransactionTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('TransactionTypeList-transaction_type-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TransactionTypeAdd[/{id}]', TransactionTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('TransactionTypeAdd-transaction_type-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TransactionTypeView[/{id}]', TransactionTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('TransactionTypeView-transaction_type-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TransactionTypeEdit[/{id}]', TransactionTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('TransactionTypeEdit-transaction_type-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TransactionTypeDelete[/{id}]', TransactionTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('TransactionTypeDelete-transaction_type-delete'); // delete
    $app->group(
        '/transaction_type',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', TransactionTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('transaction_type/list-transaction_type-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', TransactionTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('transaction_type/add-transaction_type-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', TransactionTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('transaction_type/view-transaction_type-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', TransactionTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('transaction_type/edit-transaction_type-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', TransactionTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('transaction_type/delete-transaction_type-delete-2'); // delete
        }
    );

    // users
    $app->map(["GET","POST","OPTIONS"], '/UsersList[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UsersAdd[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UsersView[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UsersEdit[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UsersDelete[/{id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsersDelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config('LIST_ACTION') . '[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config('ADD_ACTION') . '[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config('VIEW_ACTION') . '[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config('EDIT_ACTION') . '[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config('DELETE_ACTION') . '[/{id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            throw new HttpNotFoundException($request, str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")));
        }
    );
};
