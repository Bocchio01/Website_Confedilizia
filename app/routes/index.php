<?php

/*
|--------------------------------------------------------------------------
| Set up 404 handler
|--------------------------------------------------------------------------
|
| Leaf provides a default 404 page, but you can create your own
| 404 handler by uncommenting the code below. The function
| you set here will be called when a 404 error is encountered
|
*/
app()->set404(function() {
    render('errors', ['error' => 404]);
});

/*
|--------------------------------------------------------------------------
| Set up 500 handler
|--------------------------------------------------------------------------
|
| Leaf provides a default 500 page, but you can create your own
| 500 handler by uncommenting the code below. The function
| you set here will be called when a 500 error is encountered
|
*/
app()->setErrorHandler(function($error) {
    // echo "Error number ". $error . " has occured";
    // TODO: get error number and render the correct error page
    render('errors', ['error' => 500]);
});

/*
|--------------------------------------------------------------------------
| Set up Controller namespace
|--------------------------------------------------------------------------
|
| This allows you to directly use controller names instead of typing
| the controller namespace first.
|
*/
app()->setNamespace('\App\Controllers');

/*
|--------------------------------------------------------------------------
| Your application routes
|--------------------------------------------------------------------------
|
| Leaf MVC automatically loads all files in the routes folder that
| start with "_". We call these files route _components. An example
| partial has been created for you.
|
| If you want to manually load routes, you can
| create a file that doesn't start with "_" and manually require
| it here like so:
|
*/
// require __DIR__ . '/custom-route.php';


/*
|--------------------------------------------------------------------------
| Set up app down handler
|--------------------------------------------------------------------------
|
| This allows you to set up a down page for your app (for maintenance).
|
*/

app()->setDown(function () {
    render('down');
  });
