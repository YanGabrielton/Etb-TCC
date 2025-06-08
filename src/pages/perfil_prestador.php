<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job4You - Meu Perfil</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* Estilos adicionais se necessário */
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .footer {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-gray-100">
<!-- Menu de Navegação Atualizado -->
<nav class="bg-gray-800 text-white px-4 py-3 shadow-md">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">
        <a class="text-2xl font-bold text-white hover:text-gray-300" href="/index.php">
            Job4You
        </a>

        <button class="md:hidden focus:outline-none text-white" type="button" id="mobile-menu-button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <div class="hidden w-full md:flex md:w-auto md:items-center" id="navbarNav">
            <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 items-center">
                <li>
                    <a class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium" 
                       href="/index.php">Home</a>
                </li>
                <li>
                    <a class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium" 
                       href="#">Sobre</a>
                </li>
                <li>
                    <a class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium" 
                       href="#">Meu Perfil</a>
                </li>
                
                <!-- Área do usuário logado -->
                <li class="flex items-center space-x-2">
                    <span class="text-white text-sm">Olá, <span id="userName" class="font-medium">Usuário</span></span>
                    <img id="profileImage" src="https://via.placeholder.com/32" alt="Foto do perfil" 
                         class="w-8 h-8 rounded-full border-2 border-blue-500 cursor-pointer">
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Conteúdo principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Coluna esquerda - Informações do perfil -->
            <div class="w-full md:w-1/3">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <!-- Foto de perfil e nome -->
                    <div class="flex flex-col items-center mb-6">
                        <img id="profileImageLarge" src="https://via.placeholder.com/150" alt="Foto do perfil" 
                             class="w-32 h-32 rounded-full mb-4 border-4 border-blue-500">
                        <h2 class="text-2xl font-bold" id="userFullName">Italo Vasconcelos</h2>
                        <p class="text-gray-600" id="userProfession">Prestador de Serviços</p>
                    </div>
                    
                    <!-- Informações pessoais -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informações Pessoais</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CPF</label>
                                <p class="mt-1 text-gray-900" id="userCPF">123.456.789-00</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                                <p class="mt-1 text-gray-900" id="userBirthDate">15/05/1990</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Celular</label>
                                <p class="mt-1 text-gray-900" id="userPhone">(11) 98765-4321</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Endereço -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Endereço</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CEP</label>
                                <p class="mt-1 text-gray-900" id="userCEP">01234-567</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Endereço</label>
                                <p class="mt-1 text-gray-900" id="userAddress">Rua Exemplo, 123 - Bairro, Cidade/SP</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contatos -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Contatos</h3>
                        <div class="space-y-3" id="userContacts">
                            <!-- Dinâmico - preenchido por JS -->
                        </div>
                    </div>
                    
                    <!-- Botão de edição -->
                    <button id="editProfileBtn" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                        Editar Perfil
                    </button>
                </div>
            </div>
            
            <!-- Coluna direita - Avaliações e serviços -->
            <div class="w-full md:w-2/3">
                <!-- Resumo de serviços -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Meus Serviços</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-blue-600" id="totalServices">5</p>
                            <p class="text-gray-600">Serviços Publicados</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-green-600" id="totalFavorites">12</p>
                            <p class="text-gray-600">Favoritados</p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg text-center">
                            <p class="text-3xl font-bold text-yellow-600" id="averageRating">4.8</p>
                            <p class="text-gray-600">Avaliação Média</p>
                        </div>
                    </div>
                </div>
                
                <!-- Avaliações recebidas -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Avaliações Recebidas</h3>
                    <div class="space-y-4" id="userReviews">
                        <!-- Dinâmico - preenchido por JS -->
                        <div class="border-b pb-4 mb-4">
                            <p class="text-gray-500 italic">Carregando avaliações...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de edição de perfil -->
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Editar Perfil</h3>
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <form id="profileForm" class="space-y-4">
                <!-- Seção de foto -->
                <div class="flex flex-col items-center mb-6">
                    <img id="profileImageEdit" src="https://via.placeholder.com/150" alt="Foto do perfil" 
                         class="w-32 h-32 rounded-full mb-4 border-4 border-blue-500 cursor-pointer">
                    <input type="file" id="profileImageInput" accept="image/*" class="hidden">
                    <button type="button" id="changePhotoBtn" class="text-blue-600 hover:text-blue-800 text-sm">
                        Alterar foto
                    </button>
                </div>
                
                <!-- Informações básicas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="editName" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                        <input type="text" id="editName" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>
                    <div>
                        <label for="editCPF" class="block text-sm font-medium text-gray-700">CPF</label>
                        <input type="text" id="editCPF" class="mt-1 block w-full border border-gray-300 rounded-md p-2" disabled>
                    </div>
                    <div>
                        <label for="editBirthDate" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                        <input type="date" id="editBirthDate" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>
                    <div>
                        <label for="editPhone" class="block text-sm font-medium text-gray-700">Celular</label>
                        <input type="tel" id="editPhone" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>
                </div>
                
                <!-- Endereço -->
                <div class="pt-4 border-t">
                    <h4 class="text-lg font-medium mb-4">Endereço</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="editCEP" class="block text-sm font-medium text-gray-700">CEP</label>
                            <input type="text" id="editCEP" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>
                        <div class="md:col-span-2">
                            <label for="editStreet" class="block text-sm font-medium text-gray-700">Rua</label>
                            <input type="text" id="editStreet" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>
                        <div>
                            <label for="editNeighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                            <input type="text" id="editNeighborhood" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>
                        <div>
                            <label for="editCity" class="block text-sm font-medium text-gray-700">Cidade</label>
                            <input type="text" id="editCity" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>
                        <div>
                            <label for="editState" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select id="editState" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                                <option value="">Selecione</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <!-- Outros estados... -->
                                <option value="SP" selected>São Paulo</option>
                                <!-- Todos os estados brasileiros -->
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Contatos -->
                <div class="pt-4 border-t">
                    <h4 class="text-lg font-medium mb-4">Contatos</h4>
                    <div id="contactFields" class="space-y-4">
                        <!-- Dinâmico - preenchido por JS -->
                    </div>
                    <button type="button" id="addContactBtn" class="mt-2 text-blue-600 hover:text-blue-800 text-sm flex items-center">
                        <i class="bi bi-plus-circle mr-1"></i> Adicionar Contato
                    </button>
                </div>
                
                <!-- Botões de ação -->
                <div class="flex justify-end space-x-4 pt-4 border-t">
                    <button type="button" id="cancelEditBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-0">© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript Externo -->
    <script src="profile.js"></script>
</body>
</html>