<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo - Job4You</title>
  
  <!-- Importando o Tailwind CSS (framework de estilos) -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Importando ícones do Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <style>
    /* Estilos personalizados para a sidebar */
    .sidebar {
      min-height: 100vh;  /* Faz a sidebar ocupar 100% da altura da tela */
      width: 250px;       /* Largura fixa para a sidebar */
    }
    
    /* Efeito de hover nos cards */
    .dashboard-card {
      transition: all 0.3s ease; /* Transição suave de 0.3 segundos */
    }
    .dashboard-card:hover {
      transform: translateY(-5px); /* Efeito de levantar o card */
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); /* Sombra mais pronunciada */
    }
  </style>
</head>

<body class="bg-gray-50">
  <!-- ============================================= -->
  <!-- ESTRUTURA PRINCIPAL DO PAINEL -->
  <!-- ============================================= -->
      <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar fixed h-full bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Job4You ADM</h1>
            </div>
            <nav class="mt-6">
                <ul>
                    <li class="px-4 py-3 hover:bg-gray-700">
                        <a href="#" class="flex items-center">
                            <i class="bi bi-house-door mr-2"></i> Home
                        </a>
                    </li>
                    <li class="px-4 py-3 bg-gray-700">
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
                    <li class="px-4 py-3 hover:bg-gray-700 mt-6 border-t border-gray-600">
                        <a href="#" class="flex items-center text-red-400">
                            <i class="bi bi-box-arrow-right mr-2"></i> Sair
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <!-- ÁREA DE CONTEÚDO PRINCIPAL -->
    <main class="flex-1 ml-[250px]"> <!-- ml-[250px] para compensar a largura da sidebar -->
      
      <!-- Cabeçalho do conteúdo -->
      <header class="bg-white shadow-sm py-8 px-4">
        <div class="container mx-auto text-center">
          <h2 class="text-3xl font-bold text-gray-800">Painel Administrativo</h2>
          <p class="text-gray-600 mt-2">
            Você está no centro de controle do Job4You. Aqui você gerencia usuários, prestadores e serviços.
          </p>
        </div>
      </header>

      <!-- Seção de cartões com estatísticas -->
      <div class="container mx-auto p-6">
        <!-- Grid responsivo: 1 coluna em mobile, 2 em tablet, 4 em desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <!-- Cartão - Usuários cadastrados -->
          <div class="bg-white rounded-lg shadow-md dashboard-card p-6 border-t-4 border-blue-400">
            <div class="flex items-center">
              <!-- Ícone com fundo circular -->
              <div class="p-3 rounded-full bg-blue-50 text-blue-500 mr-4">
                <i class="bi bi-people text-xl"></i>
              </div>
              <div>
                <h6 class="text-sm font-bold text-gray-600 uppercase">Usuários cadastrados</h6>
                <p class="text-3xl font-semibold mt-1">0</p> <!-- Valor numérico grande -->
              </div>
            </div>
          </div>
          
          <!-- Cartão - Prestadores (mesma estrutura, cores diferentes) -->
          <div class="bg-white rounded-lg shadow-md dashboard-card p-6 border-t-4 border-green-400">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-green-50 text-green-500 mr-4">
                <i class="bi bi-person-check text-xl"></i>
              </div>
              <div>
                <h6 class="text-sm font-bold text-gray-600 uppercase">Prestadores</h6>
                <p class="text-3xl font-semibold mt-1">0</p>
              </div>
            </div>
          </div>
          
          <!-- Cartão - Serviços ativos -->
          <div class="bg-white rounded-lg shadow-md dashboard-card p-6 border-t-4 border-purple-400">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-purple-50 text-purple-500 mr-4">
                <i class="bi bi-briefcase text-xl"></i>
              </div>
              <div>
                <h6 class="text-sm font-bold text-gray-600 uppercase">Serviços ativos</h6>
                <p class="text-3xl font-semibold mt-1">0</p>
              </div>
            </div>
          </div>
          
          <!-- Cartão - Aprovações pendentes -->
          <div class="bg-white rounded-lg shadow-md dashboard-card p-6 border-t-4 border-yellow-400">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-yellow-50 text-yellow-500 mr-4">
                <i class="bi bi-clock-history text-xl"></i>
              </div>
              <div>
                <h6 class="text-sm font-bold text-gray-600 uppercase">Aprovações pendentes</h6>
                <p class="text-3xl font-semibold mt-1">0</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Seções inferiores do painel -->
      <div class="container mx-auto px-6 pb-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Seção de Notificações Recentes -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-400">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">
              <i class="bi bi-bell-fill text-blue-500 mr-2"></i>
              Notificações Recentes
            </h3>
            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">3 novas</span>
          </div>
          <ul class="space-y-3">
            <!-- Item de notificação -->
            <li class="flex items-start">
              <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                <i class="bi bi-person-plus text-blue-600 text-sm"></i>
              </div>
              <div>
                <p class="text-sm">Novo usuário cadastrado: <span class="font-semibold">Carlos</span></p>
                <p class="text-xs text-gray-500">Hoje, 10:30</p>
              </div>
            </li>
            
            <!-- Mais itens de notificação... -->
          </ul>
        </div>
        
        <!-- Seção de Últimos Serviços Cadastrados -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-400">
          <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="bi bi-list-ul text-green-500 mr-2"></i>
            Últimos Serviços Cadastrados
          </h3>
          <ul class="space-y-3">
            <!-- Item de serviço -->
            <li class="flex justify-between items-center border-b pb-2">
              <div>
                <p class="font-medium">Encanamento residencial</p>
                <p class="text-sm text-gray-500">Prestador: João Silva</p>
              </div>
              <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Em análise</span>
            </li>
            
            <!-- Mais itens de serviço... -->
          </ul>
        </div>
        
        <!-- Seção de Aprovações de Prestadores -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-purple-400">
          <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="bi bi-clock-history text-purple-500 mr-2"></i>
            Aprovações de Prestadores
          </h3>
          <ul class="space-y-3">
            <!-- Item de prestador -->
            <li class="flex justify-between items-center border-b pb-2">
              <div>
                <p class="font-medium">João Silva</p>
                <p class="text-sm text-gray-500">Encanador</p>
              </div>
              <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                Analisar
              </button>
            </li>
            
            <!-- Mais itens de prestador... -->
          </ul>
        </div>
      </div>
    </main>
  </div>
</body>
</html>