<?php
namespace App\Repositories\Usuarios;

use KissPhp\Abstractions\Repository;

use App\DTOs\CadastroUsuario\{ Usuario, Endereco };

class UsuariosRepository extends Repository {
  public function verificarEmailExistente(string $email): bool {
    try {
      $query = $this->database()
        ->getConnection()
        ->createQueryBuilder()
        ->select('c.ID')
        ->from('Credencial', 'c')
        ->where('c.Email = :email')
        ->setParameter('email', $email);

      return $query->executeQuery()->rowCount() > 0;
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::verificarEmailExistente: {$th->getMessage()}");
      throw new \Exception("Erro ao verificar email existente");
    }
  }

  public function cadastrarEndereco(Endereco $endereco): int {
    try {
      $query = $this->database()
        ->getConnection()
        ->createQueryBuilder()
        ->insert('Endereco')
        ->values([
          'CEP' => ':cep',
          'Estado' => ':estado',
          'Cidade' => ':cidade',
          'Bairro' => ':bairro',
          'Rua' => ':rua'
        ])
        ->setParameter('cep', $endereco->cep)
        ->setParameter('estado', $endereco->estado)
        ->setParameter('cidade', $endereco->cidade)
        ->setParameter('bairro', $endereco->bairro)
        ->setParameter('rua', $endereco->rua);

      $query->executeQuery();
      return (int) $this->database()->getConnection()->lastInsertId();
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::cadastrarEndereco: {$th->getMessage()}");
      throw new \Exception("Erro ao cadastrar endereço");
    }
  }

  public function cadastrarCredencial(string $email, string $senha): int {
    try {
      $query = $this->database()
        ->getConnection()
        ->createQueryBuilder()
        ->insert('Credencial')
        ->values([
          'Email' => ':email',
          'Senha' => ':senha',
          'FKNivelAcesso' => ':nivelAcesso'
        ])
        ->setParameter('email', $email)
        ->setParameter('senha', $senha)
        ->setParameter('nivelAcesso', 3); // CLIENTE

      $query->executeQuery();
      return (int) $this->database()->getConnection()->lastInsertId();
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::cadastrarCredencial: {$th->getMessage()}");
      throw new \Exception("Erro ao cadastrar credencial");
    }
  }

  public function cadastrarUsuario(Usuario $usuario, int $credencial, int $endereco): bool {
    try {
      $query = $this->database()
        ->getConnection()
        ->createQueryBuilder()
        ->insert('Usuario')
        ->values([
          'Nome' => ':nome',
          'CPF' => ':cpf',
          'Celular' => ':celular',
          'DataNascimento' => ':dataNascimento',
          'FKCredencial' => ':credencial',
          'FKEndereco' => ':endereco'
        ])
        ->setParameter('nome', $usuario->nome)
        ->setParameter('cpf', $usuario->cpf)
        ->setParameter('celular', $usuario->telefone)
        ->setParameter('dataNascimento', $usuario->dataNascimento)
        ->setParameter('credencial', $credencial)
        ->setParameter('endereco', $endereco);

      $query->executeQuery();
      return true;
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::cadastrarUsuario: {$th->getMessage()}");
      throw new \Exception("Erro ao cadastrar usuário");
    }
  }

  public function verificarTipoUsuario(int $idUsuario): string {
    try {
      $query = $this->database()->getConnection()
        ->createQueryBuilder()
        ->select('COUNT(*) as qtd')
        ->from('PublicacaoServico', 'p')
        ->where('p.FKUsuario = :idUsuario')
        ->setParameter('idUsuario', $idUsuario);

      $result = $query->executeQuery()->fetchAssociative();

      if ($result['qtd'] > 0) {
        $this->atualizarNivelAcesso($idUsuario, 2); // PRESTADOR
        return "PRESTADOR";
      }

      return "CLIENTE";
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::verificarTipoUsuario: {$th->getMessage()}");
      throw new \Exception("Erro ao verificar tipo de usuário");
    }
  }

  public function atualizarNivelAcesso(int $idUsuario, int $nivelAcesso): void {
    try {
      $query = $this->database()->getConnection()
        ->createQueryBuilder()
        ->update('Credencial')
        ->set('FKNivelAcesso', ':nivelAcesso')
        ->where('ID = (SELECT FKCredencial FROM Usuario WHERE ID = :idUsuario)')
        ->setParameter('nivelAcesso', $nivelAcesso)
        ->setParameter('idUsuario', $idUsuario);

      $query->executeQuery();
    } catch (\Throwable $th) {
      error_log("[Error] UsuariosRepository::atualizarNivelAcesso: {$th->getMessage()}");
      throw new \Exception("Erro ao atualizar nível de acesso");
    }
  }
}
