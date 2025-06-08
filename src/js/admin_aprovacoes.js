/**
 * admin_aprovacoes.js - Funcionalidades da página de aprovações
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    // Elementos das abas
    const tabServicos = document.getElementById('tabServicos');
    const tabPrestadores = document.getElementById('tabPrestadores');
    const servicosContent = document.getElementById('servicosContent');
    const prestadoresContent = document.getElementById('prestadoresContent');
    
    // Tabelas
    const servicosPendentesTable = document.getElementById('servicosPendentesTable');
    const prestadoresPendentesTable = document.getElementById('prestadoresPendentesTable');
    
    // Buscas
    const searchServicos = document.getElementById('searchServicos');
    const searchPrestadores = document.getElementById('searchPrestadores');
    
    // Modais
    const servicoModal = document.getElementById('servicoModal');
    const prestadorModal = document.getElementById('prestadorModal');
    const approvalModal = document.getElementById('approvalModal');
    
    // Botões de fechar modais
    const closeServicoModalBtn = document.getElementById('closeServicoModalBtn');
    const closePrestadorModalBtn = document.getElementById('closePrestadorModalBtn');
    const closeApprovalModalBtn = document.getElementById('closeApprovalModalBtn');
    const cancelApprovalBtn = document.getElementById('cancelApprovalBtn');
    
    // Conteúdos dos modais
    const servicoDetails = document.getElementById('servicoDetails');
    const prestadorDetails = document.getElementById('prestadorDetails');
    const approvalModalTitle = document.getElementById('approvalModalTitle');
    const approvalText = document.getElementById('approvalText');
    const approvalNotes = document.getElementById('approvalNotes');
    const confirmApprovalBtn = document.getElementById('confirmApprovalBtn');
    
    // Variáveis de estado
    let currentTab = 'servicos';
    let currentItemId = null;
    let currentItemType = null; // 'servico' ou 'prestador'
    let currentAction = null; // 'approve' ou 'reject'
    let servicosPendentes = [];
    let prestadoresPendentes = [];

    // Toggle do menu mobile
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        mainContent.classList.toggle('active');
    });

    // Controle das abas
    tabServicos.addEventListener('click', function() {
        currentTab = 'servicos';
        updateTabs();
    });

    tabPrestadores.addEventListener('click', function() {
        currentTab = 'prestadores';
        updateTabs();
    });

    function updateTabs() {
        // Atualiza aparência das abas
        tabServicos.classList.remove('border-blue-500', 'text-blue-600');
        tabServicos.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        
        tabPrestadores.classList.remove('border-blue-500', 'text-blue-600');
        tabPrestadores.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        
        if (currentTab === 'servicos') {
            tabServicos.classList.add('border-blue-500', 'text-blue-600');
            tabServicos.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            servicosContent.classList.remove('hidden');
            prestadoresContent.classList.add('hidden');
        } else {
            tabPrestadores.classList.add('border-blue-500', 'text-blue-600');
            tabPrestadores.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            servicosContent.classList.add('hidden');
            prestadoresContent.classList.remove('hidden');
        }
    }

    // Fechar modais
    closeServicoModalBtn.addEventListener('click', function() {
        servicoModal.classList.add('hidden');
    });

    closePrestadorModalBtn.addEventListener('click', function() {
        prestadorModal.classList.add('hidden');
    });

    closeApprovalModalBtn.addEventListener('click', function() {
        approvalModal.classList.add('hidden');
    });

    cancelApprovalBtn.addEventListener('click', function() {
        approvalModal.classList.add('hidden');
    });

    // Simular dados (substituir por chamada AJAX para o PHP)
    function fetchPendencias() {
        // Simular delay de requisição
        setTimeout(() => {
            // Dados mockados de serviços pendentes
            servicosPendentes = [
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
                    dataCadastro: "2025-06-05",
                    fotos: [
                        "https://via.placeholder.com/400x300?text=Serviço+1",
                        "https://via.placeholder.com/400x300?text=Serviço+2"
                    ]
                },
                {
                    id: 2,
                    titulo: "Limpeza Pós-Obra",
                    descricao: "Limpeza completa após reformas e construções",
                    prestador: {
                        id: 3,
                        nome: "Maria Oliveira",
                        foto: "https://via.placeholder.com/150"
                    },
                    categoria: "Limpeza",
                    valor: 180.00,
                    dataCadastro: "2025-06-07",
                    fotos: []
                }
            ];
            
            // Dados mockados de prestadores pendentes
            prestadoresPendentes = [
                {
                    id: 1,
                    nome: "Carlos Mendes",
                    cpf: "123.456.789-00",
                    email: "carlos@email.com",
                    celular: "(11) 98765-4321",
                    especialidade: "Eletricista",
                    dataCadastro: "2025-06-03",
                    foto: "https://via.placeholder.com/150",
                    documentos: [
                        {
                            tipo: "CPF",
                            arquivo: "cpf_carlos.pdf",
                            status: "Pendente"
                        },
                        {
                            tipo: "Comprovante de residência",
                            arquivo: "residencia_carlos.pdf",
                            status: "Pendente"
                        },
                        {
                            tipo: "Certificado de curso",
                            arquivo: "certificado_carlos.pdf",
                            status: "Pendente"
                        }
                    ]
                },
                {
                    id: 2,
                    nome: "Ana Souza",
                    cpf: "987.654.321-00",
                    email: "ana@email.com",
                    celular: "(11) 91234-5678",
                    especialidade: "Encanadora",
                    dataCadastro: "2025-06-06",
                    foto: "https://via.placeholder.com/150",
                    documentos: [
                        {
                            tipo: "CPF",
                            arquivo: "cpf_ana.pdf",
                            status: "Pendente"
                        },
                        {
                            tipo: "Comprovante de residência",
                            arquivo: "residencia_ana.pdf",
                            status: "Pendente"
                        }
                    ]
                }
            ];
            
            renderServicosPendentes();
            renderPrestadoresPendentes();
        }, 500);
    }

    // Renderizar serviços pendentes
    function renderServicosPendentes() {
        if (servicosPendentes.length === 0) {
            servicosPendentesTable.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Nenhum serviço pendente encontrado
                    </td>
                </tr>
            `;
            return;
        }

        servicosPendentesTable.innerHTML = servicosPendentes.map(servico => `
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
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${new Date(servico.dataCadastro).toLocaleDateString('pt-BR')}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3 view-servico" data-id="${servico.id}">Ver</button>
                    <button class="text-green-600 hover:text-green-900 mr-3 approve-item" data-id="${servico.id}" data-type="servico">Aprovar</button>
                    <button class="text-red-600 hover:text-red-900 reject-item" data-id="${servico.id}" data-type="servico">Rejeitar</button>
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

        document.querySelectorAll('.approve-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                const itemType = this.getAttribute('data-type');
                openApprovalModal(itemId, itemType, 'approve');
            });
        });

        document.querySelectorAll('.reject-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                const itemType = this.getAttribute('data-type');
                openApprovalModal(itemId, itemType, 'reject');
            });
        });
    }

    // Renderizar prestadores pendentes
    function renderPrestadoresPendentes() {
        if (prestadoresPendentes.length === 0) {
            prestadoresPendentesTable.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Nenhum prestador pendente encontrado
                    </td>
                </tr>
            `;
            return;
        }

        prestadoresPendentesTable.innerHTML = prestadoresPendentes.map(prestador => `
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
                    ${new Date(prestador.dataCadastro).toLocaleDateString('pt-BR')}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${prestador.documentos.length} documento(s)
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3 view-prestador" data-id="${prestador.id}">Ver</button>
                    <button class="text-green-600 hover:text-green-900 mr-3 approve-item" data-id="${prestador.id}" data-type="prestador">Aprovar</button>
                    <button class="text-red-600 hover:text-red-900 reject-item" data-id="${prestador.id}" data-type="prestador">Rejeitar</button>
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

        document.querySelectorAll('.approve-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                const itemType = this.getAttribute('data-type');
                openApprovalModal(itemId, itemType, 'approve');
            });
        });

        document.querySelectorAll('.reject-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                const itemType = this.getAttribute('data-type');
                openApprovalModal(itemId, itemType, 'reject');
            });
        });
    }

    // Mostrar detalhes do serviço
    function showServicoDetails(servicoId) {
        const servico = servicosPendentes.find(s => s.id == servicoId);
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
                        <p><strong>Data Cadastro:</strong> ${new Date(servico.dataCadastro).toLocaleDateString('pt-BR')}</p>
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
                </div>
            </div>
        `;

        servicoModal.classList.remove('hidden');
    }

    // Mostrar detalhes do prestador
    function showPrestadorDetails(prestadorId) {
        const prestador = prestadoresPendentes.find(p => p.id == prestadorId);
        if (!prestador) return;

        prestadorDetails.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 flex flex-col items-center">
                    <img src="${prestador.foto}" alt="${prestador.nome}" class="w-32 h-32 rounded-full mb-4">
                    <h4 class="text-lg font-bold">${prestador.nome}</h4>
                    <p class="text-gray-600">ID: ${prestador.id}</p>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-lg font-medium mb-2">Informações Básicas</h4>
                    <div class="space-y-2">
                        <p><strong>CPF:</strong> ${prestador.cpf}</p>
                        <p><strong>Email:</strong> ${prestador.email}</p>
                        <p><strong>Celular:</strong> ${prestador.celular}</p>
                        <p><strong>Especialidade:</strong> ${prestador.especialidade}</p>
                        <p><strong>Data Cadastro:</strong> ${new Date(prestador.dataCadastro).toLocaleDateString('pt-BR')}</p>
                    </div>
                    
                    <h4 class="text-lg font-medium mt-6 mb-2">Documentos</h4>
                    <div class="space-y-2">
                        ${prestador.documentos.map(doc => `
                            <div class="flex justify-between items-center p-2 border rounded">
                                <div>
                                    <p class="font-medium">${doc.tipo}</p>
                                    <p class="text-sm text-gray-600">${doc.arquivo}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                    Pendente
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
    function openApprovalModal(itemId, itemType, action) {
        currentItemId = itemId;
        currentItemType = itemType;
        currentAction = action;

        let itemName = '';
        if (itemType === 'servico') {
            const servico = servicosPendentes.find(s => s.id == itemId);
            if (servico) itemName = `"${servico.titulo}"`;
        } else {
            const prestador = prestadoresPendentes.find(p => p.id == itemId);
            if (prestador) itemName = `"${prestador.nome}"`;
        }

        approvalModalTitle.textContent = action === 'approve' ? 'Aprovar Item' : 'Rejeitar Item';
        
        if (action === 'approve') {
            approvalText.textContent = `Deseja aprovar o ${itemType} ${itemName}?`;
            confirmApprovalBtn.textContent = 'Aprovar';
            confirmApprovalBtn.className = 'px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700';
        } else {
            approvalText.textContent = `Deseja rejeitar o ${itemType} ${itemName}?`;
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
        if (currentItemType === 'servico') {
            const index = servicosPendentes.findIndex(s => s.id == currentItemId);
            if (index !== -1) {
                servicosPendentes.splice(index, 1);
                renderServicosPendentes();
            }
        } else {
            const index = prestadoresPendentes.findIndex(p => p.id == currentItemId);
            if (index !== -1) {
                prestadoresPendentes.splice(index, 1);
                renderPrestadoresPendentes();
            }
        }
        
        approvalModal.classList.add('hidden');
        alert(`Item ${currentAction === 'approve' ? 'aprovado' : 'rejeitado'} com sucesso!`);
    });

    // Filtro de serviços
    searchServicos.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        // Implementar filtro