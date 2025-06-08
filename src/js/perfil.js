/**
 * perfil.js - Funcionalidades da página de perfil
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const form = document.querySelector('form');
    const changePhotoBtn = document.getElementById('changePhotoBtn');
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImageLarge = document.getElementById('profileImageLarge');
    const profileImageNav = document.getElementById('profileImage');
    const adicionarContatoBtn = document.getElementById('adicionarContatoBtn');
    const contatosContainer = document.getElementById('contatosContainer');
    const contatosData = document.getElementById('contatosData');
    const cepInput = document.getElementById('cep');
    
    // Alterar foto de perfil
    changePhotoBtn.addEventListener('click', function() {
        profileImageInput.click();
    });
    
    profileImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                profileImageLarge.src = event.target.result;
                profileImageNav.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Adicionar novo contato
    adicionarContatoBtn.addEventListener('click', function() {
        const contatoId = Date.now(); // ID único
        const contatoElement = document.createElement('div');
        contatoElement.className = 'grid grid-cols-1 md:grid-cols-2 gap-6 items-end';
        contatoElement.innerHTML = `
            <div>
                <label for="contatoTipo${contatoId}" class="block text-sm font-medium text-gray-700">Tipo</label>
                <select name="contatos[${contatoId}][tipo]" class="contato-tipo mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
                    <option value="Email">Email</option>
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="flex items-end">
                <div class="flex-grow">
                    <label for="contatoValor${contatoId}" class="block text-sm font-medium text-gray-700">Contato</label>
                    <input type="text" name="contatos[${contatoId}][valor]" class="contato-valor mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
                </div>
                <button type="button" class="removerContatoBtn ml-2 text-red-500 hover:text-red-700 p-2">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        contatosContainer.appendChild(contatoElement);
    });
    
    // Remover contato
    contatosContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('removerContatoBtn') || e.target.closest('.removerContatoBtn')) {
            const button = e.target.classList.contains('removerContatoBtn') ? e.target : e.target.closest('.removerContatoBtn');
            button.closest('div.grid').remove();
        }
    });
    
    // Buscar CEP automático
    cepInput.addEventListener('blur', async function() {
        const cep = this.value.replace(/\D/g, '');
        if (cep.length !== 8) return;
        
        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            const data = await response.json();
            
            if (!data.erro) {
                document.getElementById('estado').value = data.uf;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('rua').value = data.logradouro;
            }
        } catch (error) {
            console.error('Erro ao buscar CEP:', error);
        }
    });
    
    // Formatar CPF
    const cpfInput = document.getElementById('cpf');
    if (cpfInput) {
        cpfInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        });
    }
    
    // Formatar Celular
    const celularInput = document.getElementById('celular');
    if (celularInput) {
        celularInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '')
                .replace(/(\d{2})(\d)/, '($1) $2')
                .replace(/(\d{5})(\d)/, '$1-$2')
                .replace(/(-\d{4})\d+?$/, '$1');
        });
    }
});