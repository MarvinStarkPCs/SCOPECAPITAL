<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Si el usuario no está autenticado, redirigir a login
        if (!$session->has('login')) {
            return redirect()->to('/login')->with('error', 'Sección Caducada.');; // Si intenta acceder a admin y no es admin, redirige a cliente
;
        }

        // Obtener el rol del usuario
        $rol_id = $session->get('role_id');

        // Verificar que el usuario tenga acceso a la ruta solicitada
        $uri = service('uri');
        $segmento = $uri->getSegment(1); // Obtiene el primer segmento de la URL (admin o client)

        if ($segmento === 'admin' && $rol_id != 1) {
            return redirect()->to('/client/dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');; // Si intenta acceder a admin y no es admin, redirige a cliente

        }

        if ($segmento === 'client' && $rol_id != 2) {
            return redirect()->to('/admin/dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita modificar
    }
}
