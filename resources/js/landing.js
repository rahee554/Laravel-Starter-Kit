// ============================================
// LANDING PAGE - Modern Interactive Features
// ============================================

document.addEventListener('DOMContentLoaded', function() {
  initNavigation();
  initScrollAnimation();
  initCounters();
  initFormValidation();
  initScrollToTop();
  initSmoothScroll();
  initMobileMenu();
  initParallax();
});

// ============================================
// NAVIGATION
// ============================================

function initNavigation() {
  const navbar = document.querySelector('.navbar');
  const navLinks = document.querySelectorAll('.nav-link');
  
  // Add scrolled class on scroll
  window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
      navbar?.classList.add('scrolled');
    } else {
      navbar?.classList.remove('scrolled');
    }
  });

  // Highlight active navigation link
  navLinks.forEach(link => {
    link.addEventListener('click', function() {
      navLinks.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // Update active link on scroll
  window.addEventListener('scroll', function() {
    updateActiveNavLink();
  });
}

function updateActiveNavLink() {
  const sections = document.querySelectorAll('[data-section]');
  const navLinks = document.querySelectorAll('.nav-link');
  
  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;
    if (scrollY >= sectionTop - 200) {
      current = section.getAttribute('data-section');
    }
  });

  navLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href') === `#${current}`) {
      link.classList.add('active');
    }
  });
}

// ============================================
// SCROLL ANIMATIONS
// ============================================

function initScrollAnimation() {
  const elements = document.querySelectorAll('[data-animate]');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const animation = entry.target.getAttribute('data-animate');
        entry.target.classList.add(`animate-${animation}`);
        
        // Remove observer after animation
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  });

  elements.forEach(el => observer.observe(el));
}

// ============================================
// COUNTER ANIMATION
// ============================================

function initCounters() {
  const counters = document.querySelectorAll('[data-counter]');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
        const target = parseInt(entry.target.getAttribute('data-counter'));
        const duration = 2000; // 2 seconds
        animateCounter(entry.target, target, duration);
        entry.target.classList.add('animated');
      }
    });
  }, {
    threshold: 0.5
  });

  counters.forEach(counter => observer.observe(counter));
}

function animateCounter(element, target, duration) {
  let current = 0;
  const start = Date.now();
  const step = target / (duration / 16);
  
  const timer = setInterval(() => {
    current += step;
    if (current >= target) {
      element.textContent = target.toLocaleString();
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(current).toLocaleString();
    }
  }, 16);
}

// ============================================
// FORM VALIDATION
// ============================================

function initFormValidation() {
  const forms = document.querySelectorAll('[data-form-validate]');
  
  forms.forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (validateForm(this)) {
        handleFormSubmit(this);
      }
    });

    // Real-time validation
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      input.addEventListener('change', function() {
        validateField(this);
      });
      
      input.addEventListener('blur', function() {
        validateField(this);
      });
    });
  });
}

function validateField(field) {
  const value = field.value.trim();
  const type = field.getAttribute('type');
  const required = field.hasAttribute('required');
  
  // Reset error
  field.classList.remove('error');
  const errorMsg = field.parentElement?.querySelector('.error-message');
  if (errorMsg) errorMsg.remove();
  
  if (required && !value) {
    showFieldError(field, 'This field is required');
    return false;
  }
  
  if (type === 'email' && value && !isValidEmail(value)) {
    showFieldError(field, 'Please enter a valid email');
    return false;
  }
  
  if (type === 'url' && value && !isValidURL(value)) {
    showFieldError(field, 'Please enter a valid URL');
    return false;
  }
  
  if (field.name === 'password' && value && value.length < 8) {
    showFieldError(field, 'Password must be at least 8 characters');
    return false;
  }
  
  if (field.name === 'confirm-password' && value) {
    const passwordField = field.form?.querySelector('input[name="password"]');
    if (passwordField && passwordField.value !== value) {
      showFieldError(field, 'Passwords do not match');
      return false;
    }
  }
  
  return true;
}

function showFieldError(field, message) {
  field.classList.add('error');
  const errorDiv = document.createElement('div');
  errorDiv.className = 'error-message';
  errorDiv.textContent = message;
  field.parentElement?.appendChild(errorDiv);
}

