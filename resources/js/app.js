import './bootstrap';
const overflowCheckbox = document.getElementById('overflow-checkbox');


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

overflowCheckbox.checked = true;
if (overflowCheckbox) {
    overflowCheckbox.addEventListener('change', function() {
        const sourceResult = document.querySelector('.source-result pre');
        if (!sourceResult) return;
        if (this.checked) {
            sourceResult.style.whiteSpace = 'pre-wrap';
            sourceResult.style.overflowY = '';

        } else {
            sourceResult.style.whiteSpace = 'pre';
            sourceResult.style.overflowY = 'auto';
        }
    });
}