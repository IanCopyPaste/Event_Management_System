/* ========================================
   FORM-DISPLAY.JS - Display Forms Logic
   ======================================== */

let currentForm = null;

// Load and display form
async function loadForm() {
    const formId = getUrlParam('id');
    
    if (!formId) {
        showError('No form ID provided');
        return;
    }
    
    console.log('Loading form withhh ID:', formId);
    console.log("hello");
    
    try {
        // Use API config
        const result = await apiCall(`${window.API_CONFIG.getForm}?id=${formId}`);
        
        if (result.success) {
            currentForm = result.form;
            renderForm(result.form);
        } else {
            showError(result.error || 'Form not found');
        }
    } catch (error) {
        showError('Error loading form: ' + error.message);
    }
}

// Render form HTML
function renderForm(form) {
    // Form header
    document.getElementById('formTitle').textContent = form.title;
    
    if (form.description) {
        document.getElementById('formDescription').textContent = form.description;
        show('formDescription');
    }
    
    // Form questions
    const container = document.getElementById('questionsContainer');
    container.innerHTML = '';
    
    form.questions.forEach((question, index) => {
        const questionDiv = document.createElement('div');
        questionDiv.className = 'card animate-fade-up delay-' + Math.min(index + 1, 4);
        
        questionDiv.innerHTML = `
            <div class="mb-20">
                <strong style="font-size: 1.2rem;">${escapeHtml(question.text)}</strong>
                ${question.required ? '<span style="color: var(--accent-cyan);"> *</span>' : ''}
            </div>
            ${renderQuestionInput(question)}
        `;
        
        container.appendChild(questionDiv);
    });
}

// Render question input based on type
function renderQuestionInput(question) {
    const fieldName = `answer_${question.id}`;
    const required = question.required ? 'required' : '';
    
    switch (question.type) {
        case 'text':
            return `<input type="text" name="${fieldName}" ${required} placeholder="Your answer">`;
        
        case 'textarea':
            return `<textarea name="${fieldName}" ${required} placeholder="Your answer"></textarea>`;
        
        case 'multiple':
            return question.options.map(option => `
                <label style="display: block; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="${fieldName}" value="${escapeHtml(option)}" ${required}>
                    ${escapeHtml(option)}
                </label>
            `).join('');
        
        case 'checkbox':
            return question.options.map(option => `
                <label style="display: block; margin-bottom: 10px; cursor: pointer;">
                    <input type="checkbox" name="${fieldName}[]" value="${escapeHtml(option)}">
                    ${escapeHtml(option)}
                </label>
            `).join('');
        
        case 'dropdown':
            return `
                <select name="${fieldName}" ${required}>
                    <option value="">Choose an option...</option>
                    ${question.options.map(option => 
                        `<option value="${escapeHtml(option)}">${escapeHtml(option)}</option>`
                    ).join('')}
                </select>
            `;
        
        default:
            return '';
    }
}

// Submit form
async function submitForm(event) {
    event.preventDefault();
    
    const formElement = event.target;
    const formData = new FormData(formElement);
    
    // Convert to JSON
    const answers = {};
    for (let [key, value] of formData.entries()) {
        if (key.startsWith('answer_')) {
            const questionId = key.replace('answer_', '');
            
            // Handle checkboxes (multiple values)
            if (key.includes('[]')) {
                const cleanKey = key.replace('[]', '');
                const cleanId = cleanKey.replace('answer_', '');
                if (!answers[cleanId]) {
                    answers[cleanId] = [];
                }
                answers[cleanId].push(value);
            } else {
                answers[questionId] = value;
            }
        }
    }
    
    setButtonLoading('submitBtn', true);
    
    try {
        const result = await apiCall(window.API_CONFIG.submitForm, 'POST', {
            form_id: currentForm.form_id,
            answers: answers
        });
        
        if (result.success) {
            // Show success page
            document.getElementById('formContainer').style.display = 'none';
            document.getElementById('successContainer').style.display = 'block';
        } else {
            showError(result.error || 'Failed to submit form');
        }
    } catch (error) {
        showError('Error submitting form: ' + error.message);
    } finally {
        setButtonLoading('submitBtn', false);
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', () => {
    loadForm();
    document.getElementById('responseForm').addEventListener('submit', submitForm);
});