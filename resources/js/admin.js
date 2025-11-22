/**
 * ============================================
 * ADMIN APPLICATION JAVASCRIPT
 * ============================================
 * Entry point for admin/dashboard pages
 * Handles navigation, sidebar toggle, data tables, etc.
 */

/**
 * Initialize admin page features
 */
document.addEventListener('DOMContentLoaded', function() {
    initializeSidebarToggle();
    initializeNavigation();
    initializeDataTables();
    initializeTooltips();
    initializePopovers();
    initializeResponsiveMenu();
    initializeTableSearch();
});

/**
 * Toggle sidebar navigation (Sidebar Layout)
 */
function initializeSidebarToggle() {
    const legacyLayout = document.querySelector('.admin-layout-sidebar');
    const adminShell = document.querySelector('.admin-shell');
    const adminBoard = document.querySelector('.admin-board');
    const toggleButtons = document.querySelectorAll('#sidebarToggle, [data-sidebar-toggle]');

    if (!legacyLayout && !adminShell && !adminBoard) {
        return;
    }

    const toggleSidebar = (event) => {
        event?.preventDefault();

        if (legacyLayout) {
            legacyLayout.classList.toggle('sidebar-collapsed');
            localStorage.setItem(
                'sidebar-collapsed',
                legacyLayout.classList.contains('sidebar-collapsed') ? 'true' : 'false'
            );
        }

        adminShell?.classList.toggle('sidebar-open');
        adminBoard?.classList.toggle('sidebar-open');
    };

    toggleButtons.forEach((btn) => {
        btn.addEventListener('click', toggleSidebar);
    });

    document.addEventListener('click', (event) => {
        if (!adminShell && !adminBoard) return;

        const isToggle = event.target.closest('[data-sidebar-toggle]');
        const insideRail = event.target.closest('.admin-shell__sidebar, .admin-board__rail');

        if (!isToggle && !insideRail && (adminShell?.classList.contains('sidebar-open') || adminBoard?.classList.contains('sidebar-open'))) {
            adminShell?.classList.remove('sidebar-open');
            adminBoard?.classList.remove('sidebar-open');
        }
    });

    const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
    if (isCollapsed) {
        legacyLayout?.classList.add('sidebar-collapsed');
    }
}

/**
 * Initialize active navigation state
 */
function initializeNavigation() {
    const currentUrl = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link, .header-nav a');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && currentUrl.includes(href)) {
            link.classList.add('active');
            
            // Expand parent nav if in a nested structure
            const parent = link.closest('.nav-item');
            if (parent) {
                parent.classList.add('active');
            }
        }
    });
}

/**
 * Initialize Bootstrap data tables
 */
function initializeDataTables() {
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        // Add responsive wrapper
        if (!table.parentElement.classList.contains('table-responsive')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-responsive';
            table.parentElement.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }

        // Add hover effects
        table.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('click', function() {
                this.classList.toggle('selected');
            });
        });
    });
}

/**
 * Initialize Bootstrap tooltips
 */
function initializeTooltips() {
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
}

/**
 * Initialize Bootstrap popovers
 */
function initializePopovers() {
    const popovers = document.querySelectorAll('[data-bs-toggle="popover"]');
    popovers.forEach(popover => {
        new bootstrap.Popover(popover);
    });
}

/**
 * Responsive mobile menu toggle
 */
function initializeResponsiveMenu() {
    const sidebar = document.querySelector('.admin-sidebar');
    if (!sidebar) return;

    // Add mobile menu toggle
    if (window.innerWidth <= 768) {
        const mobileToggle = document.querySelector('.sidebar-toggle');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.admin-sidebar') && 
                    !e.target.closest('.sidebar-toggle')) {
                    sidebar.classList.remove('mobile-open');
                }
            });
        }
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('mobile-open');
        }
    });
}

/**
 * Table search/filter functionality
 */
function initializeTableSearch() {
    const searchInputs = document.querySelectorAll('[data-table-search]');

    searchInputs.forEach(input => {
        const tableSelector = input.getAttribute('data-table-search');
        const table = document.querySelector(tableSelector);
        if (!table) return;

        input.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    });
}

/**
 * Utility: Confirm delete action
 */
window.confirmDelete = function(message = 'Are you sure you want to delete this item?') {
    return confirm(message);
};

/**
 * Utility: Show toast notification
 */
window.showToast = function(message, type = 'info', duration = 3000) {
    const toastContainer = document.getElementById('toastContainer') || createToastContainer();
    
    const toastId = 'toast-' + Date.now();
    const toastHtml = `
        <div id="${toastId}" class="toast show" role="alert">
            <div class="toast-body bg-${type} text-white">
                ${message}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    const toastEl = document.getElementById(toastId);

    setTimeout(() => {
        toastEl.remove();
    }, duration);
};

/**
 * Create toast container if not exists
 */
function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    container.style.zIndex = 9999;
    document.body.appendChild(container);
    return container;
}

/**
 * Utility: Export table to CSV
 */
window.exportTableToCSV = function(tableId, filename = 'export.csv') {
    const table = document.getElementById(tableId);
    if (!table) return;

    let csv = [];
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const csvRow = [];
        cols.forEach(col => {
            csvRow.push('"' + col.textContent.trim() + '"');
        });
        csv.push(csvRow.join(','));
    });

    downloadCSV(csv.join('\n'), filename);
};

/**
 * Trigger CSV download
 */
function downloadCSV(csv, filename) {
    const csvFile = new Blob([csv], { type: 'text/csv' });
    const downloadLink = document.createElement('a');
    downloadLink.href = URL.createObjectURL(csvFile);
    downloadLink.download = filename;
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}

/**
 * Utility: Print page
 */
window.printPage = function() {
    window.print();
};

/**
 * Utility: Format currency
 */
window.formatCurrency = function(amount, currency = 'USD') {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency
    }).format(amount);
};

/**
 * Utility: Format date
 */
window.formatDate = function(date, format = 'short') {
    const d = new Date(date);
    if (format === 'short') {
        return d.toLocaleDateString('en-US');
    } else if (format === 'long') {
        return d.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
    return d.toLocaleString('en-US');
};

/**
 * Handle AJAX requests with CSRF token
 */
window.ajaxRequest = function(url, options = {}) {
    const token = document.querySelector('meta[name="csrf-token"]');
    
    const defaultHeaders = {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    };

    if (token) {
        defaultHeaders['X-CSRF-TOKEN'] = token.getAttribute('content');
    }

    return fetch(url, {
        ...options,
        headers: {
            ...defaultHeaders,
            ...options.headers
        }
    });
};

// Export for use in other modules if needed
export {
    initializeSidebarToggle,
    initializeNavigation,
    initializeDataTables,
    initializeTooltips,
    initializePopovers
};
