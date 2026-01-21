// Sample product data (in a real application, this would come from MySQL database)
const products = [
    {
        id: 1,
        name: "Swiss Dark Chocolate Truffles",
        price: 789,
        category: "chocolate",
        image: "https://images.pexels.com/photos/918327/pexels-photo-918327.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "Handcrafted Swiss dark chocolate truffles with premium cocoa. Rich, smooth, and indulgent.",
        badge: "Premium"
    },
    {
        id: 2,
        name: "Japanese Matcha Green Tea",
        price: 999,
        category: "drinks",
        image: "https://images.pexels.com/photos/1638280/pexels-photo-1638280.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "Authentic ceremonial grade matcha from Kyoto. Perfect for traditional tea ceremonies.",
        badge: "Authentic"
    },
    {
        id: 3,
        name: "Italian Espresso Beans",
        price: 1599,
        category: "coffee",
        image: "https://images.pexels.com/photos/894695/pexels-photo-894695.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "Premium Italian espresso beans roasted to perfection. Rich aroma and bold flavor.",
        badge: "Roasted Fresh"
    },
    {
        id: 4,
        name: "French Macarons Assortment",
        price: 1299,
        category: "snacks",
        image: "https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "Delicate French macarons in assorted flavors. Made with traditional techniques.",
        badge: "Artisan"
    },
    {
        id: 5,
        name: "Belgian White Chocolate",
        price: 1199,
        category: "chocolate",
        image: "https://images.pexels.com/photos/3776942/pexels-photo-3776942.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "Creamy Belgian white chocolate made with finest cocoa butter and vanilla.",
        badge: "Belgian"
    },
    {
        id: 6,
        name: "Himalayan Pink Salt Chips",
        price: 679,
        category: "snacks",
        image: "https://images.pexels.com/photos/1583884/pexels-photo-1583884.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "Gourmet potato chips seasoned with authentic Himalayan pink salt.",
        badge: "Gourmet"
    },
    {
        id: 7,
        name: "Colombian Cold Brew Coffee",
        price: 999,
        category: "drinks",
        image: "https://images.pexels.com/photos/544961/pexels-photo-544961.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "Smooth Colombian cold brew coffee. Perfect for hot summer days.",
        badge: "Cold Brew"
    },
    {
        id: 8,
        name: "Jamaican Blue Mountain Coffee",
        price: 899,
        category: "coffee",
        image: "https://images.pexels.com/photos/1695052/pexels-photo-1695052.jpeg?auto=compress&cs=tinysrgb&w=400",
        description: "World's most sought-after coffee from Jamaica's Blue Mountains. Mild and smooth.",
        badge: "Rare"
    } 
];

// Shopping cart
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// DOM elements
const productsGrid = document.getElementById('productsGrid');
const cartCount = document.getElementById('cartCount');
const searchInput = document.getElementById('searchInput');

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    displayProducts(products);
    updateCartUI();
    setupEventListeners();
    setupSmoothScrolling();
    setupBootstrapModals();
});

// Setup Bootstrap modals
function setupBootstrapModals() {
    // Initialize Bootstrap modals
    window.cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    window.productModal = new bootstrap.Modal(document.getElementById('productModal'));
}

// Display products
function displayProducts(productsToShow) {
    productsGrid.innerHTML = '';
    
    productsToShow.forEach(product => {
        const productCard = createProductCard(product);
        productsGrid.appendChild(productCard);
    });
}

// Create product card
function createProductCard(product) {
    const col = document.createElement('div');
    col.className = 'col-lg-3 col-md-6 mb-4';
    
    col.innerHTML = `
        <div class="product-card h-100" data-product-id="${product.id}">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}" class="img-fluid">
                <div class="product-badge">${product.badge}</div>
            </div>
            <div class="product-info">
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <div class="product-footer">
                    <div class="product-price">Rs ${product.price}</div>
                    <button class="btn add-to-cart" onclick="event.stopPropagation(); addToCart(${product.id})">
                        <i class="bi bi-bag-plus"></i>
                    </button>
                </div>
            </div>
    `;
    
    // Add click event to open product modal
    const card = col.querySelector('.product-card');
    card.addEventListener('click', (e) => {
        if (!e.target.closest('.add-to-cart')) {
            openProductModal(product);
        }
    });
    
    return col;
}

// Add to cart
function addToCart(productId, quantity = 1) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({
            ...product,
            quantity: quantity
        });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI();
    showNotification(`${product.name} added to cart!`);
}

// Update cart UI
function updateCartUI() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
    
    if (totalItems > 0) {
        cartCount.style.display = 'flex';
    } else {
        cartCount.style.display = 'none';
    }
}

