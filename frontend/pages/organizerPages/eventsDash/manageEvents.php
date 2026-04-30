<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    .orgsApply-container {
        width: 100%;
        margin-top: 30px;
    }

    .utilities-container {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0px 10px;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .field label {
        font-size: 12px;
        font-weight: 600;
    }

    .utilities-container select,
    .utilities-container input {
        padding: 10px 12px;
        border: 1px solid #cfe8ff;
        border-radius: 6px;
        outline: none;
    }

    .utilities-container select:focus,
    .utilities-container input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
    }

    #txtSearchbar {
        margin-left: auto;
        width: 240px;
    }

    .utilities-container select:hover,
    .utilities-container input:hover {
        border-color: #b0b0b0;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #cfe8ff;
    }

    .orgApplication-table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
    }

    .orgApplication-table thead {
        background: rgba(0, 65, 156, 1);
    }

    .orgApplication-table tbody {
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .orgApplication-table th {
        padding: 12px;
        text-align: left;
        font-size: 13px;
        color: #ffffff;
        border-bottom: 1px solid #cfe8ff;
    }

    .orgApplication-table td {
        padding: 12px;
        font-size: 13px;
        color: #334155;
        border-bottom: 1px solid #e0f0ff;
        max-width: 200px;
    }

    .orgApplication-table td button {
        padding: 5px 10px;
        background-color: rgba(0, 65, 156, 1);
        color: white;
        border: none;
        border-radius: 3px;
        outline: none;
    }

    .orgApplication-table td button:hover {
        cursor: pointer;
    }

    .orgApplication-table tbody tr:hover {
        background: #f0f8ff;
    }

    .empty {
        text-align: center;
        color: #60a5fa;
        padding: 20px;
    }

    .orgInfo-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 90vh;
        width: 60%;
        background-color: white;
        border-radius: 14px;
        border: 1px solid rgba(83, 155, 255, 0.3);
        box-shadow: 0 20px 40px rgba(0, 65, 156, 0.2);
        display: none;
        flex-direction: column;
        overflow: hidden;
    }

    .btnCloseModal {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 1.3rem;
        background: transparent;
        border: none;
        color: rgba(0, 65, 156, 1);
    }

    .btnCloseModal:hover {
        cursor: pointer;
        opacity: 0.7;
    }

    .allOrgInfo-container {
        padding: 30px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .allOrgInfo-container input {
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid rgba(117, 117, 117, 0.3);
        background: #ffffff;
        color: rgb(0, 0, 0);
        font-size: 13px;
    }

    .file-preview {
        grid-column: span 2;
        height: 600px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid rgba(83, 155, 255, 0.3);
    }

    .file-preview iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .btnDownload {
        grid-column: span 2;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background: rgba(83, 155, 255, 1);
        color: white;
        font-weight: 600;
        cursor: pointer;
    }

    .btnDownload:hover {
        background: rgba(0, 65, 156, 1);
    }

    .approvalUtil-container {
        padding: 16px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid rgba(83, 155, 255, 0.2);
    }

    .approvalUtil-container button {
        padding: 10px 18px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
    }

    .approvalUtil-container p {
        color: red;
        margin-right: 10px;
        visibility: hidden;
    }

    .btnApprove {
        background: rgb(77, 160, 0);
        color: white;
    }

    .btnReject {
        background: rgb(211, 0, 0);
        color: white;
    }

    .btnCancel {
        background: white;
        border: 1px solid rgba(83, 155, 255, 0.5);
        color: rgb(0, 0, 0);
    }

    .btnApprove:hover {
        opacity: 0.9;
    }

    .btnReject:hover {
        opacity: 0.9;
    }

    .btnCancel:hover {
        background: rgba(83, 155, 255, 0.1);
    }

    .btnDownloadDisabled {
        grid-column: span 2;
        padding: 12px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        background-color: grey;
        color: black;
    }

    .btnDisabled {
        background-color: grey;
        cursor: not-allowed;
    }
    .manage-events{
        margin: 20px 0px;
        font-size: 27px;
        font-weight: 600;
        color: rgba(0, 65, 156, 1);
    }
</style>

<div class="orgsApply-container">
    <div class="utilities-container">
        <div class="field">
            <label for="sortByNewest">Sort By Date/Name</label>
            <select id="sortByNewest">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="az">Organization Name (A-Z)</option>
                <option value="za">Organization Name (Z-A)</option>
            </select>
        </div>

        <div class="field">
            <label for="sortByStatus">Filter By Status</label>
            <select id="sortByStatus">
                <option value="all">🌏 All</option>
                <option value="pending">🟡 Pending</option>
                <option value="approved">🟢 Approved</option>
                <option value="rejected">🔴 Rejected</option>
            </select>
        </div>

        <input type="text" id="txtSearchbar" placeholder="Search...">
    </div>

    <table class="orgApplication-table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Org name</th>
                <th>Department Name</th>
                <th>Location</th>
                <th>Starting Date</th>
                <th>Capacity</th>
                <th>Approval Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="empty">
                <td colspan="8">No data available</td>
            </tr>
        </tbody>
    </table>
</div>
</div>

<div class="orgInfo-modal">
    <h3 style="margin:20px">Event Review Panel</h3>
    <button class="btnCloseModal">✕</button>

    <div class="allOrgInfo-container">
        <label>Event ID</label>
        <input id="txtEvent_id" readonly>

        <label>Event Name</label>
        <input id="txtEvent_name" readonly>

        <label>Description</label>
        <input id="txtDescription" readonly>

        <label>Location</label>
        <input id="txtLocation" readonly>

        <label>Start</label>
        <input id="txtStart" readonly>

        <label>End</label>
        <input id="txtEnd" readonly>

        <label>Registration Deadline</label>
        <input id="txtDeadline" readonly>

        <label>Capacity</label>
        <input id="txtCapacity" readonly>

        <label>Slots Taken</label>
        <input id="txtSlots" readonly>

        <label>Restrictions</label>
        <input id="txtRestrictions" readonly>

        <label>Organization</label>
        <input id="txtOrg_name" readonly>

        <label>Email</label>
        <input id="txtOrg_email" readonly>

        <label>Contact</label>
        <input id="txtOrg_contact_no" readonly>

        <label>Department</label>
        <input id="txtDepartment_name" readonly>

        <label>Submitted At</label>
        <input id="txtCreated_at" readonly>

        <label>Status</label>
        <input id="txtStatus" readonly>
    </div>

    <div class="approvalUtil-container">
        <p>The application has been decided</p>
        <button class="btnApprove">Approve</button>
        <button class="btnReject">Reject</button>
        <button class="btnCancel">Cancel</button>
    </div>
</div>

<script>
    const tableBody = document.querySelector(".orgApplication-table tbody");
const sortByNewest = document.querySelector("#sortByNewest");
const sortByStatus = document.querySelector("#sortByStatus");
const txtSearchbar = document.querySelector("#txtSearchbar");

const modal = document.querySelector(".orgInfo-modal");
const btnCloseModal = document.querySelector(".btnCloseModal");
const btnCancelModal = document.querySelector(".btnCancel");
const btnApprove = document.querySelector(".btnApprove");
const btnReject = document.querySelector(".btnReject");
const statusText = document.querySelector(".approvalUtil-container p");

let selectedApp = {
    id: null,
    email: null,
    orgName: null,
    organizerName: null,
    organizerId: null,
    event_name: null
};

function formatDateTime(dt) {
    if (!dt) return "";
    const d = new Date(dt);
    return d.toLocaleString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit"
    });
}

