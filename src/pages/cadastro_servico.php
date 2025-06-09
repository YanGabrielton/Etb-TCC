<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["id_usuario"])) {
    header("Location: cadastro_servico.php");
    exit;
}

include '../backend/config/ConexaoBanco.php';

$database = new DataBase();
$conexao = $database->getConnection();

// Buscar dados do usuário logado
$id_usuario = $_SESSION["id_usuario"];
$sql = "SELECT u.Nome, u.CPF, u.Celular, u.DataNascimento, 
               e.CEP, e.Estado, e.Cidade, e.Bairro, e.Rua,
               c.Email
        FROM Usuario u
        JOIN Credencial c ON u.FKCredencial = c.ID
        LEFT JOIN Endereco e ON u.FKEndereco = e.ID
        WHERE u.ID = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$stmt->close();

// Buscar categorias para o select
$categorias = $conexao->query("SELECT ID, Nome FROM CategoriaServico");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Serviço | Job4You</title>

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
            <a class="text-2xl font-bold text-white hover:text-primary-500 transition-colors"
                href="index.php">Job4You</a>

            <!-- LINKS DO MENU -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-gray-300 hover:text-white transition-colors" href="index.php">Home</a>
                <a class="text-gray-300 hover:text-white transition-colors" href="#">Sobre Nós</a>
                <a class="bg-primary-500 hover:bg-primary-600 text-white px-6 py-2 rounded-full font-medium transition-colors"
                    href="../backend/includes/logout.php">Sair</a>
            </div>

            <!-- BOTÃO HAMBÚRGUER (para mobile) -->
            <button class="md:hidden text-white focus:outline-none" id="menuButton">
                <i class="bi bi-list text-2xl"></i>
            </button>
        </div>

        <!-- MENU MOBILE -->
        <div class="md:hidden hidden mt-4 space-y-3 bg-dark-900 rounded-lg p-4" id="mobileMenu">
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="index.php">Home</a>
            <a class="block text-gray-300 hover:text-white px-3 py-2" href="#">Sobre</a>
            <a class="block bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded text-center mt-2"
                href="../backend/includes/logout.php">Sair</a>
        </div>
    </nav>

    <!-- FORMULÁRIO DE CADASTRO DE SERVIÇO -->
    <main class="flex-grow py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-8 sm:p-10">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Cadastro de Serviço</h2>
                        <p class="mt-2 text-gray-600">Preencha os dados do serviço que deseja oferecer</p>
                    </div>

                    <form action="../backend/includes/processa_cadastra_servico.php" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        <!-- Seção: Dados Pessoais (somente leitura) -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <i class="bi bi-person-circle mr-2"></i> Dados Pessoais
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nome -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-person text-gray-400"></i>
                                        </div>
                                        <input type="text" value="<?= htmlspecialchars($usuario['Nome'] ?? '') ?>"
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md bg-gray-100"
                                            readonly>
                                    </div>
                                </div>

                                <!-- CPF -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-card-text text-gray-400"></i>
                                        </div>
                                        <input type="text" value="<?= htmlspecialchars($usuario['CPF'] ?? '') ?>"
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md bg-gray-100"
                                            readonly>
                                    </div>
                                </div>

<<<<<<< Updated upstream
                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-envelope text-gray-400"></i>
                                        </div>
                                        <input type="text" value="<?= htmlspecialchars($usuario['Email'] ?? '') ?>"
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md bg-gray-100"
                                            readonly>
                                    </div>
                                </div>
=======
      <div class="d-grid mt-4">
          <button type="submit" class="btn btn-login bg-black text-white">Cadastrar Serviço</button>
      </div>
    </form>
  </main>
>>>>>>> Stashed changes

                                <!-- Telefone -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-telephone text-gray-400"></i>
                                        </div>
                                        <input type="text" value="<?= htmlspecialchars($usuario['Celular'] ?? '') ?>"
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md bg-gray-100"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Seção: Dados do Serviço -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <i class="bi bi-tools mr-2"></i> Dados do Serviço
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Categoria -->
                                <div class="col-span-2 md:col-span-1">
                                    <label for="categoria"
                                        class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-grid text-gray-400"></i>
                                        </div>
                                        <select id="categoria" name="categoria" required
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                                            <option value="" selected disabled>Selecione</option>
                                            <?php while($categoria = $categorias->fetch_assoc()): ?>
                                            <option value="<?= $categoria['ID'] ?>">
                                                <?= $categoria['Nome'] ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Preço -->
                                <div class="col-span-2 md:col-span-1">
                                    <label for="preco" class="block text-sm font-medium text-gray-700 mb-1">Preço
                                        (R$)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-currency-dollar text-gray-400"></i>
                                        </div>
                                        <input type="number" step="0.01" id="preco" name="preco" required
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="Ex: 99.90">
                                    </div>
                                </div>

                                <!-- Título -->
                                <div class="col-span-2">
                                    <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título do
                                        Serviço</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-card-heading text-gray-400"></i>
                                        </div>
                                        <input type="text" id="titulo" name="titulo" required
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="Ex: Encanador Residencial">
                                    </div>
                                </div>

                                <!-- Foto (Opcional) -->
                                <div class="col-span-2">
                                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto do
                                        Serviço (Opcional)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-image text-gray-400"></i>
                                        </div>
                                        <input type="file" id="foto" name="foto"
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>

                                <!-- Descrição -->
                                <div class="col-span-2">
                                    <label for="descricao"
                                        class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3">
                                            <i class="bi bi-text-paragraph text-gray-400"></i>
                                        </div>
                                        <textarea id="descricao" name="descricao" rows="4" required
                                            class="py-2 pl-10 block w-full border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="Descreva detalhadamente seu serviço..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botão de Cadastro -->
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-primary-500 hover:bg-primary-600 text-white py-3 px-4 rounded-md font-medium transition-colors">
                                <i class="bi bi-check-circle mr-2"></i> Cadastrar Serviço
                            </button>
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
        document.getElementById('menuButton').addEventListener('click', function () {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>