// Open cart modal
function openCartModal() {
    const cartItems = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="text-center py-4"><i class="bi bi-bag-x display-1 text-muted"></i><p class="text-muted mt-3">Your cart is empty</p></div>';
        cartTotal.textContent = '0.00';
    } else {
        cartItems.innerHTML = '';
        let total = 0;
        
        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="img-fluid">
                <div class="cart-item-info">
                    <h6>${item.name}</h6>
                    <p>Quantity: ${item.quantity}</p>
                </div>
                <div class="cart-item-price">Rs ${(item.price * item.quantity).toFixed(2)}</div>
            `;
            cartItems.appendChild(cartItem);
            total += item.price * item.quantity;
        });
        
        cartTotal.textContent = total.toFixed(2);
    }
    
    window.cartModal.show();
}

// Open product modal
function openProductModal(product) {
    document.getElementById('modalProductName').textContent = product.name;
    document.getElementById('modalProductImage').src = product.image;
    document.getElementById('modalProductImage').alt = product.name;
    document.getElementById('modalProductDescription').textContent = product.description;
    document.getElementById('modalProductPrice').textContent = product.price;
    document.getElementById('modalQuantity').value = 1;
    
    const addToCartBtn = document.getElementById('modalAddToCart');
    addToCartBtn.onclick = () => {
        const quantity = parseInt(document.getElementById('modalQuantity').value);
        addToCart(product.id, quantity);
        window.productModal.hide();
    };
    
    window.productModal.show();
}

// Change quantity in product modal
function changeQuantity(change) {
    const quantityInput = document.getElementById('modalQuantity');
    const currentValue = parseInt(quantityInput.value);
    const newValue = Math.max(1, Math.min(10, currentValue + change));
    quantityInput.value = newValue;
}

// Filter products
function filterProducts(category) {
    const filteredProducts = category === 'all' 
        ? products 
        : products.filter(product => product.category === category);
    
    displayProducts(filteredProducts);
    
    // Update active filter button
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`[data-filter="${category}"]`).classList.add('active');
}

// Search products
function searchProducts(query) {
    const filteredProducts = products.filter(product =>
        product.name.toLowerCase().includes(query.toLowerCase()) ||
        product.description.toLowerCase().includes(query.toLowerCase()) ||
        product.category.toLowerCase().includes(query.toLowerCase())
    );
    
    displayProducts(filteredProducts);
}

// Clear cart
function clearCart() {
    cart = [];
    localStorage.removeItem('cart');
    updateCartUI();
    window.cartModal.hide();
    showNotification('Cart cleared!');
}

// Checkout
function checkout() {
    if (cart.length === 0) {
        showNotification('Your cart is empty!', 'error');
        return;
    }
    
    // In a real application, this would integrate with a payment processor
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    showNotification(`Checkout successful! Total: Rs ${total.toFixed(2)}`, 'success');
    
    // Clear cart after successful checkout
    setTimeout(() => {
        clearCart();
    }, 2000);
}

// Show notification
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Setup event listeners
function setupEventListeners() {
    // Cart button
    document.getElementById('cartBtn').addEventListener('click', openCartModal);
    
    // Clear cart and checkout
    document.getElementById('clearCart').addEventListener('click', clearCart);
    document.getElementById('checkout').addEventListener('click', checkout);
    
    // Filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            filterProducts(btn.dataset.filter);
        });
    });
    
    // Category cards
    document.querySelectorAll('.category-card').forEach(card => {
        card.addEventListener('click', () => {
            const category = card.dataset.category;
            filterProducts(category);
            document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
        });
    });
    
    // Search
    searchInput.addEventListener('input', (e) => {
        searchProducts(e.target.value);
    });
    
    // Contact form
    document.getElementById('contactForm').addEventListener('submit', (e) => {
        e.preventDefault();
        showNotification('Message sent successfully!');
        e.target.reset();
    });
    
    // Navigation links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
                
                // Update active nav link
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// Setup smooth scrolling
function setupSmoothScrolling() {
    // Update active nav link on scroll
    window.addEventListener('scroll', () => {
        const sections = ['home', 'products', 'about', 'contact'];
        const scrollPosition = window.scrollY + 100;
        
        sections.forEach(sectionId => {
            const section = document.getElementById(sectionId);
            if (section) {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    const activeLink = document.querySelector(`[href="#${sectionId}"]`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            }
        });
    });
}

// Scroll to products function
function scrollToProducts() {
    document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
}
// Client-side signup form validation
document.addEventListener("DOMContentLoaded", function () {
    const signupForm = document.getElementById("signupForm");
    if (signupForm) {
        signupForm.addEventListener("submit", function (e) {
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const terms = document.getElementById("terms").checked;

            if (!name || !email || !password || !terms) {
                e.preventDefault();
                alert("Please fill out all fields and agree to the terms.");
            }
        });
    }
});
