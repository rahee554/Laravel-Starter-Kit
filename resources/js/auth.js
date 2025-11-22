/**
 * ============================================
 * AUTH APPLICATION JAVASCRIPT
 * ============================================
 * Entry point for authentication pages
 * Handles form interactions, validations, and particle effects
 */

// No external particles library needed - using pure CSS particles

// Import any authentication-related utilities
// import { someUtil } from './utils';

/**
 * Initialize authentication page features
 */
document.addEventListener('DOMContentLoaded', function() {
    initializeAuthForms();
    initializePasswordToggle();
    initializeFormValidation();
    initializeScrollAnimations();
    initializeCSSParticles();
});

/**
 * Initialize CSS-based particles for particles layout
 * Creates animated floating particles using pure CSS
 */
function initializeCSSParticles() {
    const particlesContainer = document.getElementById('particles-js');
    
    if (particlesContainer) {
        // Clear any existing content
        particlesContainer.innerHTML = '';
        
        // Create 50 particle elements
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'css-particle';
            
            // Random position
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            
            // Random animation delay
            particle.style.animationDelay = Math.random() * 20 + 's';
            
            // Random animation duration
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            
            // Random size
            const size = Math.random() * 3 + 2;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            
            particlesContainer.appendChild(particle);
        }
        
        // Create connecting lines effect
        createParticleLines(particlesContainer);
    }
}

/**
 * Create SVG lines between particles for connection effect
 */
function createParticleLines(container) {
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('class', 'particles-svg');
    svg.style.position = 'absolute';
    svg.style.top = '0';
    svg.style.left = '0';
    svg.style.width = '100%';
    svg.style.height = '100%';
    svg.style.pointerEvents = 'none';
    svg.style.opacity = '0.2';
    
    container.insertBefore(svg, container.firstChild);
    
    // Animate lines every few seconds
    setInterval(() => {
        const particles = container.querySelectorAll('.css-particle');
        svg.innerHTML = '';
        
        // Draw lines between nearby particles
        for (let i = 0; i < Math.min(particles.length, 20); i++) {
            const p1 = particles[i];
            const p2 = particles[(i + 1) % particles.length];
            
            if (p1 && p2) {
                const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                const rect1 = p1.getBoundingClientRect();
                const rect2 = p2.getBoundingClientRect();
                const containerRect = container.getBoundingClientRect();
                
                line.setAttribute('x1', rect1.left - containerRect.left + rect1.width / 2);
                line.setAttribute('y1', rect1.top - containerRect.top + rect1.height / 2);
                line.setAttribute('x2', rect2.left - containerRect.left + rect2.width / 2);
                line.setAttribute('y2', rect2.top - containerRect.top + rect2.height / 2);
                line.setAttribute('stroke', '#00aaff');
                line.setAttribute('stroke-width', '1');
                
                svg.appendChild(line);
            }
        }
    }, 3000);
}

/**
 * Initialize form submission handlers
 */
function initializeAuthForms() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Validate form first
            let isFormValid = true;
            const inputs = this.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                if (!validateField(input, false)) {
                    isFormValid = false;
                }
            });

            // Only show processing if form is valid
            if (isFormValid) {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    const originalText = submitButton.textContent;
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner"></span>Processing...';
                    submitButton.dataset.originalText = originalText;
                }
            } else {
                e.preventDefault();
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            }
        });

        // Re-enable button if there's a validation error from server
        if (form.querySelector('.is-invalid')) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton && submitButton.disabled) {
                submitButton.disabled = false;
                const originalText = submitButton.dataset.originalText || 'Sign In';
                submitButton.innerHTML = originalText;
            }
        }
    });
}

/**
 * Toggle password visibility
 */
function initializePasswordToggle() {
    // Find all password inputs with toggle buttons
    const passwordToggles = document.querySelectorAll('[data-password-toggle]');
    
    passwordToggles.forEach(toggle => {
        const input = document.querySelector(toggle.getAttribute('data-target'));
        if (!input) return;

        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            const type = input.getAttribute('type');
            if (type === 'password') {
                input.setAttribute('type', 'text');
                this.classList.add('toggled');
                this.setAttribute('aria-label', 'Hide password');
            } else {
                input.setAttribute('type', 'password');
                this.classList.remove('toggled');
                this.setAttribute('aria-label', 'Show password');
            }
        });
    });
}

