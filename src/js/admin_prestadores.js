/**
 * admin_prestadores.js - Funcionalidades da página de listagem de prestadores
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const prestadoresTableBody = document.getElementById('prestadoresTableBody');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const prevPageBtn = document.getElementById('prevPage');
    const nextPageBtn = document.getElementById('nextPage');
    const startItem = document.getElementById('startItem');
    const endItem = document.getElementById('endItem');
    const totalItems = document.getElementById('totalItems');
    const prestadorModal = document.getElementById('prestadorModal');
    const closeModalBtns = document.querySelectorAll('[id^="closeModalBtn"]');
    const prestadorDetails = document.getElementById('prestadorDetails');
    const approvalModal = document.getElementById('approvalModal');
    const closeApprovalModalBtn = document.getElementById('closeApprovalModalBtn');
    const cancelApprovalBtn = document.getElementById('cancelApprovalBtn');
    const confirmApprovalBtn = document.getElementById('confirmApprovalBtn');
    const approvalText = document.getElementById('approvalText');
    const approvalNotes = document.getElementById('approvalNotes');

    // Variáveis de estado
    let currentPage = 1;
    const itemsPerPage = 10;
    let allPrestadores = [];
    let filteredPrestadores = [];
    let currentPrestadorId = null;
    let currentAction = 'approve'; // 'approve' or 'reject'

    // Toggle do menu mobile
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('active');
    });

    // Fechar modais
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            prestadorModal.classList.add('hidden');
        });
    });

    closeApprovalModalBtn.addEventListener('click', function() {
        approvalModal.classList.add('hidden');
    });

    cancelApprovalBtn.addEventListener('click', function() {
        approvalModal.classList.add('hidden');
    });

    // Simular dados (substituir por chamada AJAX para o PHP)
    function fetchPrestadores() {
        // Simular delay de requisição
        setTimeout(() => {
            // Dados mockados baseados no modelo do banco
            allPrestadores = [
                {
                    id: 1,
                    nome: "João Silva",
                    cpf: "123.456.789-00",
                    email: "joao@email.com",
                    celular: "(11) 98765-4321",
                    especialidade: "Encanador",
                    servicos: ["Reparo hidráulico", "Instalação de pias"],
                    avaliacao: 4.5,
                    status: "Pendente",
                    dataNascimento: "1990-05-15",
                    endereco: {
                        cep: "01234-567",
                        estado: "SP",
                        cidade: "São Paulo",
                        bairro: "Centro",
                        rua: "Rua Exemplo, 123"
                    },
                    foto: "https://via.placeholder.com/150",
                    documentos: [
                        {
                            tipo: "CPF",
                            arquivo: "cpf_joao.pdf",
                            status: "Aprovado"
                        },
                        {
                            tipo: "Comprovante de residência",
                            arquivo: "residencia_joao.pdf",
                            status: "Pendente"
                        }
                    ]
                },
                // Adicione mais prestadores conforme necessário
            ];
            
            filteredPrestadores = [...allPrestadores];
            renderPrestadores();
            updatePagination();
        }, 500);
    }

    // Renderizar prestadores na tabela
    function renderPrestadores() {
        if (filteredPrestadores.length === 0) {
            prestadoresTableBody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                        Nenhum prestador encontrado
                    </td>
                </tr>
            `;
            return;
        }

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const prestadoresToShow = filteredPrestadores.slice(start, end);

        prestadoresTableBody.innerHTML = prestadoresToShow.map(prestador => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${prestador.id}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="${prestador.foto}" alt="${prestador.nome}">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">${prestador.nome}</div>
                            <div class="text-sm text-gray-500">${prestador.email}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${prestador.cpf}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${prestador.especialidade}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${prestador.servicos.join(', ')}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        ${renderStars(prestador.avaliacao)}
                        <span class="ml-1 text-sm text-gray-500">(${prestador.avaliacao})</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        ${prestador.status === 'Ativo' ? 'bg-green-100 text-green-800' : 
                          prestador.status === 'Inativo' ? 'bg-red-100 text-red-800' : 
                          prestador.status === 'Pendente' ? 'bg-yellow-100 text-yellow-800' :
                          'bg-gray-100 text-gray-800'}">
                        ${prestador.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3 view-prestador" data-id="${prestador.id}">Ver</button>
                    ${prestador.status === 'Pendente' ? `
                        <button class="text-green-600 hover:text-green-900 mr-3 approve-prestador" data-id="${prestador.id}">Aprovar</button>
                        <button class="text-red-600 hover:text-red-900 reject-prestador" data-id="${prestador.id}">Rejeitar</button>
                    ` : `
                        <button class="text-indigo-600 hover:text-indigo-900 edit-prestador" data-id="${prestador.id}">Editar</button>
                    `}
                </td>
            </tr>
        `).join('');

        // Adicionar eventos aos botões
        document.querySelectorAll('.view-prestador').forEach(btn => {
            btn.addEventListener('click', function() {
                const prestadorId = this.getAttribute('data-id');
                showPrestadorDetails(prestadorId);
            });
        });

        document.querySelectorAll('.approve-prestador').forEach(btn => {
            btn.addEventListener('click', function() {
                const prestadorId = this.getAttribute('data-id');
                openApprovalModal(prestadorId, 'approve');
            });
        });

        document.querySelectorAll('.reject-prestador').forEach(btn => {
            btn.addEventListener('click', function() {
                const prestadorId = this.getAttribute('data-id');
                openApprovalModal(prestadorId, 'reject');
            });
        });

        document.querySelectorAll('.edit-prestador').forEach(btn => {
            btn.addEventListener('click', function() {
                const prestadorId = this.getAttribute('data-id');
                editPrestador(prestadorId);
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

    // Mostrar detalhes do prestador
    function showPrestadorDetails(prestadorId) {
        const prestador = allPrestadores.find(p => p.id == prestadorId);
        if (!prestador) return;

        prestadorDetails.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="col-span-1 flex flex-col items-center">
                    <img src="${prestador.foto}" alt="${prestador.nome}" class="w-32 h-32 rounded-full mb-4">
                    <h4 class="text-lg font-bold">${prestador.nome}</h4>
                    <p class="text-gray-600">ID: ${prestador.id}</p>
                    <div class="mt-2 flex items-center">
                        ${renderStars(prestador.avaliacao)}
                        <span class="ml-1 text-gray-600">${prestador.avaliacao}</span>
                    </div>
                </div>
                
                <div class="col-span-1 md:col-span-2">
                    <h4 class="text-lg font-medium mb-2">Informações Básicas</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>CPF:</strong> ${prestador.cpf}</p>
                            <p><strong>Email:</strong> ${prestador.email}</p>
                            <p><strong>Celular:</strong> ${prestador.celular}</p>
                        </div>
                        <div>
                            <p><strong>Data Nasc.:</strong> ${new Date(prestador.dataNascimento).toLocaleDateString('pt-BR')}</p>
                            <p><strong>Especialidade:</strong> ${prestador.especialidade}</p>
                            <p><strong>Status:</strong> <span class="${prestador.status === 'Ativo' ? 'text-green-600' : 
                                prestador.status === 'Inativo' ? 'text-red-600' : 'text-yellow-600'}">${prestador.status}</span></p>
                        </div>
                    </div>
                    
                    <h4 class="text-lg font-medium mt-6 mb-2">Endereço</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>CEP:</strong> ${prestador.endereco.cep}</p>
                            <p><strong>Endereço:</strong> ${prestador.endereco.rua}</p>
                        </div>
                        <div>
                            <p><strong>Bairro:</strong> ${prestador.endereco.bairro}</p>
                            <p><strong>Cidade/UF:</strong> ${prestador.endereco.cidade}/${prestador.endereco.estado}</p>
                        </div>
                    </div>
                    
                    <h4 class="text-lg font-medium mt-6 mb-2">Serviços Oferecidos</h4>
                    <ul class="list-disc list-inside">
                        ${prestador.servicos.map(servico => `<li>${servico}</li>`).join('')}
                    </ul>
                    
                    <h4 class="text-lg font-medium mt-6 mb-2">Documentos</h4>
                    <div class="space-y-2">
                        ${prestador.documentos.map(doc => `
                            <div class="flex justify-between items-center p-2 border rounded">
                                <div>
                                    <p class="font-medium">${doc.tipo}</p>
                                    <p class="text-sm text-gray-600">${doc.arquivo}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full 
                                    ${doc.status === 'Aprovado' ? 'bg-green-100 text-green-800' : 
                                     doc.status === 'Rejeitado' ? 'bg-red-100 text-red-800' : 
                                     'bg-yellow-100 text-yellow-800'}">
                                    ${doc.status}
                                </span>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        `;

        prestadorModal.classList.remove('hidden');
    }

    // Abrir modal de aprovação/rejeição
    function openApprovalModal(prestadorId, action) {
        const prestador = allPrestadores.find(p => p.id == prestadorId);
        if (!prestador) return;

        currentPrestadorId = prestadorId;
        currentAction = action;

        if (action === 'approve') {
            approvalText.textContent = `Deseja aprovar o prestador ${prestador.nome}?`;
            confirmApprovalBtn.textContent = 'Aprovar';
            confirmApprovalBtn.className = 'px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700';
        } else {
            approvalText.textContent = `Deseja rejeitar o prestador ${prestador.nome}?`;
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
        const prestadorIndex = allPrestadores.findIndex(p => p.id == currentPrestadorId);
        if (prestadorIndex !== -1) {
            allPrestadores[prestadorIndex].status = currentAction === 'approve' ? 'Ativo' : 'Rejeitado';
            renderPrestadores();
        }
        
        approvalModal.classList.add('hidden');
        alert(`Prestador ${currentAction === 'approve' ? 'aprovado' : 'rejeitado'} com sucesso!`);
    });

    // Editar prestador
    function editPrestador(prestadorId) {
        // Implementar lógica de edição
        alert(`Editar prestador ID: ${prestadorId}`);
    }

    // Filtrar prestadores
    function filterPrestadores() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilterValue = statusFilter.value;

        filteredPrestadores = allPrestadores.filter(prestador => {
            const matchesSearch = prestador.nome.toLowerCase().includes(searchTerm) || 
                                prestador.email.toLowerCase().includes(searchTerm) ||
                                prestador.cpf.includes(searchTerm) ||
                                prestador.especialidade.toLowerCase().includes(searchTerm) ||
                                prestador.servicos.some(s => s.toLowerCase().includes(searchTerm));
            
            const matchesStatus = statusFilterValue === 'all' || 
                                (statusFilterValue === 'active' && prestador.status === 'Ativo') ||
                                (statusFilterValue === 'inactive' && prestador.status === 'Inativo') ||
                                (statusFilterValue === 'pending' && prestador.status === 'Pendente') ||
                                (statusFilterValue === 'rejected' && prestador.status === 'Rejeitado');
            
            return matchesSearch && matchesStatus;
        });

        currentPage = 1;
        renderPrestadores();
        updatePagination();
    }

    // Atualizar paginação
    function updatePagination() {
        const total = filteredPrestadores.length;
        const start = (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, total);

        startItem.textContent = start;
        endItem.textContent = end;
        totalItems.textContent = total;

        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = end >= total;
    }

    // Event Listeners
    searchInput.addEventListener('input', filterPrestadores);
    statusFilter.addEventListener('change', filterPrestadores);
    prevPageBtn.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderPrestadores();
            updatePagination();
        }
    });
    nextPageBtn.addEventListener('click', function() {
        if (currentPage * itemsPerPage < filteredPrestadores.length) {
            currentPage++;
            renderPrestadores();
            updatePagination();
        }
    });

    // Inicializar
    fetchPrestadores();
});