function validateForm(form) {
  const inputs = form.querySelectorAll('input, textarea, select');
  let isValid = true;
  
  inputs.forEach(input => {
    if (!validateField(input)) {
      isValid = false;
    }
  });
  
  return isValid;
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidURL(url) {
  try {
    new URL(url);
    return true;
  } catch (e) {
    return false;
  }
}

function handleFormSubmit(form) {
  // Show loading state
  const submitBtn = form.querySelector('button[type="submit"]');
  const originalText = submitBtn?.textContent;
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending...';
  }
  
  // Simulate form submission
  setTimeout(() => {
    // Show success message
    const message = document.createElement('div');
    message.className = 'success-message';
    message.textContent = 'Thank you! Your message has been sent.';
    form.parentElement?.appendChild(message);
    
    // Reset form
    form.reset();
    
    // Remove message after 5 seconds
    setTimeout(() => {
      message.remove();
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      }
    }, 5000);
  }, 1500);
}

// ============================================
// SCROLL TO TOP BUTTON
// ============================================

function initScrollToTop() {
  const scrollBtn = document.querySelector('.scroll-to-top');
  
  if (!scrollBtn) return;
  
  window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
      scrollBtn.classList.add('visible');
    } else {
      scrollBtn.classList.remove('visible');
    }
  });
  
  scrollBtn.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}

// ============================================
// SMOOTH SCROLL
// ============================================

function initSmoothScroll() {
  const links = document.querySelectorAll('a[href^="#"]');
  
  links.forEach(link => {
    link.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      const target = document.querySelector(href);
      
      if (target) {
        e.preventDefault();
        const offsetTop = target.offsetTop - 100;
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
      }
    });
  });
}

// ============================================
// MOBILE MENU TOGGLE
// ============================================

function initMobileMenu() {
  const menuToggle = document.querySelector('.menu-toggle');
  const navMenu = document.querySelector('.nav-menu');
  
  if (!menuToggle) return;
  
  menuToggle.addEventListener('click', function() {
    navMenu?.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });
  
  // Close menu when link clicked
  const navLinks = document.querySelectorAll('.nav-link');
  navLinks.forEach(link => {
    link.addEventListener('click', function() {
      navMenu?.classList.remove('active');
      menuToggle?.classList.remove('active');
    });
  });
}

// ============================================
// PARALLAX EFFECT
// ============================================

function initParallax() {
  const parallaxElements = document.querySelectorAll('[data-parallax]');
  
  if (parallaxElements.length === 0) return;
  
  window.addEventListener('scroll', function() {
    parallaxElements.forEach(element => {
      const speed = element.getAttribute('data-parallax') || 0.5;
      const yPos = window.scrollY * speed;
      element.style.transform = `translateY(${yPos}px)`;
    });
  });
}

// ============================================
// DROPDOWN MENUS
// ============================================

function initDropdowns() {
  const dropdowns = document.querySelectorAll('[data-dropdown]');
  
  dropdowns.forEach(dropdown => {
    const trigger = dropdown.querySelector('[data-dropdown-trigger]');
    const menu = dropdown.querySelector('[data-dropdown-menu]');
    
    if (!trigger || !menu) return;
    
    trigger.addEventListener('click', function(e) {
      e.preventDefault();
      menu.classList.toggle('active');
    });
    
    // Close on outside click
    document.addEventListener('click', function(e) {
      if (!dropdown.contains(e.target)) {
        menu.classList.remove('active');
      }
    });
  });
}

// ============================================
// MODAL/DIALOG HANDLING
// ============================================

function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
  }
}

function initModals() {
  const closeButtons = document.querySelectorAll('[data-modal-close]');
  const modalTriggers = document.querySelectorAll('[data-modal-trigger]');
  
  closeButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const modal = this.closest('[data-modal]');
      if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
      }
    });
  });
  
  modalTriggers.forEach(trigger => {
    trigger.addEventListener('click', function() {
      const modalId = this.getAttribute('data-modal-trigger');
      openModal(modalId);
    });
  });
  
  // Close on backdrop click
  document.querySelectorAll('[data-modal]').forEach(modal => {
    modal.addEventListener('click', function(e) {
      if (e.target === this) {
        this.classList.remove('active');
        document.body.style.overflow = 'auto';
      }
    });
  });
}

