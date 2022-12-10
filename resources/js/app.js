import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('alpine:init', () => {

    Alpine.data("dropdown", () => ({
        open: false,
        get toggle() {
            this.open = !this.open
        }
    }))
})

window.addEventListener("shouldScrollUp", () => {
    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
    })
})




