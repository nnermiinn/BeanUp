const searchInput = document.querySelector('.search');
searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const text = card.querySelector('.text h1').textContent.toLowerCase();
        if(text.includes(query)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
});
