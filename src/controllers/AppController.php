<?php

class AppController{

    private $request;
    
    public function __construct(){
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet (): bool {
        return $this->request === 'GET';
    }

    protected function isPost (): bool {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'.$template.'.php';
        $output = 'File not found';

        if(file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    protected function checkAuthentication() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $allowedRoutes = ['/login', '/register'];
        $currentRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!in_array($currentRoute, $allowedRoutes) && !isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }

}