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
</head>
<body class="bg-gray-100">
    <!-- Menu de Navegação -->
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

    <!-- Conteúdo Principal - Formulário Centralizado -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Cabeçalho do Formulário -->
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-bold">Meu Perfil</h2>
                <p class="text-gray-300 text-sm">Gerencie suas informações pessoais</p>
            </div>
            
            <!-- Corpo do Formulário -->
            <form method="POST" action="atualizar_perfil.php" class="p-6 space-y-6" enctype="multipart/form-data">
                <!-- Seção de Foto de Perfil -->
                <div class="flex flex-col items-center">
                    <img id="profileImageLarge" src="https://via.placeholder.com/150" alt="Foto do perfil" 
                         class="w-32 h-32 rounded-full mb-4 border-4 border-blue-500">
                    <input type="file" id="profileImageInput" name="foto_perfil" accept="image/*" class="hidden">
                    <button type="button" id="changePhotoBtn" class="text-blue-600 hover:text-blue-800 text-sm">
                        Alterar foto
                    </button>
                </div>
                
                <!-- Informações Pessoais -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome Completo -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                        <input type="text" id="nome" name="nome" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                    </div>
                    
                    <!-- CPF -->
                    <div>
                        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                        <input type="text" id="cpf" name="cpf" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" disabled>
                    </div>
                    
                    <!-- Data de Nascimento -->
                    <div>
                        <label for="dataNascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                        <input type="date" id="dataNascimento" name="dataNascimento" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                    </div>
                    
                    <!-- Celular -->
                    <div>
                        <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                        <input type="tel" id="celular" name="celular" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                    </div>
                    
                    <!-- Email (da tabela Credencial) -->
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                    </div>
                </div>
                
                <!-- Endereço -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium mb-4">Endereço</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- CEP -->
                        <div>
                            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                            <input type="text" id="cep" name="cep" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                        </div>
                        
                        <!-- Estado -->
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select id="estado" name="estado" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                                <option value="">Selecione</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <!-- Todos os estados brasileiros -->
                            </select>
                        </div>
                        
                        <!-- Cidade -->
                        <div>
                            <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                            <input type="text" id="cidade" name="cidade" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                        </div>
                        
                        <!-- Bairro -->
                        <div>
                            <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                        </div>
                        
                        <!-- Rua -->
                        <div class="md:col-span-2">
                            <label for="rua" class="block text-sm font-medium text-gray-700">Rua</label>
                            <input type="text" id="rua" name="rua" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm" required>
                        </div>
                    </div>
                </div>
                
                <!-- Contatos (da tabela InformacaoContato) -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium mb-4">Contatos Adicionais</h3>
                    <div id="contatosContainer" class="space-y-4">
                        <!-- Contatos serão adicionados dinamicamente aqui -->
                    </div>
                    <button type="button" id="adicionarContatoBtn" class="mt-4 text-blue-600 hover:text-blue-800 text-sm flex items-center">
                        <i class="bi bi-plus-circle mr-1"></i> Adicionar Contato
                    </button>
                    <input type="hidden" id="contatosData" name="contatos">
                </div>
                
                <!-- Botões de Ação -->
                <div class="flex justify-end space-x-4 border-t pt-6">
                    <button type="button" id="cancelarBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" id="salvarBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript Separado -->
    <script src="perfil.js"></script>
</body>
</html>