document.addEventListener("DOMContentLoaded", loadOrgApplications);

async function loadOrgApplications() {
    const res = await fetch("backend/forBackendData/adminNevents/getEvents.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ event_id: null })
    });
    const data = await res.json();
    renderTable(data.records);
}

function renderTable(records) {
    tableBody.innerHTML = "";
    if (!records || records.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="8">No data available</td></tr>`;
        return;
    }
    records.forEach(e => {
        tableBody.innerHTML += `
        <tr>
            <td>${e.event_name}</td>
            <td>${e.org_name}</td>
            <td style="word-break: break-all; max-width: 180px;">${e.department_name}</td>
            <td>${e.location}</td>
            <td>${formatDateTime(e.start_date)} - ${formatDateTime(e.end_date)}</td>
            <td>${e.slot_taken} / ${e.capacity}</td>
            <td>${e.approval_status}</td>
            <td><button data-id="${e.event_id}">⌕ View</button></td>
        </tr>`;
    });
}

tableBody.addEventListener("click", e => {
    if (e.target.tagName === "BUTTON") {
        selectedApp.id = e.target.dataset.id;
        modal.style.display = "flex";
        fetchSpecificApplication(selectedApp.id);
    }
});

btnCloseModal.onclick = () => modal.style.display = "none";
btnCancelModal.onclick = () => modal.style.display = "none";
btnApprove.onclick = () => updateStatus("approved", selectedApp.id);
btnReject.onclick = () => updateStatus("rejected");

async function fetchSpecificApplication(id) {
    const res = await fetch("backend/forBackendData/adminNevents/getSpecificEvents.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ event_id: id })
    });

    const d = await res.json();
    const r = d.records;

    const restrictions = JSON.parse(r.restrictions);
    const resYearLevel = restrictions.year_level;

    txtRestrictions.value = "";

    txtEvent_id.value = r.event_id;
    txtEvent_name.value = r.event_name;
    txtDescription.value = r.description;
    txtLocation.value = r.location;
    txtStart.value = formatDateTime(r.start_date + " " + r.start_time);
    txtEnd.value = formatDateTime(r.end_date + " " + r.end_time);
    txtDeadline.value = formatDateTime(r.registration_deadline);
    txtCapacity.value = r.capacity;
    txtSlots.value = r.slot_taken;

    resYearLevel.forEach(element => {
        txtRestrictions.value += element + " ";
    });

    txtOrg_name.value = r.org_name;
    txtOrg_email.value = r.org_email;
    txtOrg_contact_no.value = r.org_contact_no;
    txtDepartment_name.value = r.department_name;
    txtCreated_at.value = formatDateTime(r.event_created_at);
    txtStatus.value = r.approval_status;

    selectedApp.email = r.org_email;
    selectedApp.orgName = r.org_name;
    selectedApp.event_name = r.event_name;

    const isPending = r.approval_status === "pending";

    btnApprove.disabled = !isPending;
    btnReject.disabled = !isPending;

    btnApprove.classList.toggle("btnDisabled", !isPending);
    btnReject.classList.toggle("btnDisabled", !isPending);

    statusText.style.visibility = isPending ? "hidden" : "visible";
}

async function updateStatus(status, event_id) {
    btnApprove.disabled = true;
    btnReject.disabled = true;
    btnApprove.classList.add("btnDisabled");
    btnReject.classList.add("btnDisabled");

    const response = await fetch("backend/forBackendData/adminNevents/updateEventsStatus.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            status: status,
            event_id: selectedApp.id
        })
    });

    const data = await response.json();

    await sendStatusToEmail(status);

    alert(data.message);
    location.reload();
}

async function fetchWithFilters() {
    const res = await fetch("backend/forBackendData/adminNevents/utilitiesFetch.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            sortNewest: sortByNewest.value,
            sortStatus: sortByStatus.value,
            txtSearch: txtSearchbar.value
        })
    });
    const data = await res.json();
    renderTable(data.record);
}

sortByNewest.onchange = fetchWithFilters;
sortByStatus.onchange = fetchWithFilters;
txtSearchbar.oninput = fetchWithFilters;

async function sendStatusToEmail(status) {
    try {
        const response = await fetch("backend/forBackendData/adminNevents/sendStatsEmail.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                org_email: selectedApp.email,
                status: status,
                org_name: selectedApp.orgName,
                event_name: selectedApp.event_name
            })
        });

        const data = await response.json();
        if (data.status) console.log(data.message);

    } catch (error) {
        alert("Error sending email");
    }
}
</script>