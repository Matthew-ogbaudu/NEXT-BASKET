<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue API supports an assortment of back-ends via a single
    | API, giving you convenient access to each back-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'rabbitmq'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => 90,
            'block_for' => null,
            'after_commit' => false,
        ],
        'rabbitmq' => [

            'driver' => 'rabbitmq',
            'queue' => env('RABBITMQ_QUEUE', 'default'),
            'factory_class' => \Enqueue\AmqpBunny\AmqpConnectionFactory::class,

            'hosts' => [
                [
                    'host' => env('RABBITMQ_HOST', 'rattlesnake.rmq.cloudamqp.com'),
                    'port' => env('RABBITMQ_PORT', 5672),
                    'user' => env('RABBITMQ_USER', 'hzarzwsk'),
                    'password' => env('RABBITMQ_PASSWORD', 'KgaylqqHhaZcZA-8c_shsJs7sxESeXgl'),
                    'vhost' => env('RABBITMQ_VHOST', 'hzarzwsk'),
                ],
            ],

            'options' => [
                'ssl_options' => [
                    'cafile' => env('RABBITMQ_SSL_CAFILE', null),
                    'local_cert' => env('RABBITMQ_SSL_LOCALCERT', null),
                    'local_key' => env('RABBITMQ_SSL_LOCALKEY', null),
                    'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
                    'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', null),
                ],
                'exchange' => [

                    'name' => env('RABBITMQ_EXCHANGE_NAME'),

                    /*
                 * Determine if exchange should be created if it does not exist.
                 */

                    'declare' => env('RABBITMQ_EXCHANGE_DECLARE', true),

                    /*
                 * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
                 */

                    'type' => env('RABBITMQ_EXCHANGE_TYPE', \Interop\Amqp\AmqpTopic::TYPE_DIRECT),
                    'passive' => env('RABBITMQ_EXCHANGE_PASSIVE', false),
                    'durable' => env('RABBITMQ_EXCHANGE_DURABLE', true),
                    'auto_delete' => env('RABBITMQ_EXCHANGE_AUTODELETE', false),
                    'arguments' => env('RABBITMQ_EXCHANGE_ARGUMENTS'),
                ],

            ],

            /*
             * Set to "horizon" if you wish to use Laravel Horizon.
             */
            'worker' => env('RABBITMQ_WORKER', 'default'),

        ],
        'queue' => [
            /*
            * Determine if queue should be created if it does not exist.
            */
            'declare' => env('RABBITMQ_QUEUE_DECLARE', true),
            /*
            * Determine if queue should be binded to the exchange created.
            */
            'bind' => env('RABBITMQ_QUEUE_DECLARE_BIND', true),
            /*
            * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
            */
            'passive' => env('RABBITMQ_QUEUE_PASSIVE', false),
            'durable' => env('RABBITMQ_QUEUE_DURABLE', true),
            'exclusive' => env('RABBITMQ_QUEUE_EXCLUSIVE', false),
            'auto_delete' => env('RABBITMQ_QUEUE_AUTODELETE', false),
            'arguments' => env('RABBITMQ_QUEUE_ARGUMENTS'),
            ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Job Batching
    |--------------------------------------------------------------------------
    |
    | The following options configure the database and table that store job
    | batching information. These options can be updated to any database
    | connection and table which has been defined by your application.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],


];
