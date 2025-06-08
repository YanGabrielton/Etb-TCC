/**
 * admin_servicos.js - Funcionalidades da página de listagem de serviços
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const servicosTableBody = document.getElementById('servicosTableBody');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const prevPageBtn = document.getElementById('prevPage');
    const nextPageBtn = document.getElementById('nextPage');
    const startItem = document.getElementById('startItem');
    const endItem = document.getElementById('endItem');
    const totalItems = document.getElementById('totalItems');
    const servicoModal = document.getElementById('servicoModal');
    const closeModalBtns = document.querySelectorAll('[id^="closeModalBtn"]');
    const servicoDetails = document.getElementById('servicoDetails');
    const approvalModal = document.getElementById('approvalModal');
    const closeApprovalModalBtn = document.getElementById('closeApprovalModalBtn');
    const cancelApprovalBtn = document.getElementById('cancelApprovalBtn');
    const confirmApprovalBtn = document.getElementById('confirmApprovalBtn');
    const approvalText = document.getElementById('approvalText');
    const approvalNotes = document.getElementById('approvalNotes');

    // Variáveis de estado
    let currentPage = 1;
    const itemsPerPage = 10;
    let allServicos = [];
    let filteredServicos = [];
    let currentServicoId = null;
    let currentAction = 'approve'; // 'approve' or 'reject'

    // Toggle do menu mobile
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('active');
    });

    // Fechar modais
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            servicoModal.classList.add('hidden');
        });
    });

    closeApprovalModalBtn.addEventListener('click', function() {
        approvalModal.classList.add('hidden');
    });

    cancelApprovalBtn.addEventListener('click', function() {
        approvalModal.classList.add('hidden');
    });

    // Simular dados (substituir por chamada AJAX para o PHP)
    function fetchServicos() {
        // Simular delay de requisição
        setTimeout(() => {
            // Dados mockados baseados no modelo do banco
            allServicos = [
                {
                    id: 1,
                    titulo: "Reparo Hidráulico Residencial",
                    descricao: "Reparo em vazamentos e troca de peças hidráulicas em residências",
                    prestador: {
                        id: 1,
                        nome: "João Silva",
                        foto: "https://via.placeholder.com/150"
                    },
                    categoria: "Encanamento",
                    valor: 150.00,
                    avaliacao: 4.5,
                    status: "Ativo",
                    dataCriacao: "2025-05-10",
                    dataAtualizacao: "2025-06-01",
                    favoritos: 12,
                    fotos: [
                        "https://via.placeholder.com/400x300?text=Serviço+1",
                        "https://via.placeholder.com/400x300?text=Serviço+2"
                    ]
                },
                {
                    id: 2,
                    titulo: "Instalação Elétrica",
                    descricao: "Instalação e manutenção de circuitos elétricos",
                    prestador: {
                        id: 2,
                        nome: "Carlos Souza",
                        foto: "https://via.placeholder.com/150"
                    },
                    categoria: "Elétrica",
                    valor: 200.00,
                    avaliacao: 4.8,
                    status: "Ativo",
                    dataCriacao: "2025-05-15",
                    dataAtualizacao: "2025-05-20",
                    favoritos: 8,
                    fotos: [
                        "https://via.placeholder.com/400x300?text=Serviço+3"
                    ]
                },
                {
                    id: 3,
                    titulo: "Limpeza Pós-Obra",
                    descricao: "Limpeza completa após reformas e construções",
                    prestador: {
                        id: 3,
                        nome: "Maria Oliveira",
                        foto: "https://via.placeholder.com/150"
                    },
                    categoria: "Limpeza",
                    valor: 180.00,
                    avaliacao: 4.2,
                    status: "Pendente",
                    dataCriacao: "2025-06-05",
                    dataAtualizacao: "2025-06-05",
                    favoritos: 0,
                    fotos: []
                }
            ];
            
            filteredServicos = [...allServicos];
            renderServicos();
            updatePagination();
        }, 500);
    }

    // Renderizar serviços na tabela
    function renderServicos() {
        if (filteredServicos.length === 0) {
            servicosTableBody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                        Nenhum serviço encontrado
                    </td>
                </tr>
            `;
            return;
        }

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const servicosToShow = filteredServicos.slice(start, end);

        servicosTableBody.innerHTML = servicosToShow.map(servico => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${servico.id}
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">${servico.titulo}</div>
                    <div class="text-sm text-gray-500 truncate max-w-xs">${servico.descricao}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="${servico.prestador.foto}" alt="${servico.prestador.nome}">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${servico.prestador.nome}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${servico.categoria}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    R$ ${servico.valor.toFixed(2)}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        ${renderStars(servico.avaliacao)}
                        <span class="ml-1 text-sm text-gray-500">(${servico.avaliacao})</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        ${servico.status === 'Ativo' ? 'bg-green-100 text-green-800' : 
                          servico.status === 'Inativo' ? 'bg-red-100 text-red-800' : 
                          servico.status === 'Pendente' ? 'bg-yellow-100 text-yellow-800' :
                          'bg-gray-100 text-gray-800'}">
                        ${servico.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3 view-servico" data-id="${servico.id}">Ver</button>
                    ${servico.status === 'Pendente' ? `
                        <button class="text-green-600 hover:text-green-900 mr-3 approve-servico" data-id="${servico.id}">Aprovar</button>
                        <button class="text-red-600 hover:text-red-900 reject-servico" data-id="${servico.id}">Rejeitar</button>
                    ` : `
                        <button class="text-indigo-600 hover:text-indigo-900 edit-servico" data-id="${servico.id}">Editar</button>
                    `}
                </td>
            </tr>
        `).join('');

        // Adicionar eventos aos botões
        document.querySelectorAll('.view-servico').forEach(btn => {
            btn.addEventListener('click', function() {
                const servicoId = this.getAttribute('data-id');
                showServicoDetails(servicoId);
            });
        });

        document.querySelectorAll('.approve-servico').forEach(btn => {
            btn.addEventListener('click', function() {
                const servicoId = this.getAttribute('data-id');
                openApprovalModal(servicoId, 'approve');
            });
        });

        document.querySelectorAll('.reject-servico').forEach(btn => {
            btn.addEventListener('click', function() {
                const servicoId = this.getAttribute('data-id');
                openApprovalModal(servicoId, 'reject');
            });
        });

        document.querySelectorAll('.edit-servico').forEach(btn => {
            btn.addEventListener('click', function() {
                const servicoId = this.getAttribute('data-id');
                editServico(servicoId);
            });
        });
    }

    // Renderizar estrelas de avaliação
    function renderStars(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 >= 0.5;
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        
        let stars = '';
        
        for (let i = 0; i < fullStars; i++) {
            stars += '<i class="bi bi-star-fill text-yellow-400"></i>';
        }
        
        if (hasHalfStar) {
            stars += '<i class="bi bi-star-half text-yellow-400"></i>';
        }
        
        for (let i = 0; i < emptyStars; i++) {
            stars += '<i class="bi bi-star text-yellow-400"></i>';
        }
        
        return stars;
    }

    // Mostrar detalhes do serviço
    function showServicoDetails(servicoId) {
        const servico = allServicos.find(s => s.id == servicoId);
        if (!servico) return;

        servicoDetails.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <h4 class="text-lg font-medium mb-2">Informações Básicas</h4>
                    <div class="space-y-2">
                        <p><strong>ID:</strong> ${servico.id}</p>
                        <p><strong>Título:</strong> ${servico.titulo}</p>
                        <p><strong>Descrição:</strong> ${servico.descricao}</p>
                        <p><strong>Categoria:</strong> ${servico.categoria}</p>
                        <p><strong>Valor:</strong> R$ ${servico.valor.toFixed(2)}</p>
                        <p><strong>Favoritos:</strong> ${servico.favoritos}</p>
                        <p><strong>Status:</strong> <span class="${servico.status === 'Ativo' ? 'text-green-600' : 
                            servico.status === 'Inativo' ? 'text-red-600' : 'text-yellow-600'}">${servico.status}</span></p>
                        <p><strong>Data Criação:</strong> ${new Date(servico.dataCriacao).toLocaleDateString('pt-BR')}</p>
                        <p><strong>Última Atualização:</strong> ${new Date(servico.dataAtualizacao).toLocaleDateString('pt-BR')}</p>
                    </div>
                    
                    <h4 class="text-lg font-medium mt-6 mb-2">Prestador</h4>
                    <div class="flex items-center">
                        <img src="${servico.prestador.foto}" alt="${servico.prestador.nome}" class="w-12 h-12 rounded-full mr-3">
                        <div>
                            <p class="font-medium">${servico.prestador.nome}</p>
                            <p class="text-sm text-gray-600">ID: ${servico.prestador.id}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-lg font-medium mb-2">Fotos do Serviço</h4>
                    ${servico.fotos.length > 0 ? `
                        <div class="grid grid-cols-2 gap-2">
                            ${servico.fotos.map(foto => `
                                <img src="${foto}" alt="Foto do serviço" class="rounded-md border border-gray-200">
                            `).join('')}
                        </div>
                    ` : `
                        <p class="text-gray-500">Nenhuma foto disponível</p>
                    `}
                    
                    <h4 class="text-lg font-medium mt-6 mb-2">Avaliação</h4>
                    <div class="flex items-center">
                        ${renderStars(servico.avaliacao)}
                        <span class="ml-2 text-gray-700">${servico.avaliacao} (média)</span>
                    </div>
                </div>
            </div>
        `;

        servicoModal.classList.remove('hidden');
    }

    // Abrir modal de aprovação/rejeição
    function openApprovalModal(servicoId, action) {
        const servico = allServicos.find(s => s.id == servicoId);
        if (!servico) return;

        currentServicoId = servicoId;
        currentAction = action;

        if (action === 'approve') {
            approvalText.textContent = `Deseja aprovar o serviço "${servico.titulo}"?`;
            confirmApprovalBtn.textContent = 'Aprovar';
            confirmApprovalBtn.className = 'px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700';
        } else {
            approvalText.textContent = `Deseja rejeitar o serviço "${servico.titulo}"?`;
            confirmApprovalBtn.textContent = 'Rejeitar';
            confirmApprovalBtn.className = 'px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700';
        }

        approvalNotes.value = '';
        approvalModal.classList.remove('hidden');
    }

    // Confirmar aprovação/rejeição
    confirmApprovalBtn.addEventListener('click', function() {
        // Aqui você faria a chamada AJAX para o PHP para atualizar o status
        const notes = approvalNotes.value;
        
        // Simular atualização
        const servicoIndex = allServicos.findIndex(s => s.id == currentServicoId);
        if (servicoIndex !== -1) {
            allServicos[servicoIndex].status = currentAction === 'approve' ? 'Ativo' : 'Rejeitado';
            allServicos[servicoIndex].dataAtualizacao = new Date().toISOString().split('T')[0];
            renderServicos();
        }
        
        approvalModal.classList.add('hidden');
        alert(`Serviço ${currentAction === 'approve' ? 'aprovado' : 'rejeitado'} com sucesso!`);
    });

    // Editar serviço
    function editServico(servicoId) {
        // Implementar lógica de edição
        alert(`Editar serviço ID: ${servicoId}`);
    }

    // Filtrar serviços
    function filterServicos() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilterValue = statusFilter.value;
        const categoryFilterValue = categoryFilter.value;

        filteredServicos = allServicos.filter(servico => {
            const matchesSearch = servico.titulo.toLowerCase().includes(searchTerm) || 
                                servico.descricao.toLowerCase().includes(searchTerm) ||
                                servico.prestador.nome.toLowerCase().includes(searchTerm);
            
            const matchesStatus = statusFilterValue === 'all' || 
                                (statusFilterValue === 'active' && servico.status === 'Ativo') ||
                                (statusFilterValue === 'inactive' && servico.status === 'Inativo') ||
                                (statusFilterValue === 'pending' && servico.status === 'Pendente');
            
            const matchesCategory = categoryFilterValue === 'all' || 
                                 servico.categoria.toLowerCase() === categoryFilterValue.toLowerCase();
            
            return matchesSearch && matchesStatus && matchesCategory;
        });

        currentPage = 1;
        renderServicos();
        updatePagination();
    }

    // Atualizar paginação
    function updatePagination() {
        const total = filteredServicos.length;
        const start = (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, total);

        startItem.textContent = start;
        endItem.textContent = end;
        totalItems.textContent = total;

        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = end >= total;
    }

    // Event Listeners
    searchInput.addEventListener('input', filterServicos);
    statusFilter.addEventListener('change', filterServicos);
    categoryFilter.addEventListener('change', filterServicos);
    prevPageBtn.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderServicos();
            updatePagination();
        }
    });
    nextPageBtn.addEventListener('click', function() {
        if (currentPage * itemsPerPage < filteredServicos.length) {
            currentPage++;
            renderServicos();
            updatePagination();
        }
    });

    // Inicializar
    fetchServicos();
});