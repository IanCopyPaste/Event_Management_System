<style>
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --bg-color: #f4f7fb;
        --card-bg: #ffffff;
        --text-main: #111827;
        --text-muted: #6b7280;
        --border-color: #e5e7eb;
        --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        --radius-md: 12px;
        --radius-lg: 20px;
    }

    * {
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    body {
        margin: 0;
        background: var(--bg-color);
        color: var(--text-main);
        padding-bottom: 40px;
    }

    /* --- HEADER & SEARCH --- */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 30px 25px 10px;
        flex-wrap: wrap;
        gap: 15px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 700;
    }

    .search-container {
        position: relative;
        width: 100%;
        max-width: 400px;
    }

    .search-input {
        width: 100%;
        padding: 14px 20px 14px 45px;
        border: 1px solid var(--border-color);
        border-radius: 50px;
        font-size: 15px;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }

    .search-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        fill: var(--text-muted);
    }

    /* --- CARDS CSS --- */
    .events-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px 25px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }

    .event-card {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--border-color);
    }

    .event-banner {
        width: 100%;
        height: 180px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .event-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
    }

    .event-content {
        padding: 22px;
    }

    .event-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .event-description {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .no-results {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px;
        color: var(--text-muted);
        font-size: 18px;
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        border: 1px dashed var(--border-color);
    }

    /* --- MODAL CSS --- */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, 0.7);
        backdrop-filter: blur(5px);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-overlay.show {
        display: flex;
        opacity: 1;
    }

    .modal-content {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 1000px;
        height: 85vh;
        position: relative;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    .modal-overlay.show .modal-content {
        transform: scale(1);
    }

    .modal-header {
        padding: 20px 30px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 22px;
    }

    .close-btn {
        font-size: 32px;
        line-height: 1;
        color: var(--text-muted);
        cursor: pointer;
        transition: color 0.2s;
        background: none;
        border: none;
        padding: 0;
    }

    .close-btn:hover {
        color: var(--text-main);
    }

    .modal-body {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        padding: 30px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-left,
    .modal-right {
        display: flex;
        flex-direction: column;
    }

    .modal-left img.main-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: var(--radius-md);
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
    }

    .modal-left h3 {
        font-size: 24px;
        margin: 0 0 12px 0;
    }

    .desc-text {
        color: var(--text-muted);
        line-height: 1.6;
        font-size: 15px;
        margin-bottom: 25px;
    }

    .event-info {
        display: flex;
        flex-direction: column;
        gap: 12px;
        background: #f9fafb;
        padding: 16px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
    }

    .event-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-main);
        font-size: 14px;
        font-weight: 500;
    }

    .event-status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 15px;
        align-self: flex-start;
    }

    .status-open {
        background: #16a34a;
    }

    .status-closed {
        background: #dc2626;
    }

    .status-ongoing {
        background: #2563eb;
    }

    .status-finished {
        background: #6b7280;
    }

    /* --- FORM CSS --- */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
        font-size: 14px;
    }

    .form-group input[type="text"],
    .form-group input[type="file"],
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
        background: #f9fafb;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .benefit-row {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: var(--radius-md);
        width: 45px;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-delete:hover {
        background: #fecaca;
    }

    .btn-secondary {
        background: #e5edff;
        color: var(--primary);
        border: none;
        padding: 10px 16px;
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-secondary:hover {
        background: #dbeafe;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        border: none;
        padding: 14px;
        border-radius: var(--radius-md);
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
        transition: 0.2s;
        width: 100%;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
    }

    /* Custom Notification Modal Styles */
    .notification-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        /* Ensure it floats above everything else */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        align-items: center;
        justify-content: center;
    }

    .notification-modal.show {
        display: flex;
    }

    .notification-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .notification-content h3 {
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 24px;
    }

    .notification-content p {
        margin-bottom: 25px;
        color: #555;
        line-height: 1.5;
    }

    /* Success styling */
    .notification-content.success h3 {
        color: #28a745;
    }

    /* Error styling */
    .notification-content.error h3 {
        color: #dc3545;
    }

    @media (max-width: 768px) {
        .modal-body {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-container {
            max-width: 100%;
        }

        .modal-content {
            height: 95vh;
        }
    }
</style>

<div class="page-header">
    <h1>Offer Packages</h1>
    <div id="notificationModal" class="notification-modal">
        <div class="notification-content" id="notificationContent">
            <h3 id="notificationTitle">Notification</h3>
            <p id="notificationMessage">Message goes here.</p>
            <button id="notificationOkBtn" class="btn-primary">OK</button>
        </div>
    </div>
    <div class="search-container">
        <svg class="search-icon" viewBox="0 0 24 24">
            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
        </svg>
        <input type="text" id="searchInput" class="search-input" placeholder="Search events by name or description...">
    </div>
</div>

<div class="events-container" id="eventsContainer"></div>

<div class="modal-overlay" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Create Package</h2>
            <button class="close-btn" id="closeModal">&times;</button>
        </div>

        <div class="modal-body">
            <div class="modal-left" id="modalEventDetails">
            </div>

            <div class="modal-right">
                <form id="packageForm">
                    <input type="hidden" id="activeEventId">

                    <div class="form-group">
                        <label>Package Name</label>
                        <input type="text" id="pkgName" placeholder="e.g. Gold Sponsorship" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="pkgDesc" rows="4" placeholder="Briefly describe this package..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Offers</label>
                        <div id="benefitsContainer"></div>
                        <button type="button" id="addBenefitBtn" class="btn-secondary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            Add Offer
                        </button>
                    </div>

                    <div class="form-group">
                        <label>Package Background Upload</label>
                        <input type="file" id="pkgBg" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select id="pkgStatus">
                            <option value="ongoing">Ongoing</option>
                            <option value="onhold">On Hold</option>
                        </select>
                    </div>
                    <div id="alreadyExistsMsg" style="display:none; color: #dc3545; background: #ffe6e6; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center; border: 1px solid #dc3545;">
                        ⚠️ You have already created a package for this event.
                    </div>
                    <button type="submit" class="btn-primary">Save Package</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let globalEvents = [];
    const container = document.getElementById("eventsContainer");
    const searchInput = document.getElementById("searchInput");

    async function loadEvents() {
        try {
            // Simulating fetch for visual purposes. Replace with your actual fetch logic.
            const response = await fetch("backend/forBackendData/sponsor_pages/getPevents.php");
            const data = await response.json();
            globalEvents = data.records || [];
            renderEvents(globalEvents);
        } catch (err) {
            console.error("Error loading events. Falling back to dummy data for demonstration:", err);

            // Fallback dummy data so you can test the UI/Search without the backend running
            globalEvents = [{
                    event_id: 1,
                    event_name: "Tech Summit 2026",
                    description: "Annual technology gathering.",
                    status: "Open",
                    location: "Convention Center",
                    start_date: "Oct 12",
                    end_date: "Oct 14",
                    start_time: "09:00 AM",
                    end_time: "05:00 PM"
                },
                {
                    event_id: 2,
                    event_name: "Art Expo",
                    description: "Showcasing modern art.",
                    status: "Ongoing",
                    location: "City Hall",
                    start_date: "Nov 01",
                    end_date: "Nov 05",
                    start_time: "10:00 AM",
                    end_time: "08:00 PM"
                },
                {
                    event_id: 3,
                    event_name: "Business Mixer",
                    description: "Networking for startups and investors.",
                    status: "Closed",
                    location: "Grand Hotel",
                    start_date: "Dec 10",
                    end_date: "Dec 10",
                    start_time: "06:00 PM",
                    end_time: "09:00 PM"
                }
            ];
            renderEvents(globalEvents);
        }
    }

    // --- RENDER & SEARCH LOGIC ---
    function renderEvents(eventsToRender) {
        container.innerHTML = "";

        if (eventsToRender.length === 0) {
            container.innerHTML = `<div class="no-results">No events found matching "${searchInput.value}".</div>`;
            return;
        }

        eventsToRender.forEach(event => {
            const eventImage = event.event_bg_picture ?
                `image_data/event_bg_picture/${event.event_bg_picture}` :
                `https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&q=80&w=800`; // Placeholder for testing

            container.innerHTML += `
                <div class="event-card" data-eventid="${event.event_id}">
                    <div class="event-banner" style="background-image:url('${eventImage}')">
                        <div class="event-overlay"></div>
                    </div>
                    
                    <div class="event-content">
                        <div class="event-title">${event.event_name}</div>
                        <div class="event-description">${event.description}</div>
                    </div>
                </div>
            `;
        });

        // Re-attach event listeners to new cards
        document.querySelectorAll(".event-card").forEach(card => {
            card.addEventListener("click", () => {
                const eventId = card.getAttribute("data-eventid");
                openModal(eventId);
            });
        });
    }

    searchInput.addEventListener("input", (e) => {
        const searchTerm = e.target.value.toLowerCase().trim();
        const filteredEvents = globalEvents.filter(event =>
            (event.event_name && event.event_name.toLowerCase().includes(searchTerm)) ||
            (event.description && event.description.toLowerCase().includes(searchTerm))
        );
        renderEvents(filteredEvents);
    });

    // --- MODAL LOGIC ---
    const modal = document.getElementById('eventModal');
    const closeModalBtn = document.getElementById('closeModal');
    const modalLeftContent = document.getElementById('modalEventDetails');

   async function openModal(eventId) {
    const event = globalEvents.find(e => e.event_id == eventId);
    
    if (event) {
        const eventImage = event.event_bg_picture ?
            `image_data/event_bg_picture/${event.event_bg_picture}` :
            `https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&q=80&w=800`;

        // Populate left side content
        modalLeftContent.innerHTML = `
            <img src="${eventImage}" alt="Event Background" class="main-img">
            <div class="event-status-badge status-${(event.status || 'ongoing').toLowerCase()}">
                ${event.status || 'Ongoing'}
            </div>
            <h3>${event.event_name}</h3>
            <div class="desc-text">${event.description}</div>
            <div class="event-info">
                <div class="event-info-item">📍 ${event.location || 'Location TBA'}</div>
                <div class="event-info-item">📅 ${event.start_date || 'TBA'} - ${event.end_date || 'TBA'}</div>
                <div class="event-info-item">⏰ ${event.start_time || 'TBA'} - ${event.end_time || 'TBA'}</div>
            </div>
        `;

        document.getElementById('activeEventId').value = eventId;

        // --- DUPLICATE CHECK LOGIC ---
        const submitBtn = packageForm.querySelector('button[type="submit"]');
        const existsMsg = document.getElementById('alreadyExistsMsg');
        
        // Initial state: Disable and hide message while checking
        submitBtn.disabled = true;
        submitBtn.textContent = "Checking...";
        if(existsMsg) existsMsg.style.display = 'none';

        try {
            // Call the new backend script
            const response = await fetch(`backend/forBackendData/sponsor_pages/check_package.php?event_id=${eventId}`);
            const data = await response.json();

            if (data.exists) {
                // If package exists, lock the form
                submitBtn.disabled = true;
                submitBtn.textContent = "Package Already Created";
                submitBtn.style.backgroundColor = "#95a5a6"; // Gray out
                submitBtn.style.cursor = "not-allowed";
                if(existsMsg) existsMsg.style.display = 'block';
            } else {
                // If no package, allow submission
                submitBtn.disabled = false;
                submitBtn.textContent = "Save Package";
                submitBtn.style.backgroundColor = ""; // Reset to original CSS
                submitBtn.style.cursor = "pointer";
                if(existsMsg) existsMsg.style.display = 'none';
            }
        } catch (err) {
            console.error("Error verifying package status:", err);
            submitBtn.disabled = false; // Fallback to allow attempt if check fails
            submitBtn.textContent = "Save Package";
        }
    }

    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

    function closeModal() {
        modal.classList.remove('show');
        document.body.style.overflow = ''; // Restore background scrolling
    }

    closeModalBtn.addEventListener('click', closeModal);
    window.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // --- DYNAMIC BENEFITS LOGIC ---
    const addBenefitBtn = document.getElementById('addBenefitBtn');
    const benefitsContainer = document.getElementById('benefitsContainer');

    addBenefitBtn.addEventListener('click', () => {
        const benefitRow = document.createElement('div');
        benefitRow.className = 'benefit-row';

        const inputField = document.createElement('input');
        inputField.type = 'text';
        inputField.className = 'benefit-input';
        inputField.placeholder = 'Enter benefit detail';
        inputField.required = true;

        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'btn-delete';
        deleteBtn.innerHTML = '&times;';
        deleteBtn.title = "Remove Benefit";

        deleteBtn.addEventListener('click', () => benefitsContainer.removeChild(benefitRow));

        benefitRow.appendChild(inputField);
        benefitRow.appendChild(deleteBtn);
        benefitsContainer.appendChild(benefitRow);

        // Focus new input automatically
        inputField.focus();
    });

    // --- FORM SUBMISSION (INTEGRATED FETCH API) ---
    const packageForm = document.getElementById('packageForm');

    packageForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // 1. Gather text data
        const eventId = document.getElementById('activeEventId').value;
        const pkgName = document.getElementById('pkgName').value;
        const pkgDesc = document.getElementById('pkgDesc').value;
        const pkgStatus = document.getElementById('pkgStatus').value;

        // Process benefits into JSON string
        const benefitInputs = document.querySelectorAll('.benefit-input');
        const benefitsArray = Array.from(benefitInputs).map(i => i.value.trim()).filter(v => v !== '');
        const benefitsJSON = JSON.stringify(benefitsArray);

        // 2. Gather file data
        const fileInput = document.getElementById('pkgBg').files[0];

        // 3. Construct FormData (Required for sending files to PHP)
        const formData = new FormData();
        formData.append('event_id', eventId);
        formData.append('package_name', pkgName);
        formData.append('description', pkgDesc);
        formData.append('benefits', benefitsJSON);
        formData.append('status', pkgStatus);

        // Placeholder for price and sponsor_id (if not handled via PHP sessions)

        if (fileInput) {
            formData.append('package_bg', fileInput);
        }

        // 4. Send to backend via Fetch
        // ... (inside your packageForm.addEventListener submit block) ...

        // 4. Send to backend via Fetch
        try {
            const submitBtn = packageForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';

            const response = await fetch("backend/forBackendData/sponsor_pages/create_package.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                // CHANGED: Use custom success modal instead of alert
                showNotification(result.message, 'success');
                closeModal(); // Close the main event modal
                packageForm.reset();
                benefitsContainer.innerHTML = '';
            } else {
                // CHANGED: Use custom error modal instead of alert
                showNotification("Failed to create package: " + result.message, 'error');
            }

        } catch (error) {
            console.error("Error submitting package:", error);
            // CHANGED: Use custom error modal instead of alert
            showNotification("An error occurred while connecting to the server.", 'error');
        } finally {
            const submitBtn = packageForm.querySelector('button[type="submit"]');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Save Package';
        }
    });

    // Init
    loadEvents();
    // --- NOTIFICATION MODAL LOGIC ---
    const notifModal = document.getElementById('notificationModal');
    const notifTitle = document.getElementById('notificationTitle');
    const notifMessage = document.getElementById('notificationMessage');
    const notifContent = document.getElementById('notificationContent');
    const notifOkBtn = document.getElementById('notificationOkBtn');

    function showNotification(message, type = 'success') {
        // Set text and colors based on success or error
        if (type === 'success') {
            notifTitle.textContent = 'Success!';
            notifContent.className = 'notification-content success';
        } else {
            notifTitle.textContent = 'Error';
            notifContent.className = 'notification-content error';
        }

        notifMessage.textContent = message;
        notifModal.classList.add('show');
    }

    // Close the notification modal when clicking OK
    notifOkBtn.addEventListener('click', () => {
        notifModal.classList.remove('show');
    });
</script>