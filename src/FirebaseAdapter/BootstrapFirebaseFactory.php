<?php declare(strict_types = 1);


namespace Ramsterhad\WowTask\FirebaseAdapter;

use GuzzleHttp\MessageFormatter;
use Kreait\Firebase\Factory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class BootstrapFirebaseFactory
{
    private ?Factory $factory = null;

    public function getFirebaseFactory(
        Logger $logger,
        StreamHandler $loggerStreamHandler,
        Logger $debugLogger,
        StreamHandler $debugLoggerStreamHandler,
        MessageFormatter $messageFormatter
    ): Factory {

        if (!$this->factory instanceof Factory) {
            $httpLogger = $logger;
            $httpLogger->pushHandler($loggerStreamHandler);

            $factory = (new Factory())->withServiceAccount(GOOGLE_APPLICATION_CREDENTIALS);
            $factory = $factory->withDatabaseUri('https://wow-task-default-rtdb.europe-west1.firebasedatabase.app/');

            // Without further arguments, requests and responses will be logged with basic
            // request and response information. Successful responses will be logged with
            // the 'info' log level, failures (Status code >= 400) with 'notice'
            $factory = $factory->withHttpLogger($httpLogger);

            // You can configure the message format and log levels individually
            $factory = $factory->withHttpLogger(
                $httpLogger,
                $messageFormatter,
                'debug',
                'warning'
            );

            // You can provide a separate logger for detailed HTTP message logs
            $debugLogger->pushHandler($debugLoggerStreamHandler);

            // Logs will include the full request and response headers and bodies
            $this->factory = $factory->withHttpDebugLogger($debugLogger); //@todo assignment necessary?
        }

        return $this->factory;
    }
}