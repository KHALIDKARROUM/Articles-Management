<?php

class ErrorController {
   public static function notFound() {
    // Inclure l'en-tête avant tout
     
    
    http_response_code(404);
    include VIEW_PATH . '/Errors/404.php';
    exit;
}


}
