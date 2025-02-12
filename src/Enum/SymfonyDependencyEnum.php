<?php

namespace App\Enum;

enum SymfonyDependencyEnum: string
{
        // Symfony core packages
    case Security = 'symfony/security';
    case Twig = 'symfony/twig';
    case Doctrine = 'symfony/doctrine';
    case Mailer = 'symfony/mailer';
    case Validator = 'symfony/validator';
    case Form = 'symfony/form';
    case Routing = 'symfony/routing';
    case HttpFoundation = 'symfony/http-foundation';
    case EventDispatcher = 'symfony/event-dispatcher';
    case Console = 'symfony/console';
    case Translation = 'symfony/translation';
    case Serializer = 'symfony/serializer';
    case DependencyInjection = 'symfony/dependency-injection';
    case SecurityBundle = 'symfony/security-bundle';
    case FrameworkBundle = 'symfony/framework-bundle';
    case WebProfilerBundle = 'symfony/web-profiler-bundle';
    case Asset = 'symfony/asset';
    case Logger = 'symfony/logger';
    case Cache = 'symfony/cache';
    case HttpKernel = 'symfony/http-kernel';
    case DebugBundle = 'symfony/debug-bundle';

        // Symfony packages for API development
    case ApiPlatform = 'api-platform/core';
    case DoctrineOrm = 'doctrine/orm';

        // Symfony packages for testing
    case PHPUnit = 'phpunit/phpunit';
    case SymfonyTest = 'symfony/test-pack';

        // Symfony packages for security
    case SecurityAcl = 'symfony/security-acl';
    case SecurityCore = 'symfony/security-core';
    case SecurityCsrf = 'symfony/security-csrf';

        // Other Symfony tools
    case Messenger = 'symfony/messenger';
    case CacheClear = 'symfony/cache-clear';
    case MakerBundle = 'symfony/maker-bundle';
    case SerializerBundle = 'symfony/serializer-bundle';
    case DoctrineMigrations = 'doctrine/doctrine-migrations-bundle';
    case FOSRest = 'friendsofsymfony/rest-bundle';
    case Swagger = 'nelmio/api-doc-bundle';
    case TranslationBundle = 'symfony/translation-bundle';
    case SecurityOAuth = 'knpuniversity/oauth2-client-bundle';
    case Swiftmailer = 'symfony/swiftmailer-bundle';
    case JWT = 'lexik/jwt-authentication-bundle';

        // Symfony packages for frontend
    case WebpackEncore = 'symfony/webpack-encore-bundle';
    case Bootstrap = 'twbs/bootstrap';
    case TailwindCSS = 'tailwindcss/tailwindcss';
}
