

document.getElementById('dropdownButton').addEventListener('click', function() {
  document.getElementById('dropdownMenu').classList.toggle('show');
});

// Close dropdown when clicking outside
window.addEventListener('click', function(event) {
  if (!event.target.matches('#dropdownButton') && !event.target.closest('#dropdownButton')) {
    const dropdowns = document.getElementsByClassName('dropdown-menu');
    for (let i = 0; i < dropdowns.length; i++) {
      const openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
});

// Card hover effect with mouse position
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('mousemove', e => {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    // Calculate rotation based on mouse position
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const rotateX = (y - centerY) / 20;
    const rotateY = (centerX - x) / 20;
    
    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-15px)`;
  });
  
  card.addEventListener('mouseleave', () => {
    card.style.transform = '';
  });
});

// Horizontal scroll with mouse drag
const slider = document.getElementById('cards-container');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
  isDown = true;
  slider.classList.add('active');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});

slider.addEventListener('mouseleave', () => {
  isDown = false;
  slider.classList.remove('active');
});

slider.addEventListener('mouseup', () => {
  isDown = false;
  slider.classList.remove('active');
});

slider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX) * 2; // Scroll speed
  slider.scrollLeft = scrollLeft - walk;
});

// Navigation buttons
document.getElementById('next-btn').addEventListener('click', () => {
  slider.scrollBy({
    left: 350,
    behavior: 'smooth'
  });
});

document.getElementById('prev-btn').addEventListener('click', () => {
  slider.scrollBy({
    left: -350,
    behavior: 'smooth'
  });
});

// NEW BACKGROUND SCRIPT - Floating particles animation
document.addEventListener('DOMContentLoaded', function() {
  const particlesContainer = document.getElementById('particles-container');
  const interactiveGradient = document.getElementById('interactive-gradient');
  const page1 = document.querySelector('.page-1');
  
  // Create particles
  function createParticles() {
    // Clear existing particles
    particlesContainer.innerHTML = '';
    
    // Create dust particles
    for (let i = 0; i < 70; i++) {
      createDustParticle();
    }
    
    // Create book page particles
    for (let i = 0; i < 15; i++) {
      createBookPageParticle();
    }
  }
  
  function createDustParticle() {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    
    // Random size (small)
    const size = Math.random() * 3 + 1;
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;
    
    // Random position
    const posX = Math.random() * 100;
    const posY = Math.random() * 100;
    particle.style.left = `${posX}%`;
    particle.style.top = `${posY}%`;
    
    // Random opacity
    particle.style.opacity = Math.random() * 0.5 + 0.1;
    
    // Animation properties
    const duration = Math.random() * 50 + 30;
    const delay = Math.random() * 10;
    
    // Apply animation with CSS
    particle.style.animation = `floatParticle ${duration}s linear ${delay}s infinite`;
    
    // Add to container
    particlesContainer.appendChild(particle);
  }
  
  function createBookPageParticle() {
    const bookPage = document.createElement('div');
    bookPage.classList.add('book-page');
    
    // Size (small rectangle like a page)
    const width = Math.random() * 40 + 20;
    const height = Math.random() * 30 + 20;
    bookPage.style.width = `${width}px`;
    bookPage.style.height = `${height}px`;
    
    // Random position
    const posX = Math.random() * 100;
    const posY = Math.random() * 100;
    bookPage.style.left = `${posX}%`;
    bookPage.style.top = `${posY}%`;
    
    // Random opacity
    bookPage.style.opacity = Math.random() * 0.3 + 0.05;
    
    // Random rotation
    const rotation = Math.random() * 360;
    bookPage.style.transform = `rotate(${rotation}deg)`;
    
    // Animation properties
    const duration = Math.random() * 60 + 40;
    const delay = Math.random() * 15;
    
    // Apply animation
    bookPage.style.animation = `floatBookPage ${duration}s ease-in-out ${delay}s infinite`;
    
    // Add to container
    particlesContainer.appendChild(bookPage);
  }
  
  // Create CSS animations dynamically
  function createAnimations() {
    const style = document.createElement('style');
    style.textContent = `
      @keyframes floatParticle {
        0%, 100% {
          transform: translateY(0) translateX(0);
          opacity: 0.1;
        }
        25% {
          transform: translateY(-${Math.random() * 30 + 10}px) translateX(${Math.random() * 20 - 10}px);
          opacity: 0.3;
        }
        50% {
          transform: translateY(${Math.random() * 20 - 10}px) translateX(${Math.random() * 30 + 10}px);
          opacity: 0.2;
        }
        75% {
          transform: translateY(${Math.random() * 30 + 10}px) translateX(${Math.random() * 20 - 10}px);
          opacity: 0.3;
        }
      }
      
      @keyframes floatBookPage {
        0%, 100% {
          transform: translateY(0) translateX(0) rotate(0deg);
          opacity: 0.05;
        }
        25% {
          transform: translateY(-${Math.random() * 50 + 20}px) translateX(${Math.random() * 30 - 15}px) rotate(${Math.random() * 15 - 7.5}deg);
          opacity: 0.15;
        }
        50% {
          transform: translateY(${Math.random() * 30 - 15}px) translateX(${Math.random() * 50 + 20}px) rotate(${Math.random() * 15 - 7.5}deg);
          opacity: 0.1;
        }
        75% {
          transform: translateY(${Math.random() * 50 + 20}px) translateX(${Math.random() * 30 - 15}px) rotate(${Math.random() * 15 - 7.5}deg);
          opacity: 0.15;
        }
      }
    `;
    document.head.appendChild(style);
  }
  
  // Interactive gradient that follows mouse
  page1.addEventListener('mousemove', (e) => {
    const x = e.clientX / window.innerWidth * 100;
    const y = e.clientY / window.innerHeight * 100;
    
    interactiveGradient.style.background = `
      radial-gradient(
        circle at ${x}% ${y}%, 
        rgba(255, 59, 48, 0.08) 0%, 
        rgba(0, 0, 0, 0) 60%
      )
    `;
  });
  
  // Initialize
  createAnimations();
  createParticles();
  
  // Recreate particles on window resize
  window.addEventListener('resize', createParticles);
});

// Add this to your JavaScript file

// Cart functionality
document.addEventListener('DOMContentLoaded', function() {
  // Cart state
  const cart = {
    items: [],
    total: 0,
    count: 0
  };

  // DOM Elements
  const cartButton = document.querySelector('.material-symbols-outlined');
  const cartBadge = cartButton.nextElementSibling;
  const cartSidebar = document.getElementById('cart-sidebar');
  const cartOverlay = document.getElementById('cart-overlay');
  const closeCartButton = document.getElementById('close-cart');
  const continueShoppingButton = document.getElementById('continue-shopping');
  const cartItemsContainer = document.getElementById('cart-items');
  const emptyCartMessage = document.getElementById('empty-cart-message');
  const subtotalElement = document.getElementById('cart-subtotal');
  const taxElement = document.getElementById('cart-tax');
  const totalElement = document.getElementById('cart-total');
  const checkoutButton = document.getElementById('checkout-btn');
  
  // Product cards
  const productCards = document.querySelectorAll('.card');
  
  // Add 'Add to Cart' buttons to all product cards
  productCards.forEach(card => {
    const title = card.querySelector('.card-title').textContent;
    const priceTag = card.querySelector('.price-tag').textContent;
    const price = parseFloat(priceTag.replace('$', ''));
    const imageUrl = card.querySelector('.card-image img').src;
    
    // Create 'Add to Cart' button
    const addToCartBtn = document.createElement('button');
    addToCartBtn.className = 'absolute bottom-4 right-4 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-full text-sm font-medium transition-all duration-300';
    addToCartBtn.textContent = 'Add to Cart';
    
    // Add click event to button
    addToCartBtn.addEventListener('click', (e) => {
      e.stopPropagation(); // Prevent card click event if any
      addToCart({
        id: generateUniqueId(title),
        title: title,
        price: price,
        image: imageUrl,
        quantity: 1
      });
    });
    
    // Add button to card
    card.style.position = 'relative';
    card.appendChild(addToCartBtn);
  });
  
  // Helper function to generate a simple ID
  function generateUniqueId(title) {
    return title.toLowerCase().replace(/\s+/g, '-') + '-' + Date.now();
  }
  
  // Open cart
  cartButton.parentElement.addEventListener('click', function(e) {
    e.preventDefault();
    openCart();
  });
  
  // Close cart
  closeCartButton.addEventListener('click', closeCart);
  continueShoppingButton.addEventListener('click', closeCart);
  cartOverlay.addEventListener('click', closeCart);
  
  function openCart() {
    cartSidebar.classList.add('open');
    cartOverlay.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
  }
  
  function closeCart() {
    cartSidebar.classList.remove('open');
    cartOverlay.classList.remove('active');
    document.body.style.overflow = ''; // Re-enable scrolling
  }
  
  // Add item to cart
  function addToCart(product) {
    // Check if product already exists
    const existingItemIndex = cart.items.findIndex(item => item.id === product.id);
    
    if (existingItemIndex > -1) {
      // Increment quantity
      cart.items[existingItemIndex].quantity += 1;
    } else {
      // Add new item
      cart.items.push(product);
    }
    
    updateCart();
    animateCartBadge();
  }
  
  // Remove item from cart
  function removeFromCart(productId) {
    cart.items = cart.items.filter(item => item.id !== productId);
    updateCart();
  }
  
  // Update quantity
  function updateQuantity(productId, change) {
    const itemIndex = cart.items.findIndex(item => item.id === productId);
    
    if (itemIndex > -1) {
      const newQuantity = cart.items[itemIndex].quantity + change;
      
      if (newQuantity > 0) {
        cart.items[itemIndex].quantity = newQuantity;
      } else {
        // Remove item if quantity is 0
        removeFromCart(productId);
      }
      
      updateCart();
    }
  }
  
  // Render cart items and update totals
  function updateCart() {
    // Update count and totals
    cart.count = cart.items.reduce((total, item) => total + item.quantity, 0);
    cart.total = cart.items.reduce((total, item) => total + (item.price * item.quantity), 0);
    
    // Update badge
    cartBadge.textContent = cart.count;
    
    // Show/hide empty cart message
    if (cart.items.length === 0) {
      emptyCartMessage.style.display = 'block';
      checkoutButton.disabled = true;
    } else {
      emptyCartMessage.style.display = 'none';
      checkoutButton.disabled = false;
    }
    
    // Update price displays
    const subtotal = cart.total;
    const tax = subtotal * 0.1; // 10% tax
    const total = subtotal + tax;
    
    subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
    taxElement.textContent = `$${tax.toFixed(2)}`;
    totalElement.textContent = `$${total.toFixed(2)}`;
    
    // Render cart items
    renderCartItems();
  }
  
  // Render all cart items
  function renderCartItems() {
    // Clear current items except the empty message
    const currentItems = cartItemsContainer.querySelectorAll('.cart-item');
    currentItems.forEach(item => item.remove());
    
    // Add each item
    cart.items.forEach(item => {
      const cartItemElem = document.createElement('div');
      cartItemElem.className = 'cart-item';
      cartItemElem.innerHTML = `
        <div class="cart-item-image">
          <img src="${item.image}" alt="${item.title}">
        </div>
        <div class="cart-item-details">
          <div class="cart-item-title">${item.title}</div>
          <div class="cart-item-price">$${item.price.toFixed(2)}</div>
          <div class="cart-item-quantity">
            <div class="quantity-button decrease" data-id="${item.id}">-</div>
            <div class="quantity-value">${item.quantity}</div>
            <div class="quantity-button increase" data-id="${item.id}">+</div>
            <button class="ml-auto text-red-400 hover:text-red-300 text-sm remove-item" data-id="${item.id}">Remove</button>
          </div>
        </div>
      `;
      
      cartItemsContainer.appendChild(cartItemElem);
    });
    
    // Add event listeners to new buttons
    addQuantityButtonListeners();
  }
  
  // Add listeners to quantity buttons
  function addQuantityButtonListeners() {
    // Decrease quantity
    document.querySelectorAll('.quantity-button.decrease').forEach(button => {
      button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        updateQuantity(productId, -1);
      });
    });
    
    // Increase quantity
    document.querySelectorAll('.quantity-button.increase').forEach(button => {
      button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        updateQuantity(productId, 1);
      });
    });
    
    // Remove item
    document.querySelectorAll('.remove-item').forEach(button => {
      button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        removeFromCart(productId);
      });
    });
  }
  
  // Animate cart badge when adding items
  function animateCartBadge() {
    cartBadge.classList.remove('cart-badge-animation');
    void cartBadge.offsetWidth; // Trigger reflow to restart animation
    cartBadge.classList.add('cart-badge-animation');
  }
  
  // Checkout functionality
  checkoutButton.addEventListener('click', function() {
    if (cart.items.length > 0) {
      alert('Thank you for your purchase! Your order has been placed.');
      cart.items = [];
      updateCart();
      closeCart();
    }
  });
  
  // Initialize cart
  updateCart();
});