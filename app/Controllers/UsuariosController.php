<?php
namespace App\Controllers;

use KissPhp\Protocols\Http\Request;
use KissPhp\Abstractions\WebController;
use KissPhp\Attributes\Http\{ Controller, Get, Post };
use KissPhp\Attributes\Data\DTO;

use App\Services\Usuarios\UsuariosService;
use App\DTOs\Usuarios\CadastroUsuario;

#[Controller('/usuarios')]
class UsuariosController extends WebController {
    public function __construct(private UsuariosService $service) {}

    #[Get('/cadastro')]
    public function exibirPaginaDeCadastro() {
        $this->render('Pages/usuarios/cadastro');
    }

    #[Post('/cadastro')]
    public function cadastrarUsuario(
        Request $request,
        #[DTO] CadastroUsuario $usuario
    ) {
        try {
            $this->service->cadastrarUsuario($usuario);
            return $this->redirect('/login');
        } catch (\Exception $e) {
            $request->session->set('ErroCadastro', $e->getMessage());
            return $this->redirect('/usuarios/cadastro');
        }
    }

    #[Get('/tipo/{id}')]
    public function verificarTipoUsuario(int $id) {
        try {
            $tipo = $this->service->verificarTipoUsuario($id);
            $this->render('Pages/usuarios/tipo', ['tipo' => $tipo]);
        } catch (\Exception $e) {
            $this->render('Pages/usuarios/tipo', ['erro' => $e->getMessage()]);
        }
    }
} 