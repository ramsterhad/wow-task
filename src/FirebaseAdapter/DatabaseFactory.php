<?php declare(strict_types = 1);


namespace Ramsterhad\WowTask\FirebaseAdapter;

use GuzzleHttp\MessageFormatter;
use Kreait\Firebase\Database;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class DatabaseFactory
{
    public function getDatabase(): Database
    {

        $factory = (new BootstrapFirebaseFactory())->getFirebaseFactory(
            new Logger('firebase_http_logs'),
            new StreamHandler('../logs/firebase_api.log', Logger::INFO),
            new Logger('firebase_http_debug_logs'),
            new StreamHandler('../logs/firebase_api.log', Logger::DEBUG),
            new MessageFormatter(MessageFormatter::SHORT),
        );

        return $factory->createDatabase();
    }
}