<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job4You ADM - Aprovações Pendentes</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            width: 250px;
            transition: all 0.3s;
        }
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar.active {
                width: 250px;
            }
            .main-content.active {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
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
                    <li class="px-4 py-3 bg-gray-700">
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

        <!-- Main Content -->
        <div class="main-content w-full">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center p-4">
                    <button id="menuToggle" class="md:hidden text-gray-700">
                        <i class="bi bi-list text-xl"></i>
                    </button>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">Olá, Admin</span>
                        <img src="https://via.placeholder.com/40" alt="Admin" class="w-8 h-8 rounded-full">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Aprovações Pendentes</h1>
                    
                    <!-- Abas -->
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="-mb-px flex space-x-8">
                            <button id="tabServicos" class="tab-button border-b-2 border-blue-500 text-blue-600 px-4 py-2 text-sm font-medium">
                                Serviços
                            </button>
                            <button id="tabPrestadores" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-4 py-2 text-sm font-medium">
                                Prestadores
                            </button>
                        </nav>
                    </div>
                    
                    <!-- Conteúdo da aba Serviços -->
                    <div id="servicosContent" class="tab-content">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium">Serviços Pendentes</h2>
                            <div class="relative w-full md:w-64">
                                <input type="text" id="searchServicos" placeholder="Buscar serviços..." 
                                       class="w-full border border-gray-300 rounded-md p-2 pl-8 text-sm">
                                <i class="bi bi-search absolute left-2 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        
                        <!-- Tabela de Serviços Pendentes -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Serviço
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Prestador
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Categoria
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Valor
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Data Cadastro
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="servicosPendentesTable" class="bg-white divide-y divide-gray-200">
                                    <!-- Dados serão carregados via JavaScript -->
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            Carregando serviços pendentes...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Conteúdo da aba Prestadores -->
                    <div id="prestadoresContent" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-medium">Prestadores Pendentes</h2>
                            <div class="relative w-full md:w-64">
                                <input type="text" id="searchPrestadores" placeholder="Buscar prestadores..." 
                                       class="w-full border border-gray-300 rounded-md p-2 pl-8 text-sm">
                                <i class="bi bi-search absolute left-2 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        
                        <!-- Tabela de Prestadores Pendentes -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Prestador
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            CPF
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Especialidade
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Data Cadastro
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Documentos
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="prestadoresPendentesTable" class="bg-white divide-y divide-gray-200">
                                    <!-- Dados serão carregados via JavaScript -->
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            Carregando prestadores pendentes...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal de Detalhes do Serviço -->
    <div id="servicoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Detalhes do Serviço</h3>
                <button id="closeServicoModalBtn" class="text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div id="servicoDetails">
                <!-- Conteúdo será preenchido via JavaScript -->
                <p>Carregando detalhes do serviço...</p>
            </div>
        </div>
    </div>

    <!-- Modal de Detalhes do Prestador -->
    <div id="prestadorModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Detalhes do Prestador</h3>
                <button id="closePrestadorModalBtn" class="text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div id="prestadorDetails">
                <!-- Conteúdo será preenchido via JavaScript -->
                <p>Carregando detalhes do prestador...</p>
            </div>
        </div>
    </div>

    <!-- Modal de Aprovação -->
    <div id="approvalModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold" id="approvalModalTitle">Aprovar Item</h3>
                <button id="closeApprovalModalBtn" class="text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div id="approvalModalContent">
                <p id="approvalText">Deseja aprovar este item?</p>
                <div class="mt-4 space-y-3">
                    <label for="approvalNotes" class="block text-sm font-medium text-gray-700">Observações (opcional)</label>
                    <textarea id="approvalNotes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm"></textarea>
                </div>
            </div>
            
            <div class="flex justify-end space-x-4 pt-6 border-t">
                <button type="button" id="cancelApprovalBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="button" id="confirmApprovalBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Confirmar
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript Separado -->
    <script src="admin_aprovacoes.js"></script>
</body>
</html>