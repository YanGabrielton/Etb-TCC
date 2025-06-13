<?php
namespace App\Middlewares;

use KissPhp\Protocols\Http\Request;
use KissPhp\Abstractions\WebMiddleware;

class VerificaSeUsuarioLogado extends WebMiddleware {
  public function handle(Request $request, \Closure $next): ?Request {
    if ($request->session->has('usuario_autenticado')) {
      return $next($request);
    }
    return $request->redirectToBack();
  }
}