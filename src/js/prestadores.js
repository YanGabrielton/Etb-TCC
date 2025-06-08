/**
 * Job4You - Página de Prestadores
 * Script para funcionalidades da página
 */

// Menu mobile toggle
document.getElementById('mobile-menu-button').addEventListener('click', function() {
    const menu = document.getElementById('navbarNav');
    menu.classList.toggle('hidden');
});

// Inicialização do carrossel
document.addEventListener('DOMContentLoaded', function() {
    new Glider(document.querySelector('.glider'), {
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: true,
        arrows: {
            prev: '.glider-prev',
            next: '.glider-next'
        },
        responsive: [
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 1280,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            }
        ]
    });
});

/**
 * Função para gerar estrelas de avaliação
 * Pode ser usada quando os dados vierem do PHP
 * 
 * @param {HTMLElement} container - Elemento onde as estrelas serão inseridas
 * @param {number} rating - Nota do prestador (0 a 5)
 * @param {number} reviews - Número de avaliações
 */
function generateStarRating(container, rating, reviews) {
    container.innerHTML = '';
    
    // Estrelas cheias
    const fullStars = Math.floor(rating);
    for (let i = 0; i < fullStars; i++) {
        const star = document.createElement('i');
        star.className = 'bi bi-star-fill';
        container.appendChild(star);
    }
    
    // Meia estrela (se aplicável)
    if (rating % 1 >= 0.5) {
        const halfStar = document.createElement('i');
        halfStar.className = 'bi bi-star-half';
        container.appendChild(halfStar);
    }
    
    // Estrelas vazias
    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
        const star = document.createElement('i');
        star.className = 'bi bi-star';
        container.appendChild(star);
    }
    
    // Número de avaliações
    const count = document.createElement('span');
    count.className = 'text-gray-500 text-xs ml-1';
    count.textContent = `(${reviews})`;
    container.appendChild(count);
}

// Exemplo de uso quando os dados vierem do PHP:
// const ratingContainer = document.querySelector('.star-rating');
// generateStarRating(ratingContainer, 4.5, 42);