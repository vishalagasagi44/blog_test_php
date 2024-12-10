<?php
require_once './baseurl.php'; // Base URL config
 
 

function get($route, $path_to_include)
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        route($route, $path_to_include);
    }
}
 
function post($route, $path_to_include)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        route($route, $path_to_include);
    }
}

function put($route, $path_to_include)
{
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        route($route, $path_to_include);
    }
}

function delete($route, $path_to_include)
{
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        route($route, $path_to_include);
    }
}
 
function any($route, $path_to_include)
{
    route($route, $path_to_include);
}
function route($route, $path_to_include)
{
    global $csrfToken;
    // Base directory for project
    $base_dir = BASE_DIR;

    $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    $request_url = rtrim($request_url, '/');
    $request_url = strtok($request_url, '?');

    // Remove base directory from the request URL
    if (strpos($request_url, $base_dir) === 0) {
        $request_url = substr($request_url, strlen($base_dir));
    }

    // Split the route and request URL into parts
    $route_parts = explode('/', $route);
    $request_url_parts = explode('/', $request_url);
    array_shift($route_parts);
    array_shift($request_url_parts);

    // If the request URL matches the route, invoke the callback
    if ($route_parts[0] == '' && count($request_url_parts) == 0) {
        if (is_callable($path_to_include)) {
            // If callback is a function, call it
            call_user_func_array($path_to_include, []);
            exit();
        }

        // If path_to_include is a controller method in the format 'Controller@method'
        if (strpos($path_to_include, '@') !== false) {
            list($controller, $method) = explode('@', $path_to_include);

            // Convert controller class name to object
            $controller = new $controller();
            
            // Call the method dynamically
            $controller->$method();
            exit();
        }

        // If it's not a callable or controller method, include the PHP file
        include_once __DIR__ . "/$path_to_include";
        exit();
    }

    // If the route does not match, return
    if (count($route_parts) != count($request_url_parts)) {
        return;
    }

    // Check for parameters in route and extract them
    $parameters = [];
    for ($i = 0; $i < count($route_parts); $i++) {
        $route_part = $route_parts[$i];
        if (preg_match("/^[$]/", $route_part)) {
            $route_part = ltrim($route_part, '$');
            array_push($parameters, $request_url_parts[$i]);
            $$route_part = $request_url_parts[$i];
        } else if ($route_parts[$i] != $request_url_parts[$i]) {
            return;
        }
    }

    // If the callback is callable, execute it
    if (is_callable($path_to_include)) {
        call_user_func_array($path_to_include, $parameters);
        exit();
    }

    // If the route is a controller and method call, instantiate and call
    if (strpos($path_to_include, '@') !== false) {
        list($controller, $method) = explode('@', $path_to_include);
        $controller = new $controller();
        $controller->$method(...$parameters);
        exit();
    }

    // Include the file for the route if it's not callable
    include_once __DIR__ . "/$path_to_include";
    exit();
}


function out($text)
{
    echo htmlspecialchars($text);
}


function generateCsrfToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Generate CSRF token for the session
$csrfToken = generateCsrfToken();

?>  