// ============================================
// TAB NAVIGATION
// ============================================

function initTabs() {
  const tabs = document.querySelectorAll('[data-tabs]');
  
  tabs.forEach(tabContainer => {
    const tabButtons = tabContainer.querySelectorAll('[data-tab-button]');
    const tabPanes = tabContainer.querySelectorAll('[data-tab-pane]');
    
    tabButtons.forEach(button => {
      button.addEventListener('click', function() {
        const tabId = this.getAttribute('data-tab-button');
        
        // Remove active from all
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabPanes.forEach(pane => pane.classList.remove('active'));
        
        // Add active to current
        this.classList.add('active');
        const pane = tabContainer.querySelector(`[data-tab-pane="${tabId}"]`);
        if (pane) pane.classList.add('active');
      });
    });
  });
}

// ============================================
// ACCORDION
// ============================================

function initAccordion() {
  const accordions = document.querySelectorAll('[data-accordion]');
  
  accordions.forEach(accordion => {
    const items = accordion.querySelectorAll('[data-accordion-item]');
    
    items.forEach(item => {
      const header = item.querySelector('[data-accordion-header]');
      const content = item.querySelector('[data-accordion-content]');
      
      if (!header) return;
      
      header.addEventListener('click', function() {
        const isActive = item.classList.contains('active');
        
        // Close all items in accordion
        items.forEach(i => {
          i.classList.remove('active');
          const c = i.querySelector('[data-accordion-content]');
          if (c) {
            c.style.maxHeight = '0';
          }
        });
        
        // Open current if not already open
        if (!isActive) {
          item.classList.add('active');
          if (content) {
            content.style.maxHeight = content.scrollHeight + 'px';
          }
        }
      });
    });
  });
}

// ============================================
// LAZY LOADING IMAGES
// ============================================

function initLazyImages() {
  const images = document.querySelectorAll('img[data-lazy]');
  
  const imageObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.getAttribute('data-lazy');
        img.removeAttribute('data-lazy');
        imageObserver.unobserve(img);
      }
    });
  });
  
  images.forEach(img => imageObserver.observe(img));
}

// ============================================
// CLIPBOARD COPY
// ============================================

function copyToClipboard(text, feedbackElement) {
  navigator.clipboard.writeText(text).then(() => {
    if (feedbackElement) {
      const originalText = feedbackElement.textContent;
      feedbackElement.textContent = 'Copied!';
      setTimeout(() => {
        feedbackElement.textContent = originalText;
      }, 2000);
    }
  }).catch(err => {
    console.error('Failed to copy:', err);
  });
}

// ============================================
// DARK MODE TOGGLE
// ============================================

function initDarkMode() {
  const darkModeToggle = document.querySelector('[data-dark-mode-toggle]');
  const html = document.documentElement;
  
  if (!darkModeToggle) return;
  
  // Check localStorage
  const isDarkMode = localStorage.getItem('darkMode') === 'true';
  if (isDarkMode) {
    html.setAttribute('data-theme', 'dark');
    darkModeToggle.classList.add('active');
  }
  
  darkModeToggle.addEventListener('click', function() {
    const isCurrentlyDark = html.getAttribute('data-theme') === 'dark';
    
    if (isCurrentlyDark) {
      html.removeAttribute('data-theme');
      localStorage.setItem('darkMode', 'false');
      this.classList.remove('active');
    } else {
      html.setAttribute('data-theme', 'dark');
      localStorage.setItem('darkMode', 'true');
      this.classList.add('active');
    }
  });
}

// ============================================
// UTILITY FUNCTIONS
// ============================================

// Debounce function for performance
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Throttle function
function throttle(func, limit) {
  let inThrottle;
  return function(...args) {
    if (!inThrottle) {
      func.apply(this, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  };
}

// Check if element is in viewport
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

// Export functions for global use
window.landing = {
  openModal,
  closeModal,
  copyToClipboard,
  isInViewport,
  debounce,
  throttle
};

// ============================================
// INIT ALL FEATURES
// ============================================

initDropdowns();
initModals();
initTabs();
initAccordion();
initLazyImages();
initDarkMode();
