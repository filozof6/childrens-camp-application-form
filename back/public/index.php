<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__ . '/../bootstrap/app.php';
$app->register(\Barryvdh\DomPDF\ServiceProvider::class);
$app->configureMonologUsing(function (Monolog\Logger $monolog) {
    //dd(__DIR__.'/../storage/logs/lumen.log');
    $handler = (new \Monolog\Handler\StreamHandler(__DIR__ . '/../storage/logs/lumen.log'))
        ->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true, true));

    return $monolog->pushHandler($handler);
});

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/
$app->get('getFormData', 'App\Http\Controllers\Controller@getFormData');
$app->post('submitForm', 'App\Http\Controllers\Controller@submitForm');
$app->post('sendFirstEmail', 'App\Http\Controllers\Controller@sendFirstEmail');
$app->post('sendSecondEmail', 'App\Http\Controllers\Controller@sendSecondEmail');
$app->get('generateReport', 'App\Http\Controllers\Controller@generateReport');
$app->post('zmluva', 'App\Http\Controllers\Controller@zmluva');
$app->post('prihlaska', 'App\Http\Controllers\Controller@prihlaska');
$app->post('prehlasenie-o-bezinfekcnosti', 'App\Http\Controllers\Controller@prehlasenieOBezinfekcnosti');
$app->post('potvrdenie-od-lekara', 'App\Http\Controllers\Controller@potvrdenieOdLekara');
$app->post('potvrdenie-gdpr', 'App\Http\Controllers\Controller@potvrdenieGdpr');
$app->get('reset-cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return 'done';
});
$app->run();
