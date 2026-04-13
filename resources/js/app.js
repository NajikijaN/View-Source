import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const result = document.querySelector('.source-result');
    if (result) {
        result.style.maxHeight = '0';
        result.style.opacity = '0';
        requestAnimationFrame(() => {
            result.style.removeProperty('max-height');
            result.style.removeProperty('opacity');
        });
    }
});
