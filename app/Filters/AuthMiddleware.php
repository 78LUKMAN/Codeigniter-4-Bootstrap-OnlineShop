<?php

namespace App\Filters;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;

class AuthMiddleware implements FilterInterface
{
    public function before(\CodeIgniter\HTTP\RequestInterface $request, $arguments = null)
    {
        // Cek apakah pengguna telah melakukan otentikasi
        if (!session()->get('isLoggedIn')) {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function after(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu ada tindakan setelah filter
    }
}
