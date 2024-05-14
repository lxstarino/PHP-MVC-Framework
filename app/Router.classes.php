<?php 
namespace app;
use boot\application;

class Router {
    public Response $response;
    protected array $routes = [];

    public function __construct(Response $response){
        $this->response = $response;
    }

    public function get($path, $callback){
        $path = preg_quote($path, '/');
        $path = preg_replace('/\\\{(\w+)\\\}/', '(\w+)', $path);
        $path = '/^' . $path . '$/';
        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback){
        $this->routes["post"][$path] = $callback;
    }

    public function resolve(){
        $fullPath = $this->getPath();
        $method = $this->getMethod();

        // Extract the part of the URI before the question mark
        $path = strtok($fullPath, '?');

        // Check if the route matches directly
        $callback = $this->routes[$method][$path] ?? false;

        // If no direct match was found, check the routes for regular expressions
        if(!$callback){
            foreach ($this->routes["get"] as $route => $handler) {
                // Check if the regular expression matches with the path: Example route /profile/{id} => /profile/2
                if (preg_match($route, $path, $matches)) {
                    $params = array_slice($matches, 1);
                    $callback = $handler ?? false;
                    break;
                }
            }
        }

        // If no callback found return 404 not found
        if(!$callback) {
            $this->response->setStatusCode(404);
            return $this->renderOnlyView("404");
        }

        // Parse query params
        $queryParams = [];
        parse_str(parse_url($fullPath, PHP_URL_QUERY), $queryParams);
  
        // If query param found add to params
        if($queryParams){
            $params[] = $queryParams;
        }

        // Processing the callback
        if(is_string($callback)){
            return $this->renderView($callback);
        }

        if(is_array($callback)){
            application::$app->basecontroller = new $callback[0]();
            $callback[0] = application::$app->basecontroller;
        }

        return call_user_func($callback, $params ?? null);
    }

    public function renderView($view, $page_params = [], $layout_params = []){
        $pageLayout = $this->renderLayout($layout_params);
        $pageContent = $this->renderOnlyView($view, $page_params);

        return str_replace("{{page_content}}", $pageContent, $pageLayout);
    }

    private function renderLayout($params = []){
        foreach ($params as $key => $value){
            $$key = $value;
        } 
        
        $layout = application::$app->basecontroller->layout ?? "main";
        $title = application::$app->basecontroller->title ?? "lxst";

        ob_start();
        include_once application::$ROOT_DIR."/app/view/layouts/$layout.php";
        return ob_get_clean();
    }

    private function renderOnlyView($view, $params = []){
        foreach ($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include_once application::$ROOT_DIR."/app/view/$view.php";
        return ob_get_clean();
    }

    private function getPath(){
        return $_SERVER["REQUEST_URI"] ?? "/";
    }

    private function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
?>