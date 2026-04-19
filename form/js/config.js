/* ========================================
   CONFIG.JS - Configuration Settings
   ======================================== */

// IMPORTANT: Update this path to match your folder structure
const API_BASE_PATH = '/LOQ_website/claudeAIVer2/php';

// API endpoints - these will automatically use the base path
const API = {
    createForm: `${API_BASE_PATH}/create-form.php`,
    getForm: `${API_BASE_PATH}/get-form.php`,
    submitForm: `${API_BASE_PATH}/submit-form.php`,
    getResponses: `${API_BASE_PATH}/get-responses.php`
};

// Export for use in other files
window.API_CONFIG = API;

/* ========================================
   HOW TO UPDATE PATHS:
   ======================================== */

// If your folder is at: http://localhost/myforms/
// Change to: const API_BASE_PATH = '/myforms/php';

// If your folder is at: http://localhost:8080/forms/
// Change to: const API_BASE_PATH = '/forms/php';

// If your folder is at root: http://localhost/
// Change to: const API_BASE_PATH = '/php';