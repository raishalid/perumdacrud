<?php

namespace PHPMaker2023\crudperumdautama;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Slim\HttpCache\CacheProvider;
use Slim\Flash\Messages;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => \DI\create(CacheProvider::class),
    "flash" => fn(ContainerInterface $c) => new Messages(),
    "view" => fn(ContainerInterface $c) => new PhpRenderer($GLOBALS["RELATIVE_PATH"] . "views/"),
    "audit" => fn(ContainerInterface $c) => (new Logger("audit"))->pushHandler(new AuditTrailHandler("audit.log")), // For audit trail
    "log" => fn(ContainerInterface $c) => (new Logger("log"))->pushHandler(new RotatingFileHandler($GLOBALS["RELATIVE_PATH"] . "log.log")),
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => fn(ContainerInterface $c) => new Guard($GLOBALS["ResponseFactory"], Config("CSRF_PREFIX")),
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "beritas" => \DI\create(Beritas::class),
    "chart_of_accounts" => \DI\create(ChartOfAccounts::class),
    "companies" => \DI\create(Companies::class),
    "contacts" => \DI\create(Contacts::class),
    "customers" => \DI\create(Customers::class),
    "departements" => \DI\create(Departements::class),
    "division" => \DI\create(Division::class),
    "document_histories" => \DI\create(DocumentHistories::class),
    "document_item_taxes" => \DI\create(DocumentItemTaxes::class),
    "document_items" => \DI\create(DocumentItems::class),
    "document_totals" => \DI\create(DocumentTotals::class),
    "documents" => \DI\create(Documents::class),
    "failed_jobs" => \DI\create(FailedJobs::class),
    "funding_sources" => \DI\create(FundingSources::class),
    "investors" => \DI\create(Investors::class),
    "items" => \DI\create(Items::class),
    "items_categories" => \DI\create(ItemsCategories::class),
    "kategori_beritas" => \DI\create(KategoriBeritas::class),
    "migrations" => \DI\create(Migrations::class),
    "model_has_permissions" => \DI\create(ModelHasPermissions::class),
    "model_has_roles" => \DI\create(ModelHasRoles::class),
    "organization" => \DI\create(Organization::class),
    "password_reset_tokens" => \DI\create(PasswordResetTokens::class),
    "permissions2" => \DI\create(Permissions2::class),
    "personal_access_tokens" => \DI\create(PersonalAccessTokens::class),
    "project_categories" => \DI\create(ProjectCategories::class),
    "project_files" => \DI\create(ProjectFiles::class),
    "project_investors" => \DI\create(ProjectInvestors::class),
    "project_providers" => \DI\create(ProjectProviders::class),
    "project_statuses" => \DI\create(ProjectStatuses::class),
    "projects" => \DI\create(Projects::class),
    "role_has_permissions" => \DI\create(RoleHasPermissions::class),
    "roles" => \DI\create(Roles::class),
    "sector_categories" => \DI\create(SectorCategories::class),
    "sector_features" => \DI\create(SectorFeatures::class),
    "sectors" => \DI\create(Sectors::class),
    "services" => \DI\create(Services::class),
    "sessions" => \DI\create(Sessions::class),
    "taxes" => \DI\create(Taxes::class),
    "transaction" => \DI\create(Transaction::class),
    "transaction_type" => \DI\create(TransactionType::class),
    "users" => \DI\create(Users::class),
];
