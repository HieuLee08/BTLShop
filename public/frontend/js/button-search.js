let buttons = document.querySelectorAll('.button');
buttons.forEach(button => {
    button.addEventListener('click', function(e) {
        const xInside = e.offsetX;
        const yInside = e.offsetY;

        const circle = document.createElement('span');
        circle.classList.add('circle');
        circle.style.top = `${yInside}px`;
        circle.style.left = `${xInside}px`;

        this.appendChild(circle);

        setTimeout(() => circle.remove(), 1000);
    });
});

const searchInput = document.getElementById('search-input');
const searchResults = document.getElementById('search-results');
let debounceTimer = null;

if (searchInput && searchResults) {
    searchInput.addEventListener('input', function() {
        const keyword = this.value.trim();

        if (debounceTimer) {
            clearTimeout(debounceTimer);
        }

        if (keyword.length < 2) {
            searchResults.classList.add('d-none');
            searchResults.innerHTML = '';
            return;
        }

        debounceTimer = setTimeout(() => {
            const url = this.dataset.suggestUrl + '?keyword=' + encodeURIComponent(keyword);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        searchResults.innerHTML = '<div class="search-item"><span>Không tìm thấy kết quả phù hợp.</span></div>';
                        searchResults.classList.remove('d-none');
                        return;
                    }

                    const html = data.map(item => {
                        const price = Number(item.proPrice || 0);
                        const sale = Number(item.proSale || 0);
                        const finalPrice = sale > 0 ? price - (price * sale / 100) : price;
                        return `
                            <a href="/product/${item.proId}" class="search-item-link">
                                <div class="search-item">
                                    <img src="/uploads/product/${item.proImage}" alt="${item.proName}" class="search-item-image" />
                                    <div class="search-item-details">
                                        <span class="search-item-name">${item.proName}</span>
                                        <div>
                                            <span class="search-item-price">${finalPrice.toLocaleString('vi-VN')}₫</span>
                                            ${sale > 0 ? `<span class="price-original">${price.toLocaleString('vi-VN')}₫</span><span class="sale-badge">-${sale}%</span>` : ''}
                                        </div>
                                    </div>
                                </div>
                            </a>`;
                    }).join('');

                    searchResults.innerHTML = html;
                    searchResults.classList.remove('d-none');
                })
                .catch(() => {
                    searchResults.innerHTML = '<div class="search-item"><span>Không thể tải kết quả.</span></div>';
                    searchResults.classList.remove('d-none');
                });
        }, 250);
    });

    document.addEventListener('click', function(event) {
        if (!searchResults.contains(event.target) && event.target !== searchInput) {
            searchResults.classList.add('d-none');
        }
    });
}
