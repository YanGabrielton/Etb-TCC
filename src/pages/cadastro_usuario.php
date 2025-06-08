<?php
session_start();
include '../backend/config/ConexaoBanco.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro | Job4You</title>

    <!-- CSS global -->
    <link rel="stylesheet" href="/src/css/global.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuração personalizada do Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#F59E0B', // Amarelo principal
                            600: '#D97706', // Tom mais escuro
                        },
                        dark: {
                            800: '#1F2937', // Tom escuro do menu
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Fonte Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans flex flex-col min-h-screen">

    <!-- MENU DE NAVEGAÇÃO-->
    <nav class="bg-dark-800 py-4 px-6 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- LOGO -->
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors" href="index.php">Job4You</a>

            <!-- LINKS DO MENU (versão desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="#">Sobre Nós</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors" href="./src/pages/login.php">Login</a>
            </div>

            <!-- BOTÃO HAMBÚRGUER (para mobile) -->
            <button class="md:hidden text-white focus:outline-none" id="menuButton">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- MENU MOBILE (invisível até clicar) -->
        <div class="md:hidden hidden mt-4 space-y-3 bg-dark-900 rounded-lg p-4" id="mobileMenu">
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="index.php">Home</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="#">Sobre</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="/src/pages/cadastro_usuario.php">Cadastre-se</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2" href="./src/pages/login.php">Login</a>
        </div>
    </nav>

    <!-- FORMULÁRIO DE CADASTRO -->
    <main class="flex-grow py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-8 sm:p-10">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Cadastro de Usuário</h2>
                        <p class="mt-2 text-gray-600">Preencha o formulário para criar sua conta</p>
                    </div>

                    <form action="../backend/includes/processa_cadastra_usuario.php" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome Completo -->
                            <div class="col-span-2">
                                <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-person text-gray-400"></i>
                                    </div>
                                    <input type="text" id="nome" name="nome" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Digite seu nome completo">
                                </div>
                            </div>

                            <!-- CPF -->
                            <div>
                                <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-card-text text-gray-400"></i>
                                    </div>
                                    <input type="text" id="cpf" name="cpf" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="000.000.000-00">
                                </div>
                            </div>

                            <!-- Data de Nascimento -->
                            <div>
                                <label for="data_nascimento" class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" id="data_nascimento" name="data_nascimento" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" id="email" name="email" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="seu@email.com">
                                </div>
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-telephone text-gray-400"></i>
                                    </div>
                                    <input type="text" id="telefone" name="telefone" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="(00) 00000-0000">
                                </div>
                            </div>

                            <!-- Senha -->
                            <div>
                                <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" id="senha" name="senha" required
                                        class="py-2 pl-10 pr-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Crie uma senha">
                                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <i class="bi bi-eye text-gray-400 hover:text-gray-500"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- CEP -->
                            <div>
                                <label for="cep" class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-mailbox text-gray-400"></i>
                                    </div>
                                    <input type="text" id="cep" name="cep" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="00000-000">
                                </div>
                            </div>

                            <!-- Estado -->
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-map text-gray-400"></i>
                                    </div>
                                    <select id="estado" name="estado" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                                        <option value="" selected disabled>Selecione</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <!-- Adicione todos os estados -->
                                    </select>
                                </div>
                            </div>

                            <!-- Cidade -->
                            <div>
                                <label for="cidade" class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-building text-gray-400"></i>
                                    </div>
                                    <input type="text" id="cidade" name="cidade" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Sua cidade">
                                </div>
                            </div>

                            <!-- Bairro -->
                            <div>
                                <label for="bairro" class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-pin-map text-gray-400"></i>
                                    </div>
                                    <input type="text" id="bairro" name="bairro" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Seu bairro">
                                </div>
                            </div>

                            <!-- Rua -->
                            <div>
                                <label for="rua" class="block text-sm font-medium text-gray-700 mb-1">Rua</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-signpost text-gray-400"></i>
                                    </div>
                                    <input type="text" id="rua" name="rua" required
                                        class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Sua rua">
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 px-4 rounded-md font-medium transition-colors">
                                <i class="bi bi-person-plus mr-2"></i> Cadastrar
                            </button>
                        </div>

                        <div class="text-center text-sm text-gray-600">
                            Já tem uma conta? <a href="login.php" class="text-primary-500 hover:text-primary-600 font-medium">Faça login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- RODAPÉ FIXO -->
    <footer class="bg-dark-800 py-6 text-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>© 2025 Job4You - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- SCRIPT JS INTEGRADO (menu hamburguer responsivo) -->
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden'); // Mostra ou esconde o menu mobile
        });
    </script>

</body>
</html>
