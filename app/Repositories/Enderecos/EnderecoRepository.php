<?php
namespace App\Repositories\Enderecos;

use App\Entities\Endereco;
use KissPhp\Abstractions\Repository;

class EnderecoRepository extends Repository {
  public function cadastrar(Endereco $endereco): int {
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
      error_log("[Error] EnderecoRepository::cadastrar: {$th->getMessage()}");
      throw new \Exception("Erro ao cadastrar endereço");
    }
  }

  public function buscarPorId(): Endereco {

  }
} 