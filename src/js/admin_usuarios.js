/**
 * admin_usuarios.js - Funcionalidades da página de listagem de usuários
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const usersTableBody = document.getElementById('usersTableBody');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const prevPageBtn = document.getElementById('prevPage');
    const nextPageBtn = document.getElementById('nextPage');
    const startItem = document.getElementById('startItem');
    const endItem = document.getElementById('endItem');
    const totalItems = document.getElementById('totalItems');
    const userModal = document.getElementById('userModal');
    const closeModalBtns = document.querySelectorAll('[id^="closeModalBtn"]');
    const userDetails = document.getElementById('userDetails');

    // Variáveis de estado
    let currentPage = 1;
    const itemsPerPage = 10;
    let allUsers = [];
    let filteredUsers = [];

    // Toggle do menu mobile
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('active');
    });

    // Fechar modal
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            userModal.classList.add('hidden');
        });
    });

    // Simular dados (substituir por chamada AJAX para o PHP)
    function fetchUsers() {
        // Simular delay de requisição
        setTimeout(() => {
            // Dados mockados baseados no modelo do banco
            allUsers = [
                {
                    id: 1,
                    nome: "João Silva",
                    cpf: "123.456.789-00",
                    email: "joao@email.com",
                    celular: "(11) 98765-4321",
                    status: "Ativo",
                    dataNascimento: "1990-05-15",
                    endereco: {
                        cep: "01234-567",
                        estado: "SP",
                        cidade: "São Paulo",
                        bairro: "Centro",
                        rua: "Rua Exemplo, 123"
                    },
                    foto: "https://via.placeholder.com/150"
                },
                // Adicione mais usuários conforme necessário
            ];
            
            filteredUsers = [...allUsers];
            renderUsers();
            updatePagination();
        }, 500);
    }

    // Renderizar usuários na tabela
    function renderUsers() {
        if (filteredUsers.length === 0) {
            usersTableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Nenhum usuário encontrado
                    </td>
                </tr>
            `;
            return;
        }

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const usersToShow = filteredUsers.slice(start, end);

        usersTableBody.innerHTML = usersToShow.map(user => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${user.id}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="${user.foto}" alt="${user.nome}">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${user.nome}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${user.cpf}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${user.email}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${user.celular}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        ${user.status === 'Ativo' ? 'bg-green-100 text-green-800' : 
                          user.status === 'Inativo' ? 'bg-red-100 text-red-800' : 
                          'bg-yellow-100 text-yellow-800'}">
                        ${user.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3 view-user" data-id="${user.id}">Ver</button>
                    <button class="text-indigo-600 hover:text-indigo-900 edit-user" data-id="${user.id}">Editar</button>
                </td>
            </tr>
        `).join('');

        // Adicionar eventos aos botões
        document.querySelectorAll('.view-user').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                showUserDetails(userId);
            });
        });

        document.querySelectorAll('.edit-user').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                editUser(userId);
            });
        });
    }

    // Mostrar detalhes do usuário
    function showUserDetails(userId) {
        const user = allUsers.find(u => u.id == userId);
        if (!user) return;

        userDetails.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 flex flex-col items-center">
                    <img src="${user.foto}" alt="${user.nome}" class="w-32 h-32 rounded-full mb-4">
                    <h4 class="text-lg font-bold">${user.nome}</h4>
                    <p class="text-gray-600">ID: ${user.id}</p>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-lg font-medium mb-2">Informações Básicas</h4>
                    <div class="space-y-2">
                        <p><strong>CPF:</strong> ${user.cpf}</p>
                        <p><strong>Email:</strong> ${user.email}</p>
                        <p><strong>Celular:</strong> ${user.celular}</p>
                        <p><strong>Data Nasc.:</strong> ${new Date(user.dataNascimento).toLocaleDateString('pt-BR')}</p>
                        <p><strong>Status:</strong> <span class="${user.status === 'Ativo' ? 'text-green-600' : 'text-red-600'}">${user.status}</span></p>
                    </div>
                </div>
                
                <div class="col-span-1 md:col-span-2">
                    <h4 class="text-lg font-medium mb-2">Endereço</h4>
                    <div class="space-y-2">
                        <p><strong>CEP:</strong> ${user.endereco.cep}</p>
                        <p><strong>Endereço:</strong> ${user.endereco.rua}, ${user.endereco.bairro}</p>
                        <p><strong>Cidade/UF:</strong> ${user.endereco.cidade}/${user.endereco.estado}</p>
                    </div>
                </div>
            </div>
        `;

        userModal.classList.remove('hidden');
    }

    // Editar usuário
    function editUser(userId) {
        // Implementar lógica de edição
        alert(`Editar usuário ID: ${userId}`);
    }

    // Filtrar usuários
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilterValue = statusFilter.value;

        filteredUsers = allUsers.filter(user => {
            const matchesSearch = user.nome.toLowerCase().includes(searchTerm) || 
                                user.email.toLowerCase().includes(searchTerm) ||
                                user.cpf.includes(searchTerm);
            
            const matchesStatus = statusFilterValue === 'all' || 
                                (statusFilterValue === 'active' && user.status === 'Ativo') ||
                                (statusFilterValue === 'inactive' && user.status === 'Inativo') ||
                                (statusFilterValue === 'pending' && user.status === 'Pendente');
            
            return matchesSearch && matchesStatus;
        });

        currentPage = 1;
        renderUsers();
        updatePagination();
    }

    // Atualizar paginação
    function updatePagination() {
        const total = filteredUsers.length;
        const start = (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, total);

        startItem.textContent = start;
        endItem.textContent = end;
        totalItems.textContent = total;

        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = end >= total;
    }

    // Event Listeners
    searchInput.addEventListener('input', filterUsers);
    statusFilter.addEventListener('change', filterUsers);
    prevPageBtn.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderUsers();
            updatePagination();
        }
    });
    nextPageBtn.addEventListener('click', function() {
        if (currentPage * itemsPerPage < filteredUsers.length) {
            currentPage++;
            renderUsers();
            updatePagination();
        }
    });

    // Inicializar
    fetchUsers();
});