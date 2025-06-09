<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo - Job4You</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Ícones do Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <style>
    .sidebar {
      min-height: 100vh;
      width: 250px;
    }
    .dashboard-card {
      transition: all 0.3s ease;
    }
    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .status-card {
      border-left: 4px solid;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="flex">
    <!-- Sidebar -->
    <div class="sidebar fixed h-full bg-gray-800 text-white">
      <div class="p-4 border-b border-gray-700">
        <h1 class="text-2xl font-bold text-center">Job4You</h1>
        
        <!-- Foto do usuário com saudação -->
        <div class="flex items-center mt-4 p-2 rounded-lg">
          <img src="<?php echo isset($usuario['foto']) ? $usuario['foto'] : 'https://via.placeholder.com/40'; ?>" 
               alt="Foto do usuário" 
               class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400">
          <div class="ml-3">
            <p class="font-medium text-sm">Olá, <span class="text-yellow-400">Administrador</span></p>
            <p class="text-xs text-gray-300"><?php echo $usuario['email'] ?? 'admin@job4you.com'; ?></p>
          </div>
        </div>
      </div>
      
      <nav class="mt-4">
        <ul>
          <li class="px-4 py-3 bg-gray-700">
            <a href="#" class="flex items-center">
              <i class="bi bi-house-door mr-2"></i> Home
            </a>
          </li>
          <li class="px-4 py-3 hover:bg-gray-700">
            <a href="#" class="flex items-center">
              <i class="bi bi-people mr-2"></i> Usuários
            </a>
          </li>
          <li class="px-4 py-3 hover:bg-gray-700">
            <a href="#" class="flex items-center">
              <i class="bi bi-briefcase mr-2"></i> Prestadores
            </a>
          </li>
          <li class="px-4 py-3 hover:bg-gray-700">
            <a href="#" class="flex items-center">
              <i class="bi bi-tools mr-2"></i> Serviços
            </a>
          </li>
          <li class="px-4 py-3 hover:bg-gray-700">
            <a href="#" class="flex items-center">
              <i class="bi bi-check-circle mr-2"></i> Aprovações
            </a>
          </li>
          <li class="px-4 py-3 hover:bg-gray-700">
            <a href="#" class="flex items-center">
              <i class="bi bi-gear mr-2"></i> Configurações
            </a>
          </li>
          <li class="px-4 py-3 hover:bg-gray-700 mt-4 border-t border-gray-700">
            <a href="#" class="flex items-center text-red-400">
              <i class="bi bi-box-arrow-right mr-2"></i> Sair
            </a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Área de conteúdo principal -->
    <main class="flex-1 ml-[250px] p-6">
      <!-- Cabeçalho -->
      <header class="bg-white shadow-sm py-8 px-4 text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Painel Administrativo</h1>
        <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
          Você está no centro de controle do Job4You. Gerencie usuários, prestadores e serviços.
        </p>
      </header>

      <!-- Cards de status dinâmicos -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Usuários Cadastrados -->
        <div class="bg-white rounded-lg shadow p-6 status-card border-l-blue-500 dashboard-card">
          <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">USUÁRIOS CADASTRADOS</h3>
          <div class="flex items-center justify-between">
            <span class="text-3xl font-bold"><?php echo $dados['total_usuarios'] ?? '0'; ?></span>
            <i class="bi bi-people text-blue-500 text-2xl"></i>
          </div>
        </div>
        
        <!-- Prestadores -->
        <div class="bg-white rounded-lg shadow p-6 status-card border-l-green-500 dashboard-card">
          <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">PRESTADORES</h3>
          <div class="flex items-center justify-between">
            <span class="text-3xl font-bold"><?php echo $dados['total_prestadores'] ?? '0'; ?></span>
            <i class="bi bi-person-check text-green-500 text-2xl"></i>
          </div>
        </div>
        
        <!-- Serviços Ativos -->
        <div class="bg-white rounded-lg shadow p-6 status-card border-l-purple-500 dashboard-card">
          <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">SERVIÇOS ATIVOS</h3>
          <div class="flex items-center justify-between">
            <span class="text-3xl font-bold"><?php echo $dados['total_servicos'] ?? '0'; ?></span>
            <i class="bi bi-briefcase text-purple-500 text-2xl"></i>
          </div>
        </div>
        
        <!-- Aprovações Pendentes -->
        <div class="bg-white rounded-lg shadow p-6 status-card border-l-yellow-500 dashboard-card">
          <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">APROVAÇÕES PENDENTES</h3>
          <div class="flex items-center justify-between">
            <span class="text-3xl font-bold"><?php echo $dados['total_aprovacoes'] ?? '0'; ?></span>
            <i class="bi bi-clock-history text-yellow-500 text-2xl"></i>
          </div>
        </div>
      </div>

      <!-- Título de gerenciamento rápido -->
      <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center justify-center">
        <i class="bi bi-speedometer2 mr-2 text-yellow-500"></i>
        Gerenciamento de Visualização Rápida
      </h2>

      <!-- Cards inferiores -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Notificações Recentes -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-400 dashboard-card">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">
              <i class="bi bi-bell-fill text-blue-500 mr-2"></i>
              Notificações Recentes
            </h3>
            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
              <?php echo count($notificacoes) ?? '0'; ?> novas
            </span>
          </div>
          <ul class="space-y-3">
            <?php foreach ($notificacoes as $notificacao): ?>
            <li class="flex items-start">
              <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                <i class="bi bi-<?php echo $notificacao['icone']; ?> text-blue-600 text-sm"></i>
              </div>
              <div>
                <p class="text-sm"><?php echo $notificacao['mensagem']; ?></p>
                <p class="text-xs text-gray-500 mt-1"><?php echo $notificacao['data']; ?></p>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        
        <!-- Últimos Serviços -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-400 dashboard-card">
          <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="bi bi-list-ul text-green-500 mr-2"></i>
            Últimos Serviços Cadastrados
          </h3>
          <ul class="space-y-3">
            <?php foreach ($servicos as $servico): ?>
            <li class="flex justify-between items-center border-b pb-2">
              <div>
                <p class="font-medium"><?php echo $servico['titulo']; ?></p>
                <p class="text-sm text-gray-500">Prestador: <?php echo $servico['prestador']; ?></p>
              </div>
              <span class="bg-<?php echo $servico['status_cor']; ?>-100 text-<?php echo $servico['status_cor']; ?>-800 text-xs px-2 py-1 rounded-full">
                <?php echo $servico['status']; ?>
              </span>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        
        <!-- Aprovações -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-purple-400 dashboard-card">
          <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="bi bi-clock-history text-purple-500 mr-2"></i>
            Aprovações de Prestadores
          </h3>
          <ul class="space-y-3">
            <?php foreach ($aprovacoes as $aprovacao): ?>
            <li class="flex justify-between items-center border-b pb-2">
              <div>
                <p class="font-medium"><?php echo $aprovacao['nome']; ?></p>
                <p class="text-sm text-gray-500"><?php echo $aprovacao['servico']; ?></p>
              </div>
              <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded transition">
                Analisar
              </button>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </main>
  </div>

</body>
</html>