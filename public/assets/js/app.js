(() => {
    // Storefront interactions: AJAX cart/favorites, forms, filters and responsive controls.
    const root = document.documentElement;
    const base = (() => {
        const path = window.location.pathname;
        const index = path.indexOf('/index.php');
        if (index >= 0) return path.slice(0, index);
        const known = ['/shop', '/product/', '/favorites', '/cart', '/about', '/contact', '/faq', '/api/'];
        const match = known.map((part) => path.indexOf(part)).filter((position) => position >= 0).sort((a, b) => a - b)[0];
        return match === undefined ? path.replace(/\/$/, '') : path.slice(0, match);
    })();
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
    let toastTimer;

    const icons = () => {
        if (window.lucide) window.lucide.createIcons();
    };

    const toast = (message) => {
        const element = document.querySelector('[data-toast]');
        if (!element) return;
        element.textContent = message;
        element.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => element.classList.remove('show'), 3200);
    };

    const request = async (endpoint, payload) => {
        const response = await fetch(`${base}${endpoint}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(payload)
        });
        const data = await response.json();
        if (!response.ok) throw new Error(data.message || 'Veprimi deshtoi.');
        return data;
    };

    const setCounter = (selector, count) => {
        document.querySelectorAll(selector).forEach((counter) => {
            counter.textContent = count;
            counter.hidden = count <= 0;
        });
    };

    document.addEventListener('click', async (event) => {
        const flashClose = event.target.closest('[data-flash-close]');
        if (flashClose) {
            flashClose.closest('[data-global-flash]')?.remove();
            return;
        }

        const menuButton = event.target.closest('[data-menu-toggle]');
        if (menuButton) {
            document.body.classList.toggle('menu-open');
            return;
        }

        if (event.target.closest('[data-filter-open]')) {
            document.body.classList.add('filters-open');
            return;
        }

        if (event.target.closest('[data-filter-close]')) {
            document.body.classList.remove('filters-open');
            return;
        }

        const addButton = event.target.closest('[data-add-cart]');
        if (addButton) {
            addButton.disabled = true;
            const source = addButton.dataset.quantitySource;
            const quantity = source ? Number(document.querySelector(source)?.value || 1) : 1;
            try {
                const data = await request('/api/cart/add', {
                    product_id: Number(addButton.dataset.addCart),
                    quantity
                });
                setCounter('[data-cart-count]', data.cart_count);
                toast(data.message);
            } catch (error) {
                toast(error.message);
            } finally {
                addButton.disabled = false;
            }
            return;
        }

        const favoriteButton = event.target.closest('[data-favorite]');
        if (favoriteButton) {
            favoriteButton.disabled = true;
            try {
                const data = await request('/api/favorites/toggle', {
                    product_id: Number(favoriteButton.dataset.favorite)
                });
                document.querySelectorAll(`[data-favorite="${favoriteButton.dataset.favorite}"]`)
                    .forEach((button) => button.classList.toggle('active', data.active));
                setCounter('[data-favorites-count]', data.favorites_count);
                toast(data.message);
                if (!data.active && window.location.pathname.endsWith('/favorites')) {
                    favoriteButton.closest('[data-product-card]')?.remove();
                }
            } catch (error) {
                toast(error.message);
            } finally {
                favoriteButton.disabled = false;
            }
            return;
        }

        const minus = event.target.closest('[data-qty-minus]');
        const plus = event.target.closest('[data-qty-plus]');
        if (minus || plus) {
            const input = document.querySelector('[data-qty-input]');
            if (!input) return;
            const next = Number(input.value) + (plus ? 1 : -1);
            input.value = Math.max(1, Math.min(10, next));
            return;
        }

        const cartControl = event.target.closest('[data-cart-increase], [data-cart-decrease], [data-cart-remove]');
        if (cartControl) {
            const productId = Number(
                cartControl.dataset.cartIncrease ||
                cartControl.dataset.cartDecrease ||
                cartControl.dataset.cartRemove
            );
            const input = document.querySelector(`[data-cart-quantity="${productId}"]`);
            let quantity = Number(input?.value || 1);
            if (cartControl.hasAttribute('data-cart-increase')) quantity += 1;
            if (cartControl.hasAttribute('data-cart-decrease')) quantity -= 1;
            if (cartControl.hasAttribute('data-cart-remove')) quantity = 0;
            await updateCart(productId, quantity);
            return;
        }

        if (event.target.closest('[data-checkout]')) {
            toast('Checkout-i i pageses eshte hapi i ardhshem per integrim.');
        }
    });

    const updateCart = async (productId, quantity) => {
        try {
            const data = await request('/api/cart/update', { product_id: productId, quantity });
            setCounter('[data-cart-count]', data.cart_count);
            document.querySelectorAll('[data-cart-total]').forEach((total) => {
                total.textContent = `$${data.cart_total}`;
            });
            const row = document.querySelector(`[data-cart-row="${productId}"]`);
            if (quantity <= 0) {
                row?.remove();
            } else {
                const input = document.querySelector(`[data-cart-quantity="${productId}"]`);
                if (input) input.value = Math.max(1, Math.min(10, quantity));
                const linePrice = row?.querySelector('.cart-line-price');
                if (linePrice && data.line_total) linePrice.textContent = `$${data.line_total}`;
            }
            toast(data.message);
            if (data.cart_count === 0) window.location.reload();
        } catch (error) {
            toast(error.message);
        }
    };

    document.querySelectorAll('[data-cart-quantity]').forEach((input) => {
        input.addEventListener('change', () => updateCart(Number(input.dataset.cartQuantity), Number(input.value)));
    });

    document.querySelectorAll('[data-auto-submit]').forEach((select) => {
        select.addEventListener('change', () => select.form.submit());
    });

    document.querySelectorAll('[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm('A je i sigurt qe deshiron ta fshish kete regjistrim?')) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('[data-newsletter-form], [data-contact-form]').forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) submitButton.disabled = true;
            const payload = Object.fromEntries(new FormData(form).entries());
            const endpoint = form.hasAttribute('data-contact-form') ? '/api/contact' : '/api/newsletter';
            try {
                const data = await request(endpoint, payload);
                form.reset();
                toast(data.message);
            } catch (error) {
                toast(error.message);
            } finally {
                if (submitButton) submitButton.disabled = false;
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            document.body.classList.remove('menu-open', 'filters-open');
        }
    });

    window.addEventListener('load', icons);
    icons();
})();
