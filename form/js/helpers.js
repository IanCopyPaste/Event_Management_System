/* ========================================
   HELPERS.JS - Reusable Functions
   ======================================== */

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Show/hide element
function show(elementId) {
    document.getElementById(elementId).style.display = 'block';
}

function hide(elementId) {
    document.getElementById(elementId).style.display = 'none';
}

// Show loading state on button
function setButtonLoading(buttonId, isLoading) {
    const btn = document.getElementById(buttonId);
    if (isLoading) {
        btn.dataset.originalText = btn.textContent;
        btn.innerHTML = '<span class="spinner"></span> Loading...';
        btn.disabled = true;
    } else {
        btn.textContent = btn.dataset.originalText;
        btn.disabled = false;
    }
}

// Show error message
function showError(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'card';
    errorDiv.style.borderColor = 'var(--error-red)';
    errorDiv.style.backgroundColor = 'rgba(255, 71, 87, 0.1)';
    errorDiv.innerHTML = `
        <strong style="color: var(--error-red);">Error:</strong> 
        <span style="color: var(--text-white);">${escapeHtml(message)}</span>
    `;
    document.body.prepend(errorDiv);
    
    setTimeout(() => errorDiv.remove(), 5000);
}

// Show success message
function showSuccess(message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'card';
    successDiv.style.borderColor = 'var(--success-green)';
    successDiv.style.backgroundColor = 'rgba(0, 255, 136, 0.1)';
    successDiv.innerHTML = `
        <strong style="color: var(--success-green);">Success:</strong> 
        <span style="color: var(--text-white);">${escapeHtml(message)}</span>
    `;
    document.body.prepend(successDiv);
    
    setTimeout(() => successDiv.remove(), 3000);
}

// AJAX helper
async function apiCall(url, method = 'GET', data = null) {
    try {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            }
        };
        
        if (data) {
            options.body = JSON.stringify(data);
        }
        
        const response = await fetch(url, options);
        const result = await response.json();
        
        return result;
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}

// Get URL parameter
function getUrlParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Copy text to clipboard
function copyToClipboard(text) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
}

// Generate unique ID (client-side)
function generateId() {
    return 'q' + Date.now() + Math.random().toString(36).substr(2, 9);
}