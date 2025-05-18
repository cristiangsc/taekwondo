import './bootstrap';
import Alpine from 'alpinejs'
import { initFlowbite } from 'flowbite'

window.Alpine = Alpine
Alpine.start()

document.addEventListener('DOMContentLoaded', () => {
    initFlowbite();
});
