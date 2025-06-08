document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const modal = document.getElementById('prestadorModal');
    const closeModalBtn = document.getElementById('closeModal');
    const favoritarBtn = document.getElementById('favoritarBtn');
    const contatoBtn = document.getElementById('contatoBtn');
    const contatoDropdown = document.getElementById('contatoDropdown');
    const reportarBtn = document.getElementById('reportarBtn');

    // Dados de exemplo (substitua por dados reais depois)
    const prestadorData = {
        nome: "Ana Silva",
        foto: "/src/img/fotoperfil.jpg",
        nascimento: "15/05/1985",
        telefone: "(11) 98765-4321",
        cidade: "São Paulo",
        estado: "SP",
        valor: "80,00",
        descricao: "Encanadora profissional com 5 anos de experiência em residências e pequenos comércios.",
        favoritos: 42,
        avaliacoes: 24,
        contatos: {
            whatsapp: "11987654321",
            email: "ana.silva@example.com",
            telefone: "1133334444"
        }
    };

    // Abre o modal ao clicar em "Ver Perfil"
    document.querySelectorAll('.ver-perfil-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Preenche os dados do modal
            document.getElementById('modalNome').textContent = prestadorData.nome;
            document.getElementById('modalFoto').src = prestadorData.foto;
            document.getElementById('modalNascimento').textContent = prestadorData.nascimento;
            document.getElementById('modalTelefone').textContent = prestadorData.telefone;
            document.getElementById('modalCidade').textContent = prestadorData.cidade;
            document.getElementById('modalEstado').textContent = prestadorData.estado;
            document.getElementById('modalValor').textContent = prestadorData.valor;
            document.getElementById('modalDescricao').textContent = prestadorData.descricao;
            document.getElementById('favoritosCount').textContent = prestadorData.favoritos;
            document.getElementById('totalAvaliacoes').textContent = prestadorData.avaliacoes;

            // Mostra o modal
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    });

    // Fecha o modal
    closeModalBtn.addEventListener('click', function() {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    });

    // Fecha ao clicar fora do modal
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    });

    // Botão de favorito (coração)
    let isFavorito = false;
    favoritarBtn.addEventListener('click', function() {
        isFavorito = !isFavorito;
        const heartIcon = favoritarBtn.querySelector('i');
        const countSpan = document.getElementById('favoritosCount');
        
        if (isFavorito) {
            heartIcon.classList.remove('text-gray-400');
            heartIcon.classList.add('text-red-500');
            countSpan.textContent = parseInt(countSpan.textContent) + 1;
        } else {
            heartIcon.classList.remove('text-red-500');
            heartIcon.classList.add('text-gray-400');
            countSpan.textContent = parseInt(countSpan.textContent) - 1;
        }
    });

    // Dropdown de contato
    contatoBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        contatoDropdown.classList.toggle('hidden');
    });

    // Fecha o dropdown ao clicar fora
    document.addEventListener('click', function() {
        contatoDropdown.classList.add('hidden');
    });

    // Opções de contato (WhatsApp, E-mail, etc.)
    document.querySelectorAll('.contato-option').forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            const tipoContato = this.getAttribute('data-type');
            let url = '#';
            
            switch(tipoContato) {
                case 'whatsapp':
                    url = `https://wa.me/55${prestadorData.contatos.whatsapp}`;
                    break;
                case 'email':
                    url = `mailto:${prestadorData.contatos.email}`;
                    break;
                case 'telefone':
                    url = `tel:${prestadorData.contatos.telefone}`;
                    break;
            }
            
            window.open(url, '_blank');
            contatoDropdown.classList.add('hidden');
        });
    });

    // Botão de reportar
    reportarBtn.addEventListener('click', function() {
        if (confirm('Deseja reportar este prestador?')) {
            alert('Obrigado pelo feedback! Vamos analisar sua denúncia.');
        }
    });
});