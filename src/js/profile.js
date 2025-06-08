/**
 * profile.js - Script para a página de perfil do prestador de serviços
 * 
 * Funcionalidades:
 * - Carrega e exibe os dados do usuário
 * - Gerencia a edição do perfil
 * - Manipula avaliações e contatos
 * - Integração com API ViaCEP para busca de endereço
 */

// Dados mockados - substituir por chamadas à API real
const userData = {
    id: 1,
    nome: "Italo Vasconcelos",
    cpf: "12345678900",
    foto: "https://via.placeholder.com/150",
    celular: "11987654321",
    dataNascimento: "1990-05-15",
    endereco: {
        cep: "01234567",
        estado: "SP",
        cidade: "São Paulo",
        bairro: "Centro",
        rua: "Rua Exemplo, 123"
    },
    contatos: [
        { id: 1, contato: "italo@email.com", categoria: "Email" },
        { id: 2, contato: "@italo_vasconcelos", categoria: "Instagram" }
    ],
    servicos: {
        total: 5,
        favoritos: 12,
        avaliacaoMedia: 4.8
    },
    avaliacoes: [
        {
            id: 1,
            nota: 5,
            comentario: "Excelente serviço! O Italo foi muito profissional e resolveu meu problema rapidamente.",
            cliente: "Maria Silva",
            data: "2025-04-10T14:30:00"
        },
        {
            id: 2,
            nota: 4,
            comentario: "Bom trabalho, mas chegou um pouco atrasado. Mesmo assim recomendo!",
            cliente: "João Santos",
            data: "2025-03-22T10:15:00"
        },
        {
            id: 3,
            nota: 5,
            comentario: "Perfeito em todos os aspectos. Contratarei novamente com certeza!",
            cliente: "Ana Oliveira",
            data: "2025-02-18T16:45:00"
        }
    ]
};

/**
 * Função para formatar data no formato dd/mm/aaaa
 * @param {string} dateString - Data no formato ISO (YYYY-MM-DD)
 * @return {string} Data formatada
 */
function formatDate(dateString) {
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('pt-BR', options);
}

/**
 * Função para formatar data e hora
 * @param {string} dateTimeString - Data e hora no formato ISO
 * @return {string} Data e hora formatadas
 */
function formatDateTime(dateTimeString) {
    const options = { 
        day: '2-digit', 
        month: '2-digit', 
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateTimeString).toLocaleDateString('pt-BR', options);
}

/**
 * Função para formatar CPF (xxx.xxx.xxx-xx)
 * @param {string} cpf - CPF sem formatação
 * @return {string} CPF formatado
 */
function formatCPF(cpf) {
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
}

/**
 * Função para formatar telefone ((xx) xxxxx-xxxx)
 * @param {string} phone - Telefone sem formatação
 * @return {string} Telefone formatado
 */
function formatPhone(phone) {
    return phone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
}

/**
 * Função para formatar CEP (xxxxx-xxx)
 * @param {string} cep - CEP sem formatação
 * @return {string} CEP formatado
 */
function formatCEP(cep) {
    return cep.replace(/(\d{5})(\d{3})/, '$1-$2');
}

/**
 * Renderiza as avaliações recebidas pelo usuário
 */
function renderReviews() {
    const reviewsContainer = document.getElementById('userReviews');
    reviewsContainer.innerHTML = '';

    if (userData.avaliacoes.length === 0) {
        reviewsContainer.innerHTML = '<p class="text-gray-500 italic">Nenhuma avaliação recebida ainda.</p>';
        return;
    }

    userData.avaliacoes.forEach(review => {
        const reviewElement = document.createElement('div');
        reviewElement.className = 'border-b pb-4 mb-4';
        reviewElement.innerHTML = `
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-medium">${review.cliente}</h4>
                    <div class="flex items-center mt-1">
                        ${Array.from({ length: 5 }, (_, i) => 
                            `<i class="bi ${i < review.nota ? 'bi-star-fill text-yellow-400' : 'bi-star text-gray-300'}"></i>`
                        ).join('')}
                    </div>
                </div>
                <span class="text-sm text-gray-500">${formatDateTime(review.data)}</span>
            </div>
            <p class="mt-2 text-gray-700">${review.comentario}</p>
        `;
        reviewsContainer.appendChild(reviewElement);
    });
}

/**
 * Renderiza os contatos do usuário
 */
