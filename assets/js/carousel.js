/**
 * Carousel initialization for WordPress
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize carousel if Fancybox Carousel is available
    if (typeof Carousel !== 'undefined') {
        carouselInit();
    } else {
        // Wait for Carousel to load
        setTimeout(function() {
            if (typeof Carousel !== 'undefined') {
                carouselInit();
            }
        }, 1000);
    }
});

function carouselInit() {
    document.querySelectorAll('[data-js="carousel"]').forEach(elem => {
        new Carousel(elem, {
            Navigation: {
                prevTpl: '<svg class="size-24"><use href="/wp-content/themes/traumaunites/assets/img/sprite.svg#left"></use></svg>',
                nextTpl: '<svg class="size-24"><use href="/wp-content/themes/traumaunites/assets/img/sprite.svg#right"></use></svg>',
            },
            transition: 'slide',
        });
    });
}
