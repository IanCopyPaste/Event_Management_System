<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --primary: #2773ff;
        --success: #22c55e;
        --danger: #ef4444;
        --warning: #f59e0b;
        --gray: #64748b;
        --border: #e2e8f0;
    }

    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: #f8fafc;
        color: #1e293b;
        padding: 40px 20px;
    }

    .container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
    }

    th {
        background: #fcfcfc;
        padding: 16px;
        text-align: left;
        font-size: 0.75rem;
        text-transform: uppercase;
        color: var(--gray);
        font-weight: 600;
        border-bottom: 1px solid var(--border);
    }

    td {
        padding: 16px;
        border-bottom: 1px solid var(--border);
        font-size: 0.95rem;
    }

    tr:last-child td {
        border-bottom: none;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-ongoing {
        background: #fef9c3;
        color: #854d0e;
    }

    .status-finished {
        background: #f1f5f9;
        color: #475569;
    }

    .status-open {
        background: #dcfce7;
        color: #166534;
    }

    .status-closed {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-cancelled {
        background: #334155;
        color: #f8fafc;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .btn-view {
        background: var(--primary);
        color: white;
    }

    .btn-view:hover {
        background: #1d5ed8;
    }

    .btn-resched {
        background: var(--warning);
        color: white;
        margin-left: 5px;
    }

    .modal {
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
        background: white;
        max-width: 750px;
        width: 100%;
        max-height: 90vh;
        border-radius: 16px;
        padding: 32px;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        align-content: start;
    }

    .full {
        grid-column: span 2;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    label {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--gray);
        text-transform: uppercase;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        background: #fff;
    }

    input:focus,
    textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(39, 115, 255, 0.1);
    }

    input:disabled,
    textarea:disabled,
    select:disabled {
        background: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    .restriction-box {
        padding: 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid var(--border);
        min-height: 45px;
    }

    .tag {
        display: inline-block;
        background: #e2e8f0;
        color: #475569;
        padding: 2px 8px;
        border-radius: 4px;
        margin: 2px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .modal-footer {
        margin-top: 32px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }
</style>

<div class="container">
    <div class="header">
        <h2>Your Events</h2>
        <button class="btn btn-view" onclick="fetchData()">Reload</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Event & Schedule</th>
                <th>Approval</th>
                <th>Live Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="eventsTableBody"></tbody>
    </table>
</div>

<div id="eventModal" class="modal">
    <div class="modal-content">
        <h2 id="modalTitle" style="margin-bottom: 24px; font-size: 1.5rem;">Event Details</h2>
        <div class="form-grid" id="modalForm">
            <div class="form-group full"><label>Event Name</label><input type="text" id="m_name"></div>
            <div class="form-group full"><label>Description</label><textarea id="m_desc" rows="3"></textarea></div>
            <div class="form-group"><label>Location</label><input type="text" id="m_loc"></div>
            <div class="form-group"><label>Total Capacity</label><input type="number" id="m_cap"></div>
            <div class="form-group"><label>Start Date</label><input type="date" id="m_sd"></div>
            <div class="form-group"><label>End Date</label><input type="date" id="m_ed"></div>
            <div class="form-group"><label>Start Time</label><input type="time" id="m_st"></div>
            <div class="form-group"><label>End Time</label><input type="time" id="m_et"></div>
            <div class="form-group full"><label>Registration Deadline</label><input type="datetime-local" id="m_dl"></div>

            <div class="form-group">
                <label>Restricted Level/s</label>
                <div class="restriction-box" id="m_year_list"></div>
            </div>
            <div class="form-group">
                <label>Restricted Program/s</label>
                <div class="restriction-box" id="m_prog_list"></div>
            </div>

            <div id="statusArea" class="form-group full" style="display:none; padding:16px; background:#eff6ff; border: 1px solid #bfdbfe; border-radius:10px;">
                <label style="color:var(--primary)">Quick Status Action</label>
                <select id="m_status_select"></select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" style="background:#f1f5f9; color:#475569;" onclick="closeModal()">Close</button>
            <button id="saveBtn" class="btn btn-view">Apply Changes</button>
        </div>
    </div>
</div>

<script>
    let currentEvents = [];
    let programMap = {};
    
    async function fetchData() {
        const res = await fetch('backend/forBackendData/organizerNevents/manage/fetch_events.php');
        const data = await res.json();
        currentEvents = data.events;
        
        // FIXED: Changed p.prog_abbreviation to p.prog_abv to match your JSON payload
        data.programs.forEach(p => programMap[p.program_id] = p.prog_abv);
        
        renderTable();
    }

    function renderTable() {
        const body = document.getElementById('eventsTableBody');
        body.innerHTML = currentEvents.map(e => `
        <tr>
            <td><div style="font-weight:600">${e.event_name}</div><div style="font-size:0.8rem; color:var(--gray)">${e.start_date} @ ${e.start_time}</div></td>
            <td><span class="badge" style="background:#f0f9ff;color:#0369a1;border:1px solid #bae6fd">${e.approval_status}</span></td>
            <td><span class="badge status-${e.status}">${e.status}</span></td>
            <td>
                <button class="btn btn-view" onclick="openModal(${e.event_id})">Manage</button>
                ${e.status === 'cancelled' ? `<button class="btn btn-resched" onclick="initResched(${e.event_id})">Reschedule</button>` : ''}
            </td>
        </tr>
    `).join('');
    }

    function openModal(id) {
        const e = currentEvents.find(x => x.event_id == id);
        const modal = document.getElementById('eventModal');
        const statusSelect = document.getElementById('m_status_select');

        document.getElementById('m_name').value = e.event_name;
        document.getElementById('m_desc').value = e.description;
        document.getElementById('m_loc').value = e.location;
        document.getElementById('m_cap').value = e.capacity;
        document.getElementById('m_sd').value = e.start_date;
        document.getElementById('m_ed').value = e.end_date;
        document.getElementById('m_st').value = e.start_time;
        document.getElementById('m_et').value = e.end_time;
        document.getElementById('m_dl').value = e.registration_deadline.replace(' ', 'T');

        const rest = JSON.parse(e.restrictions);
        document.getElementById('m_year_list').innerHTML = rest.year_level.map(y => `<span class="tag">${y}</span>`).join('') || 'None';
        
        // This will now successfully pull the abbreviation from programMap
        document.getElementById('m_prog_list').innerHTML = rest.programs.map(p => `<span class="tag">${programMap[p] || p}</span>`).join('') || 'None';

        const isPending = e.approval_status === 'pending';
        const isApproved = e.approval_status === 'approved';
        const isOngoing = e.status === 'ongoing';
        const isFinished = e.status === 'finished';

        const inputs = document.querySelectorAll('#modalForm input, #modalForm textarea');
        inputs.forEach(i => i.disabled = !isPending);

        document.getElementById('statusArea').style.display = (isApproved && !isFinished) ? 'block' : 'none';

        statusSelect.innerHTML = '';
        if (isOngoing) {
            statusSelect.innerHTML = `<option value="ongoing">Event is Ongoing</option><option value="cancelled">Cancel Now</option>`;
            statusSelect.disabled = false;
        } else if (isApproved) {
            statusSelect.innerHTML = `<option value="open">Open</option><option value="closed">Closed</option><option value="cancelled">Cancelled</option>`;
            statusSelect.value = e.status;
            statusSelect.disabled = false;
        }

        const saveBtn = document.getElementById('saveBtn');
        saveBtn.style.display = isFinished ? 'none' : 'block';
        saveBtn.onclick = () => submitUpdate(id, isPending ? 'update_full' : 'update_status');

        modal.style.display = 'flex';
    }

    function initResched(id) {
        openModal(id);
        document.getElementById('modalTitle').innerText = 'Reschedule Application';
        document.querySelectorAll('#modalForm input').forEach(i => i.disabled = true);
        ['m_sd', 'm_ed', 'm_st', 'm_et', 'm_dl'].forEach(k => document.getElementById(k).disabled = false);
        document.getElementById('statusArea').style.display = 'none';
        document.getElementById('saveBtn').onclick = () => submitUpdate(id, 'reschedule');
    }

    async function submitUpdate(id, action) {
        if(document.getElementById('m_cap').value > 500 || document.getElementById('m_cap').value < 0) {
            alert("Capacity cannot be less than 0 or greater than 500.");
            return;
        }
        
        const payload = {
            event_id: id,
            action: action,
            event_name: document.getElementById('m_name').value,
            description: document.getElementById('m_desc').value,
            location: document.getElementById('m_loc').value,
            capacity: document.getElementById('m_cap').value,
            start_date: document.getElementById('m_sd').value,
            end_date: document.getElementById('m_ed').value,
            start_time: document.getElementById('m_st').value,
            end_time: document.getElementById('m_et').value,
            registration_deadline: document.getElementById('m_dl').value,
            status: document.getElementById('m_status_select').value
        };

        const res = await fetch('backend/forBackendData/organizerNevents/manage/update_event_logic.php', {
            method: 'POST',
            body: JSON.stringify(payload)
        });
        const result = await res.json();
        if (result.status) {
            closeModal();
            fetchData();
        } else {
            alert(result.message);
        }
    }

    function closeModal() {
        document.getElementById('eventModal').style.display = 'none';
    }
    
    fetchData();
    setInterval(fetchData, 60000);
</script>