function renderContacts() {
    const contactsContainer = document.getElementById('userContacts');
    contactsContainer.innerHTML = '';

    userData.contatos.forEach(contact => {
        const contactElement = document.createElement('div');
        contactElement.className = 'flex justify-between items-center';
        contactElement.innerHTML = `
            <div>
                <span class="text-sm font-medium text-gray-700">${contact.categoria}:</span>
                <span class="ml-2 text-gray-900">${contact.contato}</span>
            </div>
        `;
        contactsContainer.appendChild(contactElement);
    });
}

/**
 * Renderiza os campos de contato no formulário de edição
 */
function renderContactFields() {
    const contactFieldsContainer = document.getElementById('contactFields');
    contactFieldsContainer.innerHTML = '';

    userData.contatos.forEach((contact, index) => {
        const contactField = document.createElement('div');
        contactField.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 items-end';
        contactField.innerHTML = `
            <div>
                <label for="contactType${index}" class="block text-sm font-medium text-gray-700">Tipo</label>
                <select id="contactType${index}" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    <option value="Email" ${contact.categoria === 'Email' ? 'selected' : ''}>Email</option>
                    <option value="WhatsApp" ${contact.categoria === 'WhatsApp' ? 'selected' : ''}>WhatsApp</option>
                    <option value="Instagram" ${contact.categoria === 'Instagram' ? 'selected' : ''}>Instagram</option>
                    <option value="Facebook" ${contact.categoria === 'Facebook' ? 'selected' : ''}>Facebook</option>
                    <option value="Telefone" ${contact.categoria === 'Telefone' ? 'selected' : ''}>Telefone</option>
                    <option value="Outro" ${contact.categoria === 'Outro' ? 'selected' : ''}>Outro</option>
                </select>
            </div>
            <div class="flex items-end">
                <div class="flex-grow">
                    <label for="contactValue${index}" class="block text-sm font-medium text-gray-700">Contato</label>
                    <input type="text" id="contactValue${index}" value="${contact.contato}" 
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </div>
                <button type="button" class="ml-2 text-red-500 hover:text-red-700 p-2 delete-contact" data-index="${index}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        contactFieldsContainer.appendChild(contactField);
    });
}

/**
 * Carrega os dados do usuário na página
 */
function loadUserData() {
    // Preencher informações básicas
    document.getElementById('userName').textContent = userData.nome.split(' ')[0];
    document.getElementById('userFullName').textContent = userData.nome;
    document.getElementById('userCPF').textContent = formatCPF(userData.cpf);
    document.getElementById('userBirthDate').textContent = formatDate(userData.dataNascimento);
    document.getElementById('userPhone').textContent = formatPhone(userData.celular);
    
    // Preencher endereço
    document.getElementById('userCEP').textContent = formatCEP(userData.endereco.cep);
    document.getElementById('userAddress').textContent = 
        `${userData.endereco.rua}, ${userData.endereco.bairro}, ${userData.endereco.cidade}/${userData.endereco.estado}`;
    
    // Preencher foto de perfil
    document.getElementById('profileImage').src = userData.foto;
    document.getElementById('profileImageLarge').src = userData.foto;
    document.getElementById('profileImageEdit').src = userData.foto;
    
    // Preencher resumo de serviços
    document.getElementById('totalServices').textContent = userData.servicos.total;
    document.getElementById('totalFavorites').textContent = userData.servicos.favoritos;
    document.getElementById('averageRating').textContent = userData.servicos.avaliacaoMedia;
    
    // Renderizar contatos e avaliações
    renderContacts();
    renderReviews();
}

/**
 * Configura os eventos da página
 */
function setupEventListeners() {
    // Elementos do DOM
    const editProfileBtn = document.getElementById('editProfileBtn');
    const editProfileModal = document.getElementById('editProfileModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const profileForm = document.getElementById('profileForm');
    const changePhotoBtn = document.getElementById('changePhotoBtn');
    const profileImageInput = document.getElementById('profileImageInput');
    const addContactBtn = document.getElementById('addContactBtn');
    
    // Abrir modal de edição
    editProfileBtn.addEventListener('click', () => {
        // Preencher formulário com dados atuais
        document.getElementById('editName').value = userData.nome;
        document.getElementById('editCPF').value = formatCPF(userData.cpf);
        document.getElementById('editBirthDate').value = userData.dataNascimento;
        document.getElementById('editPhone').value = userData.celular;
        
        // Preencher endereço
        document.getElementById('editCEP').value = userData.endereco.cep;
        document.getElementById('editStreet').value = userData.endereco.rua.split(',')[0];
        document.getElementById('editNeighborhood').value = userData.endereco.bairro;
        document.getElementById('editCity').value = userData.endereco.cidade;
        document.getElementById('editState').value = userData.endereco.estado;
        
        // Renderizar campos de contato
        renderContactFields();
        
        // Mostrar modal
        editProfileModal.classList.remove('hidden');
    });
    
    // Fechar modal
    closeModalBtn.addEventListener('click', () => {
        editProfileModal.classList.add('hidden');
    });
    
    cancelEditBtn.addEventListener('click', () => {
        editProfileModal.classList.add('hidden');
    });
    
    // Alterar foto de perfil
    changePhotoBtn.addEventListener('click', () => {
        profileImageInput.click();
    });
    
    profileImageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById('profileImageEdit').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Adicionar novo campo de contato
    addContactBtn.addEventListener('click', () => {
        const contactFieldsContainer = document.getElementById('contactFields');
        const newIndex = contactFieldsContainer.children.length;
        
        const contactField = document.createElement('div');
        contactField.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 items-end';
        contactField.innerHTML = `
            <div>
                <label for="contactType${newIndex}" class="block text-sm font-medium text-gray-700">Tipo</label>
                <select id="contactType${newIndex}" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    <option value="Email">Email</option>
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="flex items-end">
                <div class="flex-grow">
                    <label for="contactValue${newIndex}" class="block text-sm font-medium text-gray-700">Contato</label>
                    <input type="text" id="contactValue${newIndex}" 
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </div>
                <button type="button" class="ml-2 text-red-500 hover:text-red-700 p-2 delete-contact" data-index="${newIndex}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        contactFieldsContainer.appendChild(contactField);
    });
    
    // Delegar evento para botões de deletar contato (já que são dinâmicos)
    document.getElementById('contactFields').addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-contact') || e.target.closest('.delete-contact')) {
            const button = e.target.classList.contains('delete-contact') ? e.target : e.target.closest('.delete-contact');
            const contactField = button.closest('div[class*="grid"]');
            contactField.remove();
        }
    });
    
    // Enviar formulário de edição
    profileForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Aqui você faria a chamada à API para atualizar os dados
        // Por enquanto, apenas atualizamos os dados mockados
        
        // Atualizar nome
        userData.nome = document.getElementById('editName').value;
        
        // Atualizar data de nascimento e celular
        userData.dataNascimento = document.getElementById('editBirthDate').value;
        userData.celular = document.getElementById('editPhone').value;
        
        // Atualizar endereço
        userData.endereco = {
            cep: document.getElementById('editCEP').value,
            estado: document.getElementById('editState').value,
            cidade: document.getElementById('editCity').value,
            bairro: document.getElementById('editNeighborhood').value,
            rua: document.getElementById('editStreet').value
        };
        
        // Atualizar contatos
        const contactFields = document.querySelectorAll('#contactFields > div');
        userData.contatos = Array.from(contactFields).map((field, index) => {
            return {
                id: index + 1,
                contato: document.getElementById(`contactValue${index}`).value,
                categoria: document.getElementById(`contactType${index}`).value
            };
        });
        
        // Atualizar foto se foi alterada
        if (profileImageInput.files.length > 0) {
            const reader = new FileReader();
            reader.onload = (event) => {
                userData.foto = event.target.result;
                document.getElementById('profileImage').src = userData.foto;
                document.getElementById('profileImageLarge').src = userData.foto;
            };
            reader.readAsDataURL(profileImageInput.files[0]);
        }
        
        // Recarregar dados na página
        loadUserData();
        
        // Fechar modal
        editProfileModal.classList.add('hidden');
        
        // Mostrar mensagem de sucesso
        alert('Perfil atualizado com sucesso!');
    });
    
    // Buscar CEP automático
    document.getElementById('editCEP').addEventListener('blur', async (e) => {
        const cep = e.target.value.replace(/\D/g, '');
        if (cep.length !== 8) return;
        
        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            const data = await response.json();
            
            if (!data.erro) {
                document.getElementById('editStreet').value = data.logradouro;
                document.getElementById('editNeighborhood').value = data.bairro;
                document.getElementById('editCity').value = data.localidade;
                document.getElementById('editState').value = data.uf;
            }
        } catch (error) {
            console.error('Erro ao buscar CEP:', error);
        }
    });
}

// Inicialização quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', () => {
    // Carregar dados do usuário
    loadUserData();
    
    // Configurar eventos
    setupEventListeners();
});