/**
 * Initialize form validation feedback
 */
function initializeFormValidation() {
    const form = document.querySelector('form');
    if (!form) return;

    const inputs = form.querySelectorAll('input, select, textarea');
    
    // Clear error on input (only if already showing error)
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                const feedback = this.parentElement.querySelector('.invalid-feedback');
                if (feedback && !feedback.hasAttribute('data-server-error')) {
                    feedback.style.display = 'none';
                }
                
                // Validate the field as user types if it was previously invalid
                if (this.value.trim()) {
                    validateField(this, true);
                }
            }
        });

        // Only validate on blur if user has typed something
        input.addEventListener('blur', function() {
            if (this.value.trim() && this.classList.contains('is-invalid')) {
                validateField(this, true);
            }
        });
    });

    // Validate on form submit only
    form.addEventListener('submit', function(e) {
        let isFormValid = true;
        
        inputs.forEach(input => {
            if (!validateField(input, false)) {
                isFormValid = false;
            }
        });

        if (!isFormValid) {
            e.preventDefault();
            // Focus first invalid field
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.focus();
            }
        }
    });
}

/**
 * Validate a single field
 */
function validateField(field, clearValidState = false) {
    let isValid = true;
    let errorMessage = '';

    // Check required fields
    if (field.hasAttribute('required') && !field.value.trim()) {
        isValid = false;
        errorMessage = 'This field is required';
    }

    // Check email format
    if (field.type === 'email' && field.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
    }

    // Check password length
    if (field.type === 'password' && field.value.trim() && field.hasAttribute('minlength')) {
        const minLength = field.getAttribute('minlength');
        if (field.value.length < minLength) {
            isValid = false;
            errorMessage = `Password must be at least ${minLength} characters`;
        }
    }

    // Apply validation styles
    if (isValid) {
        field.classList.remove('is-invalid');
        if (!clearValidState) {
            field.classList.add('is-valid');
        }
        
        // Remove error message if it exists and not from server
        const feedback = field.parentElement.querySelector('.invalid-feedback:not([data-server-error])');
        if (feedback) {
            feedback.remove();
        }
    } else {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        
        let feedback = field.parentElement.querySelector('.invalid-feedback:not([data-server-error])');
        if (!feedback) {
            // Check if there's a server error message
            const serverFeedback = field.parentElement.querySelector('.invalid-feedback[data-server-error]');
            if (!serverFeedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                field.parentElement.appendChild(feedback);
            }
        }
        
        if (feedback) {
            feedback.textContent = errorMessage;
            feedback.style.display = 'block';
        }
    }

    return isValid;
}

/**
 * Smooth scroll animations for elements
 */
function initializeScrollAnimations() {
    // Add intersection observer for fade-in animations
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('[data-animate]').forEach(el => {
            observer.observe(el);
        });
    }
}

/**
 * Utility: Show alert message
 */
window.showAlert = function(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.setAttribute('role', 'alert');
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="close-btn" aria-label="Close"></button>
    `;

    const form = document.querySelector('form');
    if (form) {
        form.parentElement.insertBefore(alertDiv, form);
    } else {
        document.body.insertBefore(alertDiv, document.body.firstChild);
    }

    // Close button handler
    const closeBtn = alertDiv.querySelector('.close-btn');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            alertDiv.remove();
        });
    }

    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
};

/**
 * Utility: Handle CSRF token in forms
 */
window.setupCSRFToken = function() {
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        document.querySelectorAll('form').forEach(form => {
            if (!form.querySelector('input[name="_token"]')) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_token';
                input.value = token.getAttribute('content');
                form.appendChild(input);
            }
        });
    }
};

// Initialize CSRF tokens
window.setupCSRFToken();

// Export for use in other modules if needed
export { initializeAuthForms, initializePasswordToggle, initializeFormValidation, initializeCSSParticles };
