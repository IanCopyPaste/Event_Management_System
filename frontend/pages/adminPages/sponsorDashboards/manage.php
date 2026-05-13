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

    .utilities-container input {
        padding: 10px 12px;
        border: 1px solid #cfe8ff;
        border-radius: 6px;
        outline: none;
    }

    #txtSearchbar {
        margin-left: auto;
        width: 240px;
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

    .orgApplication-table th {
        padding: 12px;
        text-align: left;
        font-size: 13px;
        color: #ffffff;
    }

    .orgApplication-table td {
        padding: 12px;
        font-size: 13px;
        border-bottom: 1px solid #e0f0ff;
    }

    .orgApplication-table td button {
        padding: 5px 10px;
        background-color: rgba(0, 65, 156, 1);
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .orgApplication-table tbody tr:hover {
        background: #f0f8ff;
    }

    /* Status badge */
    .badge {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-active   { background: #d4edda; color: #155724; }
    .badge-inactive { background: #f8d7da; color: #721c24; }

    /* Shared modal base */
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
        z-index: 1000;
    }

    .btnCloseModal {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 1.3rem;
        background: transparent;
        border: none;
        color: rgba(0, 65, 156, 1);
        cursor: pointer;
    }

    .btnCloseModal:hover { opacity: 0.7; }

    .allOrgInfo-container {
        padding: 30px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        overflow-y: auto;
    }

    .allOrgInfo-container input,
    .allOrgInfo-container select {
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid rgba(117, 117, 117, 0.3);
        background: #ffffff;
        font-size: 13px;
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

    .btnApprove  { background: rgb(77, 160, 0);  color: white; }
    .btnReject   { background: rgb(211, 0, 0);    color: white; }
    .btnCancel   { background: white; border: 1px solid rgba(83, 155, 255, 0.5) !important; }
    .btnDisabled { background-color: grey !important; cursor: not-allowed !important; opacity: 0.6; }

    /* Overlay */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 999;
    }

    /* Add sponsor button */
    #btnAddSponsor {
        padding: 10px 16px;
        background: rgba(0, 65, 156, 1);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    #btnAddSponsor:hover { opacity: 0.85; }

    .form-error {
        grid-column: span 2;
        color: red;
        font-size: 12px;
        visibility: hidden;
    }
</style>

<!-- ───────────── MAIN TABLE ───────────── -->
<div class="orgsApply-container">
    <div class="utilities-container">
        <button id="btnAddSponsor" onclick="openAddModal()">+ Add Sponsor</button>
        <input type="text" id="txtSearchbar" placeholder="Search...">
    </div>

    <div class="table-wrapper" style="margin-top:10px;">
        <table class="orgApplication-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="7">No data</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ───────────── OVERLAY ───────────── -->
<div class="modal-overlay" id="modalOverlay"></div>

<!-- ───────────── VIEW / MANAGE MODAL ───────────── -->
<div class="orgInfo-modal" id="viewSponsorModal">
    <h3 style="margin:20px">Sponsor Review Panel</h3>
    <button class="btnCloseModal" onclick="closeViewModal()">✕</button>

    <div class="allOrgInfo-container">
        <div class="field">
            <label>ID</label>
            <input id="txtOrg_application_id" readonly>
        </div>
        <div class="field">
            <label>Company Name</label>
            <input id="txtOrg_name" readonly>
        </div>
        <div class="field">
            <label>Email</label>
            <input id="txtOrg_email" readonly>
        </div>
        <div class="field">
            <label>Contact</label>
            <input id="txtOrg_contact_no" readonly>
        </div>
        <div class="field">
            <label>Address</label>
            <input id="txtOrg_department_name" readonly>
        </div>
        <div class="field">
            <label>Created</label>
            <input id="txtCreated_at" readonly>
        </div>
        <div class="field">
            <label>Status</label>
            <input id="txtStatus" readonly>
        </div>
    </div>

    <div class="approvalUtil-container">
        <button class="btnApprove" id="btnActivate"   onclick="updateStatus('activated')">Activate</button>
        <button class="btnReject"  id="btnDeactivate" onclick="updateStatus('deactivated')">Deactivate</button>
        <button class="btnCancel"  onclick="closeViewModal()">Close</button>
    </div>
</div>

<!-- ───────────── ADD SPONSOR MODAL ───────────── -->
<div class="orgInfo-modal" id="addSponsorModal">
    <h3 style="margin:20px">Add Sponsor</h3>
    <button class="btnCloseModal" onclick="closeAddModal()">✕</button>

    <div class="allOrgInfo-container">
        <div class="field">
            <label>Company Name <span style="color:red">*</span></label>
            <input type="text" id="add_company_name" placeholder="e.g. Acme Corp">
        </div>
        <div class="field">
            <label>Email <span style="color:red">*</span></label>
            <input type="email" id="add_sponsor_email" placeholder="email@example.com">
        </div>
        <div class="field">
            <label>Contact No. <span style="color:red">*</span></label>
            <input type="text" id="add_sponsor_contact_no" placeholder="+63 9XX XXX XXXX">
        </div>
        <div class="field">
            <label>Company Address</label>
            <input type="text" id="add_company_address" placeholder="Street, City, Province">
        </div>
        <div class="field">
            <label>Username <span style="color:red">*</span></label>
            <input type="text" id="add_username" placeholder="sponsor_username">
        </div>
        <div class="field">
            <label>Password <span style="color:red">*</span></label>
            <input type="password" id="add_password" placeholder="••••••••">
        </div>
        <div class="field">
            <label>Account Status</label>
            <select id="add_status">
                <option value="activated">Activated</option>
                <option value="deactivated">Deactivated</option>
            </select>
        </div>
        <div class="field" style="grid-column:span 2;">
            <label>Sponsor Logo</label>
            <input type="file" id="add_sponsor_logo" accept="image/*" style="padding:8px 12px;">
        </div>
        <p class="form-error" id="addFormError">Please fill in all required fields.</p>
    </div>

    <div class="approvalUtil-container">
        <button class="btnApprove" onclick="submitAddSponsor()">Save Sponsor</button>
        <button class="btnCancel"  onclick="closeAddModal()">Cancel</button>
    </div>
</div>

<script>
const tableBody    = document.querySelector("tbody");
const searchInput  = document.querySelector("#txtSearchbar");
const overlay      = document.getElementById("modalOverlay");

let currentSponsorId = null;
let allData = [];

document.addEventListener("DOMContentLoaded", () => {
    loadSponsors();
    overlay.onclick = () => { closeViewModal(); closeAddModal(); };
});

// ── Load & Render ──────────────────────────────────────
async function loadSponsors() {
    const res  = await fetch("backend/forBackendData/adminNsponsors/manage/displaySponsors.php", {
        method:  "POST",
        headers: { "Content-Type": "application/json" },
        body:    JSON.stringify({ sponsor_id: null })
    });
    const data = await res.json();
    allData    = data.record || [];
    renderTable(allData);
}

function renderTable(records) {
    tableBody.innerHTML = "";
    if (!records.length) {
        tableBody.innerHTML = `<tr><td colspan="7">No data</td></tr>`;
        return;
    }
    records.forEach(e => {
        const badgeClass = e.status === "activated" ? "badge-active" : "badge-inactive";
        tableBody.innerHTML += `
        <tr>
            <td>${e.sponsor_id}</td>
            <td>${e.company_name}</td>
            <td>${e.sponsor_email}</td>
            <td>${e.sponsor_contact_no}</td>
            <td>${e.company_address}</td>
            <td><span class="badge ${badgeClass}">${e.status}</span></td>
            <td><button data-id="${e.sponsor_id}">View</button></td>
        </tr>`;
    });
}

searchInput.oninput = () => {
    const val      = searchInput.value.toLowerCase();
    const filtered = allData.filter(e =>
        e.company_name.toLowerCase().includes(val) ||
        e.sponsor_email.toLowerCase().includes(val)
    );
    renderTable(filtered);
};

tableBody.addEventListener("click", e => {
    if (e.target.tagName === "BUTTON") {
        currentSponsorId = e.target.dataset.id;
        openViewModal(currentSponsorId);
    }
});

// ── View Modal ─────────────────────────────────────────
function openViewModal(id) {
    document.getElementById("viewSponsorModal").style.display = "flex";
    overlay.style.display = "block";
    fetchSponsor(id);
}

function closeViewModal() {
    document.getElementById("viewSponsorModal").style.display = "none";
    overlay.style.display = "none";
}

async function fetchSponsor(id) {
    const res = await fetch("backend/forBackendData/adminNsponsors/manage/displaySponsors.php", {
        method:  "POST",
        headers: { "Content-Type": "application/json" },
        body:    JSON.stringify({ sponsor_id: id })
    });
    const d = await res.json();
    const r = d.record[0];

    document.getElementById("txtOrg_application_id").value  = r.sponsor_id;
    document.getElementById("txtOrg_name").value            = r.company_name;
    document.getElementById("txtOrg_email").value           = r.sponsor_email;
    document.getElementById("txtOrg_contact_no").value      = r.sponsor_contact_no;
    document.getElementById("txtOrg_department_name").value = r.company_address;
    document.getElementById("txtStatus").value              = r.status;
    document.getElementById("txtCreated_at").value          = r.created_at;

    const btnAct  = document.getElementById("btnActivate");
    const btnDeac = document.getElementById("btnDeactivate");

    // Toggle buttons based on current status
    if (r.status === "activated") {
        btnAct.classList.add("btnDisabled");
        btnAct.disabled = true;
        btnDeac.classList.remove("btnDisabled");
        btnDeac.disabled = false;
    } else {
        btnDeac.classList.add("btnDisabled");
        btnDeac.disabled = true;
        btnAct.classList.remove("btnDisabled");
        btnAct.disabled = false;
    }
}

// ── Update Status ──────────────────────────────────────
async function updateStatus(newStatus) {
    const res  = await fetch("backend/forBackendData/adminNsponsors/manage/updateStatus.php", {
        method:  "POST",
        headers: { "Content-Type": "application/json" },
        body:    JSON.stringify({ sponsor_id: currentSponsorId, status: newStatus })
    });
    const data = await res.json();
    if (data.success) {
        alert(`Sponsor has been ${newStatus}.`);
        closeViewModal();
        loadSponsors();
    } else {
        alert("Error: " + (data.message || "Could not update status."));
    }
}

// ── Add Modal ──────────────────────────────────────────
function openAddModal() {
    clearAddForm();
    document.getElementById("addSponsorModal").style.display = "flex";
    overlay.style.display = "block";
}

function closeAddModal() {
    document.getElementById("addSponsorModal").style.display = "none";
    overlay.style.display = "none";
}

function clearAddForm() {
    ["add_company_name","add_sponsor_email","add_sponsor_contact_no",
     "add_company_address","add_username","add_password"].forEach(id => {
        document.getElementById(id).value = "";
    });
    document.getElementById("add_status").value          = "activated";
    document.getElementById("add_sponsor_logo").value    = "";
    document.getElementById("addFormError").style.visibility = "hidden";
}

async function submitAddSponsor() {
    const fields = {
        company_name:       document.getElementById("add_company_name").value.trim(),
        sponsor_email:      document.getElementById("add_sponsor_email").value.trim(),
        sponsor_contact_no: document.getElementById("add_sponsor_contact_no").value.trim(),
        username:           document.getElementById("add_username").value.trim(),
        password:           document.getElementById("add_password").value.trim(),
    };

    if (Object.values(fields).some(v => !v)) {
        document.getElementById("addFormError").style.visibility = "visible";
        return;
    }
    document.getElementById("addFormError").style.visibility = "hidden";

    const formData = new FormData();
    Object.entries(fields).forEach(([k, v]) => formData.append(k, v));
    formData.append("company_address",  document.getElementById("add_company_address").value.trim());
    formData.append("status",           document.getElementById("add_status").value);

    const logoFile = document.getElementById("add_sponsor_logo").files[0];
    if (logoFile) formData.append("sponsor_logo", logoFile);

    try {
        const res  = await fetch("backend/forBackendData/adminNsponsors/manage/addSponsor.php", {
            method: "POST",
            body:   formData
        });
        const data = await res.json();
        if (data.success) {
            alert("Sponsor added successfully!");
            closeAddModal();
            loadSponsors();
            location.reload();
        } else {
            alert("Error: " + (data.message || "Something went wrong."));
        }
    } catch (err) {
        alert("Request failed: " + err.message);
    }
}
</script>