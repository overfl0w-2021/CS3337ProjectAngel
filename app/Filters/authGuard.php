<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class authGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['isLoggedIn']))
        {
            return redirect()->route('Login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

?>