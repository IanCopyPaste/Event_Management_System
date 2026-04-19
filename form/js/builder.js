/* ========================================
   BUILDER.JS - Form Builder Logic
   ======================================== */

let questions = [];

// Initialize builder
function initBuilder() {
    addQuestion(); // Add first question

    // Event listeners
    document.getElementById('addQuestionBtn').addEventListener('click', addQuestion);
    document.getElementById('publishBtn').addEventListener('click', publishForm);
    document.getElementById('previewBtn').addEventListener('click', previewForm);
}

// Add new question
function addQuestion() {
    const questionId = generateId();

    const questionData = {
        id: questionId,
        text: '',
        type: 'text',
        options: [],
        required: true
    };

    questions.push(questionData);
    renderQuestion(questionData);
}

// Render question HTML
function renderQuestion(question) {
    const container = document.getElementById('questionsContainer');

    const questionDiv = document.createElement('div');
    questionDiv.className = 'card animate-slide';
    questionDiv.dataset.id = question.id;

    questionDiv.innerHTML = `
        <button class="btn btn-danger btn-small" style="float: right;" onclick="deleteQuestion('${question.id}')">
            Delete
        </button>
        
        <div class="mb-20">
            <input 
                type="text" 
                class="question-text-input" 
                placeholder="Enter your question"
                data-id="${question.id}"
                onchange="updateQuestionText('${question.id}', this.value)"
            >
        </div>
        
        <div class="flex-between mb-20">
            <select 
                class="question-type-select mono" 
                data-id="${question.id}"
                onchange="updateQuestionType('${question.id}', this.value)"
            >
                <option value="text">Short Answer</option>
                <option value="textarea">Long Answer</option>
                <option value="multiple">Multiple Choice</option>
                <option value="checkbox">Checkboxes</option>
                <option value="dropdown">Dropdown</option>
            </select>
        </div>
        
        <div class="options-container" id="options-${question.id}" style="display: none;">
            <div class="mb-15" id="option-list-${question.id}">
                <!-- Options will appear here -->
            </div>
            <button class="btn btn-secondary btn-small" onclick="addOption('${question.id}')">
                + Add Option
            </button>
        </div>
    `;

    container.appendChild(questionDiv);
}

// Update question text
function updateQuestionText(questionId, text) {
    const question = questions.find(q => q.id === questionId);
    if (question) {
        question.text = text;
    }
}

// Update question type
function updateQuestionType(questionId, type) {
    const question = questions.find(q => q.id === questionId);
    if (question) {
        question.type = type;
    }

    // Show/hide options based on type
    const optionsContainer = document.getElementById(`options-${questionId}`);
    if (type === 'multiple' || type === 'checkbox' || type === 'dropdown') {
        optionsContainer.style.display = 'block';

        // Add 2 default options if none exist
        if (question.options.length === 0) {
            addOption(questionId);
            addOption(questionId);
        } else {
            renderOptions(questionId);
        }
    } else {
        optionsContainer.style.display = 'none';
    }
}

// Add option to question
function addOption(questionId) {
    const question = questions.find(q => q.id === questionId);
    if (!question) return;

    const optionId = generateId();
    question.options.push({ id: optionId, text: '' });

    renderOptions(questionId);
}

// Render options list
function renderOptions(questionId) {
    const question = questions.find(q => q.id === questionId);
    if (!question) return;

    const container = document.getElementById(`option-list-${questionId}`);
    container.innerHTML = '';

    question.options.forEach((option, index) => {
        const optionDiv = document.createElement('div');
        optionDiv.className = 'flex-between flex-gap-small mb-10';
        optionDiv.innerHTML = `
            <input 
                type="text" 
                placeholder="Option ${index + 1}"
                value="${escapeHtml(option.text)}"
                onchange="updateOption('${questionId}', '${option.id}', this.value)"
            >
            <button class="btn btn-danger btn-small" onclick="removeOption('${questionId}', '${option.id}')">
                Remove
            </button>
        `;
        container.appendChild(optionDiv);
    });
}

// Update option text
function updateOption(questionId, optionId, text) {
    const question = questions.find(q => q.id === questionId);
    if (!question) return;

    const option = question.options.find(o => o.id === optionId);
    if (option) {
        option.text = text;
    }
}

// Remove option
function removeOption(questionId, optionId) {
    const question = questions.find(q => q.id === questionId);
    if (!question) return;

    question.options = question.options.filter(o => o.id !== optionId);
    renderOptions(questionId);
}

// Delete question
function deleteQuestion(questionId) {
    questions = questions.filter(q => q.id !== questionId);
    const questionDiv = document.querySelector(`[data-id="${questionId}"]`);
    questionDiv.remove();
}

// Collect form data
function collectFormData() {
    const title = document.getElementById('formTitle').value || 'Untitled Form';
    const description = document.getElementById('formDescription').value || '';

    // Clean up questions (remove empty options)
    const cleanQuestions = questions.map(q => ({
        id: q.id,
        text: q.text || 'Untitled Question',
        type: q.type,
        required: q.required,
        options: q.options.filter(o => o.text.trim()).map(o => o.text)
    }));

    return {
        title,
        description,
        questions: cleanQuestions
    };
}

// Preview form
function previewForm() {
    const formData = collectFormData();

    if (formData.questions.length === 0) {
        showError('Please add at least one question to preview');
        return;
    }

    localStorage.setItem('previewFormData', JSON.stringify(formData));
    window.open('preview.html', '_blank');
}

// Publish form
async function publishForm() {
    const formData = collectFormData();

    if (formData.questions.length === 0) {
        showError('Please add at least one question before publishing');
        return;
    }

    console.log('Publishing form data:', formData);

    setButtonLoading('publishBtn', true);

    try {
        //window.API_CONFIG.createForm = '/LOQ_website/claudeAIVer2/php/create-form.php'
        console.log('Calling API:', window.API_CONFIG.createForm);
        const result = await apiCall(window.API_CONFIG.createForm, 'POST', formData);

        console.log('API Result:', result);

        if (result.success) {
            showPublishModal(result.url, result.form_id);
        } else {
            showError(result.error || 'Failed to publish form');

            // Show raw response if available
            if (result.raw_response) {
                console.error('Raw PHP Response:', result.raw_response);
            }
        }
        console.log("dito may error");
    } catch (error) {
        showError('Error publishing form: ' + error.message);
        console.error('Full error:', error);
    } finally {
        setButtonLoading('publishBtn', false);
    }
}

// Show publish success modal
function showPublishModal(url, formId) {
    document.getElementById('publishedUrl').value = url;
    document.getElementById('viewFormLink').href = url;
    document.getElementById('publishModal').classList.add('active');
}

// Copy URL to clipboard
function copyUrl() {
    const urlInput = document.getElementById('publishedUrl');
    copyToClipboard(urlInput.value);

    const btn = document.getElementById('copyUrlBtn');
    btn.textContent = 'Copied!';
    setTimeout(() => {
        btn.textContent = 'Copy';
    }, 2000);
}

// Close modal
function closeModal() {
    document.getElementById('publishModal').classList.remove('active');
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', initBuilder);