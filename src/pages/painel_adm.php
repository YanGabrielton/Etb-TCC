<?php
// Conexão com o banco de dados
require_once 'admin_backend.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Job4You</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .sidebar {
            min-height: 100vh;
            width: 250px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .action-btn {
            transition: all 0.2s;
        }

        .action-btn:hover {
            transform: scale(1.1);
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
                    <img src="<?php echo !empty($usuario['Foto']) ? htmlspecialchars($usuario['Foto']) : 'https://via.placeholder.com/40'; ?>"
                        alt="Foto do usuário" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400">
                    <div class="ml-3">
                        <p class="font-medium text-sm">Olá, <span class="text-yellow-400">
                                <?php echo htmlspecialchars($usuario['Nome'] ?? 'Admin'); ?>
                            </span></p>
                        <p class="text-xs text-gray-300">
                            <?php echo htmlspecialchars($usuario['Email'] ?? 'admin@job4you.com'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <nav class="mt-4">
                <ul>
                    <li class="px-4 py-3 hover:bg-gray-700 cursor-pointer tab-link active" data-tab="dashboard">
                        <a class="flex items-center">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-700 cursor-pointer tab-link" data-tab="usuarios">
                        <a class="flex items-center">
                            <i class="fas fa-users mr-2"></i> Usuários
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-700 cursor-pointer tab-link" data-tab="prestadores">
                        <a class="flex items-center">
                            <i class="fas fa-user-tie mr-2"></i> Prestadores
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-700 cursor-pointer tab-link" data-tab="servicos">
                        <a class="flex items-center">
                            <i class="fas fa-briefcase mr-2"></i> Serviços
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-700 cursor-pointer tab-link" data-tab="perfil">
                        <a class="flex items-center">
                            <i class="fas fa-user-cog mr-2"></i> Meu Perfil
                        </a>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-700 mt-auto border-t border-gray-700">
                        <a href="logout.php" class="flex items-center text-red-400">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sair
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Área de conteúdo principal -->
        <main class="flex-1 ml-[250px] p-6">
            <!-- Dashboard -->
            <div id="dashboard" class="tab-content active">
                <header class="bg-white shadow-sm py-8 px-4 text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Painel Administrativo</h1>
                    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
                        Você está no centro de controle do Job4You. Gerencie usuários, prestadores e serviços.
                    </p>
                </header>

                <!-- Cards de status dinâmicos -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Usuários Cadastrados -->
                    <div class="bg-white rounded-lg shadow p-6 status-card border-l-blue-500 dashboard-card">
                        <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">USUÁRIOS CADASTRADOS</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold">
                                <?php echo $total_usuarios; ?>
                            </span>
                            <i class="fas fa-users text-blue-500 text-2xl"></i>
                        </div>
                        <a class="mt-3 text-blue-600 text-sm flex items-center cursor-pointer tab-link"
                            data-tab="usuarios">
                            Ver todos <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <!-- Prestadores -->
                    <div class="bg-white rounded-lg shadow p-6 status-card border-l-green-500 dashboard-card">
                        <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">PRESTADORES</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold">
                                <?php echo $total_prestadores; ?>
                            </span>
                            <i class="fas fa-user-tie text-green-500 text-2xl"></i>
                        </div>
                        <a class="mt-3 text-green-600 text-sm flex items-center cursor-pointer tab-link"
                            data-tab="prestadores">
                            Ver todos <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <!-- Serviços Ativos -->
                    <div class="bg-white rounded-lg shadow p-6 status-card border-l-purple-500 dashboard-card">
                        <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">SERVIÇOS ATIVOS</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold">
                                <?php echo $total_servicos; ?>
                            </span>
                            <i class="fas fa-briefcase text-purple-500 text-2xl"></i>
                        </div>
                        <a class="mt-3 text-purple-600 text-sm flex items-center cursor-pointer tab-link"
                            data-tab="servicos">
                            Ver todos <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Gerenciamento Rápido -->
                <h2 class="text-xl font-bold text-gray-800 mb-4">Gerenciamento Rápido</h2>

                <!-- Atividades Recentes -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-t-4 border-yellow-400 dashboard-card">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">
                            <i class="fas fa-history text-yellow-500 mr-2"></i>
                            Atividades Recentes
                        </h3>
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                            Últimas 10 atividades
                        </span>
                    </div>
                    <div class="space-y-4">
                        <?php foreach($atividades as $atividade): ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center 
                  <?php echo $atividade['tipo'] === 'usuario' ? 'bg-blue-100 text-blue-500' : 
                         ($atividade['tipo'] === 'servico' ? 'bg-purple-100 text-purple-500' : 'bg-green-100 text-green-500'); ?>">
                                    <i class="<?php echo $atividade['icone']; ?>"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-800">
                                    <?php echo htmlspecialchars($atividade['mensagem']); ?>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo date('d/m/Y H:i', strtotime($atividade['data'])); ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Aba Usuários -->
            <div id="usuarios" class="tab-content">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Gerenciar Usuários</h1>
                        <p class="text-gray-600">Lista completa de usuários cadastrados</p>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                        <i class="fas fa-plus mr-2"></i> Novo Usuário
                    </button>
                </div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b flex flex-wrap justify-between items-center gap-4">
                        <div class="flex items-center flex-1 min-w-[200px]">
                            <input type="text" placeholder="Buscar usuário..."
                                class="border-gray-300 rounded-l-md shadow-sm focus:border-blue-500 focus:ring-blue-500 flex-1">
                            <button class="bg-gray-200 px-3 py-2 rounded-r-md border border-l-0 border-gray-300">
                                <i class="fas fa-search text-gray-500"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="mr-2">Total:
                                    <?php echo count($usuarios); ?>
                                </span>
                                <select
                                    class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <option>Ordenar por</option>
                                    <option>Mais recentes</option>
                                    <option>Mais antigos</option>
                                    <option>Nome (A-Z)</option>
                                    <option>Nome (Z-A)</option>
                                </select>
                            </div>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Usuário</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        CPF</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contato</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach($usuarios as $usuario): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="<?php echo !empty($usuario['Foto']) ? htmlspecialchars($usuario['Foto']) : 'https://via.placeholder.com/40'; ?>"
                                                    alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo htmlspecialchars($usuario['Nome']); ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <?php echo htmlspecialchars($usuario['Email']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($usuario['CPF']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($usuario['Celular']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                      <?php echo $usuario['StatusUsuario'] === 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo htmlspecialchars($usuario['StatusUsuario']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-500 hover:text-blue-700 action-btn mr-3"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700 action-btn mr-3" title="Excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="text-gray-500 hover:text-gray-700 action-btn"
                                            title="Ver detalhes">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Anterior </a>
                            <a href="#"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Próximo </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando <span class="font-medium">1</span> a <span class="font-medium">10</span>
                                    de <span class="font-medium">
                                        <?php echo count($usuarios); ?>
                                    </span> resultados
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                    aria-label="Pagination">
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Anterior</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" aria-current="page"
                                        class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        1 </a>
                                    <a href="#"
                                        class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        2 </a>
                                    <a href="#"
                                        class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        3 </a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Próximo</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aba Prestadores -->
            <div id="prestadores" class="tab-content">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Gerenciar Prestadores</h1>
                        <p class="text-gray-600">Lista de prestadores de serviço cadastrados</p>
                    </div>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 flex items-center">
                        <i class="fas fa-plus mr-2"></i> Novo Prestador
                    </button>
                </div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b flex flex-wrap justify-between items-center gap-4">
                        <div class="flex items-center flex-1 min-w-[200px]">
                            <input type="text" placeholder="Buscar prestador..."
                                class="border-gray-300 rounded-l-md shadow-sm focus:border-green-500 focus:ring-green-500 flex-1">
                            <button class="bg-gray-200 px-3 py-2 rounded-r-md border border-l-0 border-gray-300">
                                <i class="fas fa-search text-gray-500"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="mr-2">Total:
                                    <?php echo count($prestadores); ?>
                                </span>
                                <select
                                    class="border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                                    <option>Ordenar por</option>
                                    <option>Melhor avaliados</option>
                                    <option>Mais serviços</option>
                                    <option>Nome (A-Z)</option>
                                    <option>Nome (Z-A)</option>
                                </select>
                            </div>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prestador</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Serviços</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Avaliação</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach($prestadores as $prestador): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="<?php echo !empty($prestador['Foto']) ? htmlspecialchars($prestador['Foto']) : 'https://via.placeholder.com/40'; ?>"
                                                    alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo htmlspecialchars($prestador['Nome']); ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <?php echo htmlspecialchars($prestador['Email']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <?php echo htmlspecialchars($prestador['total_servicos']); ?> serviços
                                        </div>
                                        <div class="text-sm text-gray-500">R$
                                            <?php echo number_format($prestador['faturamento'], 2, ',', '.'); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-yellow-400">
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                <i
                                                    class="fas <?php echo $i < floor($prestador['avaliacao']) ? 'fa-star' : 'fa-star-half-alt'; ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="ml-1 text-sm text-gray-500">(
                                                <?php echo $prestador['total_avaliacoes']; ?>)
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                      <?php echo $prestador['StatusUsuario'] === 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo htmlspecialchars($prestador['StatusUsuario']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-500 hover:text-blue-700 action-btn mr-3"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700 action-btn mr-3" title="Excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="text-green-500 hover:text-green-700 action-btn"
                                            title="Ver serviços">
                                            <i class="fas fa-briefcase"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Anterior </a>
                            <a href="#"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Próximo </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando <span class="font-medium">1</span> a <span class="font-medium">10</span>
                                    de <span class="font-medium">
                                        <?php echo count($prestadores); ?>
                                    </span> resultados
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                    aria-label="Pagination">
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Anterior</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" aria-current="page"
                                        class="z-10 bg-green-50 border-green-500 text-green-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        1 </a>
                                    <a href="#"
                                        class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        2 </a>
                                    <a href="#"
                                        class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        3 </a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Próximo</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aba Serviços -->
            <div id="servicos" class="tab-content">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Gerenciar Serviços</h1>
                        <p class="text-gray-600">Lista de serviços cadastrados na plataforma</p>
                    </div>
                    <button class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 flex items-center">
                        <i class="fas fa-plus mr-2"></i> Novo Serviço
                    </button>
                </div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b flex flex-wrap justify-between items-center gap-4">
                        <div class="flex items-center flex-1 min-w-[200px]">
                            <input type="text" placeholder="Buscar serviço..."
                                class="border-gray-300 rounded-l-md shadow-sm focus:border-purple-500 focus:ring-purple-500 flex-1">
                            <button class="bg-gray-200 px-3 py-2 rounded-r-md border border-l-0 border-gray-300">
                                <i class="fas fa-search text-gray-500"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="mr-2">Total:
                                    <?php echo count($servicos); ?>
                                </span>
                                <select
                                    class="border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500 text-sm">
                                    <option>Ordenar por</option>
                                    <option>Mais recentes</option>
                                    <option>Mais antigos</option>
                                    <option>Maior valor</option>
                                    <option>Menor valor</option>
                                </select>
                            </div>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Serviço</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prestador</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Valor</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Favoritos</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach($servicos as $servico): ?>
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($servico['Titulo']); ?>
                                        </div>
                                        <div class="text-sm text-gray-500 truncate max-w-xs">
                                            <?php echo htmlspecialchars($servico['Sobre']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    src="<?php echo !empty($servico['prestador_foto']) ? htmlspecialchars($servico['prestador_foto']) : 'https://via.placeholder.com/32'; ?>"
                                                    alt="">
                                            </div>
                                            <div class="ml-2">
                                                <div class="text-sm text-gray-900">
                                                    <?php echo htmlspecialchars($servico['prestador']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        R$
                                        <?php echo number_format($servico['Valor'], 2, ',', '.'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($servico['QuantidadeFavorito']); ?>
                                        <i class="fas fa-heart text-red-400 ml-1"></i>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                      <?php echo $servico['StatusPublicacao'] === 'ativo' ? 'bg-green-100 text-green-800' : 
                             ($servico['StatusPublicacao'] === 'pendente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo htmlspecialchars($servico['StatusPublicacao']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-500 hover:text-blue-700 action-btn mr-3"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700 action-btn mr-3" title="Excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="text-purple-500 hover:text-purple-700 action-btn"
                                            title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Anterior </a>
                            <a href="#"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Próximo </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando <span class="font-medium">1</span> a <span class="font-medium">10</span>
                                    de <span class="font-medium">
                                        <?php echo count($servicos); ?>
                                    </span> resultados
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                    aria-label="Pagination">
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Anterior</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" aria-current="page"
                                        class="z-10 bg-purple-50 border-purple-500 text-purple-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        1 </a>
                                    <a href="#"
                                        class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        2 </a>
                                    <a href="#"
                                        class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                        3 </a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Próximo</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aba Meu Perfil -->
            <div id="perfil" class="tab-content">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <header class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Meu Perfil</h1>
                        <p class="text-gray-600">Gerencie suas informações pessoais e configurações</p>
                    </header>

                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Foto de perfil -->
                        <div class="md:w-1/3">
                            <div class="bg-gray-100 rounded-lg p-4 text-center">
                                <div
                                    class="mx-auto w-32 h-32 rounded-full overflow-hidden border-4 border-yellow-400 mb-4">
                                    <img src="<?php echo !empty($usuario['Foto']) ? htmlspecialchars($usuario['Foto']) : 'https://via.placeholder.com/128'; ?>"
                                        alt="Foto do perfil" class="w-full h-full object-cover">
                                </div>
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    <i class="fas fa-camera mr-2"></i> Alterar Foto
                                </button>
                            </div>
                        </div>

                        <!-- Formulário de edição -->
                        <div class="md:w-2/3">
                            <form>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                        <input type="text"
                                            value="<?php echo htmlspecialchars($usuario['Nome'] ?? ''); ?>"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                                        <input type="email"
                                            value="<?php echo htmlspecialchars($usuario['Email'] ?? ''); ?>"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                                    <input type="text" value="<?php echo htmlspecialchars($usuario['CPF'] ?? ''); ?>"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Celular</label>
                                    <input type="text"
                                        value="<?php echo htmlspecialchars($usuario['Celular'] ?? ''); ?>"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Data de
                                        Nascimento</label>
                                    <input type="date"
                                        value="<?php echo htmlspecialchars($usuario['DataNascimento'] ?? ''); ?>"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="button"
                                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 mr-3">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        <i class="fas fa-save mr-2"></i> Salvar Alterações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sistema de abas
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', function () {
                // Remove active de todas as abas e links
                document.querySelectorAll('.tab-link').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));

                // Adiciona active no link clicado
                this.classList.add('active');

                // Mostra o conteúdo correspondente
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Confirmação para exclusão
        document.querySelectorAll('[title="Excluir"]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                if (!confirm('Tem certeza que deseja excluir este item?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>