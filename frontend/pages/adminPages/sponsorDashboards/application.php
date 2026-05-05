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
    }

    .allOrgInfo-container input {
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid rgba(117, 117, 117, 0.3);
        background: #ffffff;
        font-size: 13px;
    }

    .file-preview {
        grid-column: span 2;
        height: 500px;
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

    .btnDownloadDisabled {
        background-color: grey;
        color: black;
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
    }

    .btnDisabled {
        background-color: grey;
        cursor: not-allowed;
    }
</style>

<div class="orgsApply-container">
    <div class="utilities-container">
        <div class="field">
            <label>Sort</label>
            <select id="sortByNewest">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
            </select>
        </div>

        <div class="field">
            <label>Status</label>
            <select id="sortByStatus">
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <input type="text" id="txtSearchbar" placeholder="Search...">
    </div>

    <div class="table-wrapper">
        <table class="orgApplication-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
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
    <h3 style="margin:20px">Sponsor Review Panel</h3>
    <button class="btnCloseModal">✕</button>

    <div class="allOrgInfo-container">
        <label>ID</label>
        <input id="txtOrg_application_id" readonly>

        <label>Company</label>
        <input id="txtOrg_name" readonly>

        <label>Email</label>
        <input id="txtOrg_email" readonly>

        <label>Contact</label>
        <input id="txtOrg_contact_no" readonly>

        <label>Address</label>
        <input id="txtOrg_department_name" readonly>

        <label>Created</label>
        <input id="txtCreated_at" readonly>

        <label>Approval Status</label>
        <input id="txtStatus" readonly>

        <label>File</label>
        <div class="file-preview">
            <iframe></iframe>
        </div>

        <button class="btnDownload" onclick="downloadFile()">Download</button>
    </div>

    <div class="approvalUtil-container">
        <p>Already decided</p>
        <button class="btnApprove">Approve</button>
        <button class="btnReject">Reject</button>
        <button class="btnCancel">Close</button>
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

    const iframe = document.querySelector(".file-preview iframe");
    const btnDownload = document.querySelector(".btnDownload");

    const fileDirectory = "image_data/sponsor_application_docs/";

    let selectedApp = {
        id: null,
        email: null,
        orgName: null,
        fileName: null
    };

    let allRecords = [];

    document.addEventListener("DOMContentLoaded", loadSponsors);

    async function loadSponsors() {
        const res = await fetch("backend/forBackendData/adminNsponsors/application/getSponsor.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                sponsor_id: null
            })
        });
        const data = await res.json();
        allRecords = data.record || [];
        applyFilters();
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
            <td>${e.sponsor_id}</td>
            <td>${e.company_name}</td>
            <td style="word-break: break-all; max-width: 180px;">${e.sponsor_email}</td>
            <td>${e.sponsor_contact_no}</td>
            <td>${e.company_address}</td>
            <td>${e.approval_status}</td>
            <td><button data-id="${e.sponsor_id}">⌕ View</button></td>
        </tr>`;
        });
    }

    function applyFilters() {
        let filtered = [...allRecords];

        const search = txtSearchbar.value.toLowerCase();
        if (search) {
            filtered = filtered.filter(e =>
                e.company_name.toLowerCase().includes(search) ||
                e.sponsor_email.toLowerCase().includes(search) ||
                e.company_address.toLowerCase().includes(search)
            );
        }

        const status = sortByStatus.value;
        if (status !== "all") {
            filtered = filtered.filter(e => e.approval_status === status);
        }

        const sort = sortByNewest.value;
        if (sort === "newest") {
            filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        } else if (sort === "oldest") {
            filtered.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
        } else if (sort === "az") {
            filtered.sort((a, b) => a.company_name.localeCompare(b.company_name));
        } else if (sort === "za") {
            filtered.sort((a, b) => b.company_name.localeCompare(a.company_name));
        }

        renderTable(filtered);
    }

    tableBody.addEventListener("click", e => {
        if (e.target.tagName === "BUTTON") {
            selectedApp.id = e.target.dataset.id;
            modal.style.display = "flex";
            fetchSpecificSponsor(selectedApp.id);
        }
    });

    btnCloseModal.onclick = () => modal.style.display = "none";
    btnCancelModal.onclick = () => modal.style.display = "none";
    btnApprove.onclick = () => updateStatus("approved");
    btnReject.onclick = () => updateStatus("rejected");

    async function fetchSpecificSponsor(id) {
        const res = await fetch("backend/forBackendData/adminNsponsors/application/getSponsor.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                sponsor_id: id
            })
        });

        const d = await res.json();
        const r = d.record;

        txtOrg_application_id.value = r.sponsor_id;
        txtOrg_name.value = r.company_name;
        txtOrg_email.value = r.sponsor_email;
        txtOrg_contact_no.value = r.sponsor_contact_no;
        txtOrg_department_name.value = r.company_address;
        txtCreated_at.value = r.created_at;
        txtStatus.value = r.approval_status;

        selectedApp.email = r.sponsor_email;
        selectedApp.orgName = r.company_name;

        if (!r.additional_documents) {
            selectedApp.fileName = null;
            iframe.src = "";
            btnDownload.disabled = true;
            btnDownload.classList.add("btnDownloadDisabled");
        } else {
            selectedApp.fileName = r.additional_documents;
            iframe.src = fileDirectory + r.additional_documents;
            btnDownload.disabled = false;
            btnDownload.classList.remove("btnDownloadDisabled");
        }

        const isPending = r.approval_status === "pending";

        btnApprove.disabled = !isPending;
        btnReject.disabled = !isPending;

        btnApprove.classList.toggle("btnDisabled", !isPending);
        btnReject.classList.toggle("btnDisabled", !isPending);

        statusText.style.visibility = isPending ? "hidden" : "visible";
    }

    async function updateStatus(status) {


        btnApprove.disabled = true;
        btnReject.disabled = true;
        btnApprove.classList.add("btnDisabled");
        btnReject.classList.add("btnDisabled");

        const response = await fetch("backend/forBackendData/adminNsponsors/application/updateStatus.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                approval_status: status,
                sponsor_id: selectedApp.id
            })
        });

        const data = await response.json();

        await sendStatusToEmail(status, selectedApp.email, selectedApp.id, selectedApp.orgName);

        alert(`Sponsor ID: ${data.sponsor_id} ${data.message}`);
        location.reload();
    }

    function downloadFile() {
        if (!selectedApp.fileName) return;
        const a = document.createElement("a");
        a.href = fileDirectory + selectedApp.fileName;
        a.download = "";
        a.click();
    }

    sortByNewest.onchange = applyFilters;
    sortByStatus.onchange = applyFilters;
    txtSearchbar.oninput = applyFilters;

    async function sendStatusToEmail(status) {
        const r = await fetch("backend/forBackendData/adminNsponsors/application/email.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "sponsor_email": selectedApp.email,
                "sponsor_id": selectedApp.id,
                "company_name": selectedApp.orgName,
                "approval_status": status
            })
        });
        const d = await r.json();
        if(d.status == true){
        console.log("email sent");
        }
    }
</script>