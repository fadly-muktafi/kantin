import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {

    const cartSection = document.getElementById('cart-section');
    const cartNotification = document.getElementById('cart-notification');
    const cartItemCount = document.getElementById('cart-item-count');

    // Function to update cart item count in the nav
    const updateCartCount = (count) => {
        if (!cartItemCount) return;

        cartItemCount.textContent = count;
        if (count > 0) {
            cartItemCount.classList.remove('hidden');
        } else {
            cartItemCount.classList.add('hidden');
        }
    };

    // Function to show notifications
    const showNotification = (message, isSuccess = true) => {
        if (!cartNotification) return;

        const bgColor = isSuccess ? 'bg-emerald-50 border-emerald-200' : 'bg-red-50 border-red-200';
        const textColor = isSuccess ? 'text-emerald-800' : 'text-red-800';
        const iconColor = isSuccess ? 'text-emerald-500' : 'text-red-500';
        const icon = isSuccess 
            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        const title = isSuccess ? 'Berhasil!' : 'Oops!';

        cartNotification.innerHTML = `
            <div class="${bgColor} ${textColor} rounded-xl p-4 flex items-start gap-3 shadow-sm animate-fade-in-down">
                <svg class="w-5 h-5 ${iconColor} mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">${icon}</svg>
                <div>
                    <strong class="font-bold">${title}</strong>
                    <p class="text-sm mt-1">${message}</p>
                </div>
            </div>
        `;
        
        // Automatically remove the notification after 5 seconds
        setTimeout(() => {
            cartNotification.innerHTML = '';
        }, 5000);
    };

    // --- Event Handlers ---

    // 1. Add to Cart (using direct binding as these forms are present on page load)
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const button = form.querySelector('button[type="submit"]');
            const originalButtonText = button.innerHTML;
            button.innerHTML = '...';
            button.disabled = true;

            axios.post(form.action, new FormData(form))
                .then(response => {
                    if (response.data.success) {
                        showNotification(response.data.message, true);
                        if(cartSection) {
                            cartSection.innerHTML = response.data.cart_html;
                        }
                        updateCartCount(response.data.item_count);
                    }
                })
                .catch(error => {
                    const message = error.response?.data?.message || 'Terjadi kesalahan.';
                    showNotification(message, false);
                })
                .finally(() => {
                    button.innerHTML = originalButtonText;
                    button.disabled = false;
                });
        });
    });

    // 2. Update, Remove, Clear Cart (using event delegation on cart section)
    if (cartSection) {
        cartSection.addEventListener('submit', function (e) {
            // Check if the submitted form is one of our ajax forms inside the cart
            if (e.target.matches('.ajax-cart-form')) {
                e.preventDefault();
                const form = e.target;
                const button = form.querySelector('button[type="submit"]');
                const isUpdateForm = form.querySelector('input[name="quantity"]');

                let originalButtonContent = '';
                if(button){
                    originalButtonContent = button.innerHTML;
                    button.innerHTML = '...';
                    button.disabled = true;
                }

                axios.post(form.action, new FormData(form))
                    .then(response => {
                        if (response.data.success) {
                            showNotification(response.data.message, true);
                            cartSection.innerHTML = response.data.cart_html;
                            updateCartCount(response.data.item_count);
                        }
                    })
                    .catch(error => {
                        const message = error.response?.data?.message || 'Terjadi kesalahan.';
                        showNotification(message, false);
                    })
                    .finally(() => {
                        // The button is part of the HTML that gets replaced,
                        // so we don't need to manually revert its state here.
                    });
            }
        });
    }
});