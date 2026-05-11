<style>
    :root {
        --surface: #ffffff;
        --border: #e2e8f0;
        --text-main: #1e293b;
        --text-muted: #64748b;
    }

    body {
        font-family: system-ui, -apple-system, sans-serif;
        background-color: #f8fafc;
        color: var(--text-main);
        padding: 20px;
    }

    .sponsor-container {
        max-width: 1200px;
        margin: 0 auto;
        background: var(--surface);
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
        gap: 15px;
    }

    .header-actions h2 {
        margin: 0;
        font-size: 1.5rem;
    }

    .filter-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: 8px;
        outline: none;
        font-size: 0.9rem;
    }

    .filter-group input {
        min-width: 250px;
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .modern-table th,
    .modern-table td {
        padding: 16px;
        border-bottom: 1px solid var(--border);
    }

    .modern-table th {
        background-color: #f1f5f9;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    .modern-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .event-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .org-thumb-small {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid var(--border);
        background: #fff;
    }

    .truncate-text {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
        display: inline-block;
    }

    /* Approval Status Colors */
    .b-pending {
        background: #fef08a;
        color: #854d0e;
    }

    .b-approved {
        background: #bbf7d0;
        color: #166534;
    }

    .b-rejected {
        background: #fecaca;
        color: #991b1b;
    }

    .b-completed {
        background: #e0e7ff;
        color: #3730a3;
    }

    /* Live Status Colors */
    .s-ongoing {
        background: #dcfce7;
        color: #166534;
    }

    .s-onhold {
        background: #fed7aa;
        color: #9a3412;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: var(--text-muted);
    }

    /* Modal Base */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .modal-content {
        background: var(--surface);
        border-radius: 16px;
        width: 100%;
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .modal-banner {
        width: 100%;
        height: 180px;
        flex-shrink: 0;
        background-color: #cbd5e1;
        background-size: cover;
        background-position: center;
        border-radius: 16px 16px 0 0;
        position: relative;
    }

    .modal-banner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        border-radius: 16px 16px 0 0;
    }

    .banner-text {
        position: absolute;
        bottom: 20px;
        left: 30px;
        z-index: 2;
        color: white;
    }

    .banner-text h2 {
        font-size: 1.8rem;
        margin-bottom: 4px;
    }

    .banner-text p {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .modal-close {
        position: absolute;
        top: 15px;
        right: 20px;
        cursor: pointer;
        font-size: 1.5rem;
        color: #fff;
        z-index: 10;
        background: rgba(0, 0, 0, 0.4);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-body {
        padding: 30px;
    }

    .grid-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-card {
        background: #f8fafc;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .info-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        border-bottom: 1px solid var(--border);
        padding-bottom: 10px;
    }

    .info-card-header h4 {
        margin: 0;
        font-size: 1.1rem;
        color: var(--text-main);
    }

    .info-row {
        margin-bottom: 8px;
        font-size: 0.9rem;
        display: flex;
    }

    .info-row strong {
        color: var(--text-muted);
        width: 100px;
        flex-shrink: 0;
    }

    .btn-secondary {
        background: #cbd5e1;
        color: #334155;
    }

    .btn:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }

    /* ✨ Majestic Buttons */
    .btn-majestic {
        padding: 10px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
    }

    .btn-majestic:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        box-shadow: none;
        filter: grayscale(80%);
        transform: none !important;
    }

    .btn-onhold {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        /* Amber/Orange Gradient */
    }

    .btn-onhold:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(217, 119, 6, 0.4);
    }

    .btn-ongoing {
        background: linear-gradient(135deg, #10b981, #059669);
        /* Emerald Gradient */
    }

    .btn-ongoing:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(5, 150, 105, 0.4);
    }

    /* 📝 Beautiful List Styling */
    .majestic-list {
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
    }

    .majestic-list li {
        position: relative;
        padding-left: 24px;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.4;
    }

    .majestic-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 0;
        color: #3b82f6;
        /* Blue checkmark */
        font-weight: bold;
    }

    /* 🎨 Event Status Colors */
    .s-open {
        background: #dbeafe;
        color: #1e40af;
    }

    /* Blue */
    .s-closed {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Red */
    .s-finished {
        background: #e0e7ff;
        color: #3730a3;
    }

    /* Indigo */
    .s-rescheduled {
        background: #fef3c7;
        color: #92400e;
    }

    /* Amber */
    .s-cancelled {
        background: #f3f4f6;
        color: #374151;
    }

    /* Dark Gray */
    @media (max-width: 768px) {
        .grid-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="sponsor-container">
    <div class="header-actions">
        <h2>My Package Offers</h2>
        <div class="filter-group">
            <input type="text" id="packageSearch" placeholder="Search package or event name...">

            <select id="sortOrder">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
            </select>

            <select id="statusFilter">
                <option value="">All Approvals</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Event & Organizer</th>
                    <th>Package Name</th>
                    <th>Benefits</th>
                    <th>Date Offered</th>
                    <th>Approval Status</th>
                    <th>Live Status</th>
                </tr>
            </thead>
            <tbody id="packageTableBody">
            </tbody>
        </table>
    </div>
</div>
<div id="detailsModal" class="modal-overlay">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal('detailsModal')">&times;</span>

        <div class="modal-banner" id="d_banner">
            <div class="banner-text">
                <h2 id="d_event_name"></h2>
                <p>📍 <span id="d_loc"></span></p>
            </div>
        </div>

        <div class="modal-body">
            <div class="grid-layout">
                <div class="info-card" style="border-left: 4px solid #3b82f6;">
                    <div class="info-card-header">
                        <h4>🎁 Your Package Info</h4>
                    </div>
                    <div class="info-row"><strong>Package:</strong> <span id="d_pkg_name"></span></div>
                    <div class="info-row"><strong>Approval:</strong> <span id="d_pkg_approval" class="badge"></span></div>
                    <div class="info-row"><strong>Live Status:</strong> <span id="d_pkg_status" class="badge"></span></div>
                    <div style="margin-top: 10px; border-top: 1px dashed var(--border); padding-top: 10px;">
                        <strong>Description:</strong>
                        <p id="d_pkg_desc" style="font-size: 0.9rem; color: #475569; margin-top: 5px;"></p>
                    </div>
                    <div style="margin-top: 15px;">
                        <strong style="color: var(--text-main);">✨ Package Benefits:</strong>
                        <ul id="d_pkg_benefits" class="majestic-list"></ul>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <img id="d_org_logo" src="" alt="Org Logo" class="org-logo" style="height: 50px; width: 50px; border-radius:500px;">
                        <h4>🗓 Event & Organizer</h4>
                    </div>
                    <div class="info-row"><strong>Organizer:</strong> <span id="d_org_name"></span></div>
                    <div class="info-row"><strong>Email:</strong> <span id="d_org_email"></span></div>
                    <div class="info-row" style="margin-bottom: 15px;"><strong>Contact:</strong> <span id="d_org_contact"></span></div>

                    <div class="info-row"><strong>Event Approval:</strong> <span id="d_evt_approval" class="badge"></span></div>

                    <div class="info-row"><strong>Event Status:</strong> <span id="d_evt_status" class="badge"></span></div>
                    <div class="info-row"><strong>Start:</strong> <span id="d_start"></span></div>
                    <div class="info-row"><strong>End:</strong> <span id="d_end"></span></div>
                    <div class="info-row"><strong>Capacity:</strong> <span id="d_cap"></span></div>
                </div>
            </div>

            <div class="actions-panel" style="display: flex; flex-direction: column; align-items: flex-end; margin-top: 20px;">
                <div id="statusExplanation" style="color: #b91c1c; font-size: 0.85rem; margin-bottom: 10px; font-weight: 500; display: none;">
                </div>
                <div style="display: flex; gap: 12px;">
                    <button id="btnOnhold" class="btn-majestic btn-onhold">⏸ Set On-Hold</button>
                    <button id="btnOngoing" class="btn-majestic btn-ongoing">▶️ Set Ongoing</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let sponsorPackages = [];
    const placeholderImg = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSIjZTJlOGYwIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIvPjwvc3ZnPg==";

    function formatDate(dateStr) {
        if (!dateStr) return 'N/A';
        const d = new Date(dateStr);
        if (isNaN(d)) return dateStr;
        return d.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }

    async function fetchSponsorData() {
        try {
            // IMPORTANT: Adjust the path to where you saved the PHP file
            const res = await fetch('backend/forBackendData/sponsor_pages/manage/fetch_sponsor_packages.php');
            const data = await res.json();

            if (data.error) {
                console.error(data.error);
                document.getElementById('packageTableBody').innerHTML = `<tr><td colspan="6" class="empty-state">${data.error}</td></tr>`;
                return;
            }

            sponsorPackages = data;
            renderPackageTable();
        } catch (err) {
            console.error("Failed to fetch packages", err);
            document.getElementById('packageTableBody').innerHTML = `<tr><td colspan="6" class="empty-state">Failed to load data.</td></tr>`;
        }
    }

    function renderPackageTable() {
        const searchTerm = document.getElementById('packageSearch').value.toLowerCase();
        const sortOrder = document.getElementById('sortOrder').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const body = document.getElementById('packageTableBody');

        let filtered = [...sponsorPackages];

        // 1. Search Filter
        if (searchTerm) {
            filtered = filtered.filter(p =>
                (p.package_name && p.package_name.toLowerCase().includes(searchTerm)) ||
                (p.event_name && p.event_name.toLowerCase().includes(searchTerm))
            );
        }

        // 2. Status Filter
        if (statusFilter) {
            filtered = filtered.filter(p => p.approval_status === statusFilter);
        }

        // 3. Sorting (Note: Changed created_at to package_created to match your updated backend)
        filtered.sort((a, b) => {
            const dateA = new Date(a.package_created);
            const dateB = new Date(b.package_created);
            return sortOrder === 'newest' ? dateB - dateA : dateA - dateB;
        });

        body.innerHTML = '';

        if (filtered.length === 0) {
            body.innerHTML = '<tr><td colspan="6" class="empty-state">No packages match your search criteria.</td></tr>';
            return;
        }

        filtered.forEach(p => {
            const orgLogo = p.org_logo ? `image_data/org_logo/${p.org_logo}` : 'image_data/org_logo/profileImg.png';

            const tr = document.createElement('tr');

            // 👇 --- THESE ARE THE TWO LINES YOU NEED TO ADD --- 👇
            tr.style.cursor = 'pointer';
            tr.onclick = () => openDetails(p.package_id);
            // 👆 ----------------------------------------------- 👆

            tr.innerHTML = `
            <td>
                <div class="event-cell">
                    <img src="${orgLogo}" class="org-thumb-small" alt="Org Logo" onerror="this.src='${placeholderImg}'">
                    <div>
                        <div style="font-weight:600; color:var(--text-main);">${p.event_name}</div>
                        <small style="color:var(--text-muted)">${p.org_name}</small>
                    </div>
                </div>
            </td>
            <td><strong>${p.package_name}</strong></td>
            <td><div class="truncate-text" title="${p.benefits}">${p.benefits || 'No benefits listed'}</div></td>
            <td>${formatDate(p.package_created)}</td> <td><span class="badge b-${p.approval_status || 'pending'}">${p.approval_status || 'Pending'}</span></td>
            <td><span class="badge s-${p.package_live_status || 'onhold'}">${p.package_live_status || 'N/A'}</span></td>
        `;
            body.appendChild(tr);
        });
    }

    // Event Listeners
    document.getElementById('packageSearch').addEventListener('input', renderPackageTable);
    document.getElementById('sortOrder').addEventListener('change', renderPackageTable);
    document.getElementById('statusFilter').addEventListener('change', renderPackageTable);

    // Initialize
    window.onload = fetchSponsorData;
    let selectedPackageId = null;

    // Add this to your renderPackageTable() loop to make the row clickable:
    // Replace the current `const tr = document.createElement('tr');` with:
    // tr.style.cursor = 'pointer';
    // tr.onclick = () => openDetails(p.package_id);

    function openDetails(id) {
        const p = sponsorPackages.find(x => x.package_id == id);
        selectedPackageId = id;

        // 1. Populate Event & Org Data
        const bannerUrl = p.event_bg_picture ? `image_data/event_bg_picture/${p.event_bg_picture}` : placeholderImg;
        document.getElementById('d_banner').style.backgroundImage = `url('${bannerUrl}')`;
        document.getElementById('d_org_logo').src = p.org_logo ? `image_data/org_logo/${p.org_logo}` : 'image_data/org_logo/profileImg.png';

        document.getElementById('d_event_name').innerText = p.event_name;
        document.getElementById('d_loc').innerText = p.location;
        document.getElementById('d_org_name').innerText = p.org_name;
        document.getElementById('d_org_email').innerText = p.org_email;
        document.getElementById('d_org_contact').innerText = p.org_contact_no;

        document.getElementById('d_start').innerText = `${formatDate(p.start_date)} @ ${p.start_time}`;
        document.getElementById('d_end').innerText = `${formatDate(p.end_date)} @ ${p.end_time}`;
        document.getElementById('d_cap').innerText = `${p.slot_taken || 0} / ${p.capacity}`;

        // 👉 NEW: Set Event Approval Status Badge
        const evtAppEl = document.getElementById('d_evt_approval');
        evtAppEl.innerText = p.event_approval_status || 'Pending';
        evtAppEl.className = `badge b-${p.event_approval_status || 'pending'}`;

        const evtStatusEl = document.getElementById('d_evt_status');
        evtStatusEl.innerText = p.event_live_status;
        evtStatusEl.className = `badge s-${p.event_live_status}`;

        // 2. Populate Package Data
        document.getElementById('d_pkg_name').innerText = p.package_name;
        document.getElementById('d_pkg_desc').innerText = p.package_description || 'No description provided.';

        // Smart Benefits Formatter
        const benefitsContainer = document.getElementById('d_pkg_benefits');
        if (p.benefits && p.benefits.trim() !== "") {
            const benefitsArray = p.benefits.split(/[,|\n]+/).filter(b => b.trim() !== '');
            benefitsContainer.innerHTML = benefitsArray.map(b => `<li>${b.trim()}</li>`).join('');
        } else {
            benefitsContainer.innerHTML = '<li>No specific benefits listed.</li>';
        }

        const pkgAppEl = document.getElementById('d_pkg_approval');
        pkgAppEl.innerText = p.approval_status;
        pkgAppEl.className = `badge b-${p.approval_status}`;

        const pkgStatEl = document.getElementById('d_pkg_status');
        pkgStatEl.innerText = p.package_live_status;
        pkgStatEl.className = `badge s-${p.package_live_status}`;

        // 3. Logic to Disable/Enable Action Buttons
        // 3. Logic to Disable/Enable Action Buttons
        const btnOnhold = document.getElementById('btnOnhold');
        const btnOngoing = document.getElementById('btnOngoing');
        const explanationDiv = document.getElementById('statusExplanation');

        // Check Event Statuses
        const badEventStatuses = ['cancelled', 'finished', 'ongoing'];
        const currentEvtStatus = p.event_live_status ? p.event_live_status.toLowerCase() : '';
        const currentEvtAppStatus = p.event_approval_status ? p.event_approval_status.toLowerCase() : 'pending';

        // Check Package Status
        const currentPkgStatus = p.package_live_status ? p.package_live_status.toLowerCase() : '';

        const isEventRestricted = badEventStatuses.includes(currentEvtStatus);
        const isEventApprovalNotPending = currentEvtAppStatus !== 'pending';

        // FIRST: Check if the EVENT rules lock everything
        if (isEventRestricted || isEventApprovalNotPending) {
            btnOnhold.disabled = true;
            btnOngoing.disabled = true;

            let reasons = [];
            if (isEventRestricted) reasons.push(`event status is currently '${currentEvtStatus}'`);
            if (isEventApprovalNotPending) reasons.push(`event approval is '${currentEvtAppStatus}' (not pending)`);

            explanationDiv.innerText = `Action disabled because the ${reasons.join(' and ')}.`;
            explanationDiv.style.display = 'block';
        }
        // SECOND: If event rules pass, disable only the button that matches the current status
        else {
            btnOnhold.disabled = (currentPkgStatus === 'onhold');
            btnOngoing.disabled = (currentPkgStatus === 'ongoing');

            // Hide the explanation div since there's no major error
            explanationDiv.style.display = 'none';

            // Optional: If you want to explain why a specific button is grayed out, you could uncomment this:
            // if (currentPkgStatus === 'onhold' || currentPkgStatus === 'ongoing') {
            //     explanationDiv.innerText = `Package is already ${currentPkgStatus}.`;
            //     explanationDiv.style.color = '#475569'; // Soft gray instead of red
            //     explanationDiv.style.display = 'block';
            // }
        }

        // Assign click functions for DB Updates
        btnOnhold.onclick = () => updatePackageStatus('onhold');
        btnOngoing.onclick = () => updatePackageStatus('ongoing');

        document.getElementById('detailsModal').style.display = 'flex';
    }

    async function updatePackageStatus(newStatus) {
        if (!confirm(`Are you sure you want to change your package status to ${newStatus}?`)) return;

        try {
            const res = await fetch('backend/forBackendData/sponsor_pages/manage/update_package_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    package_id: selectedPackageId,
                    status: newStatus
                })
            });

            const data = await res.json();

            if (data.success) {
                alert(data.message);
                closeModal('detailsModal');
                fetchSponsorData(); // Refresh the table
            } else {
                alert(data.message || "An error occurred.");
            }
        } catch (err) {
            console.error(err);
            alert("Failed to connect to the server.");
        }
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>