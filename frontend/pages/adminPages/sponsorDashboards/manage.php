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
    }

    .orgApplication-table tbody tr:hover {
        background: #f0f8ff;
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
        <input type="text" id="txtSearchbar" placeholder="Search...">
    </div>

    <div class="table-wrapper" style="margin-top: 10px;">
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
                <tr>
                    <td colspan="8">No data</td>
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

        <label>Company Name</label>
        <input id="txtOrg_name" readonly>

        <label>Email</label>
        <input id="txtOrg_email" readonly>

        <label>Contact</label>
        <input id="txtOrg_contact_no" readonly>

        <label>Address</label>
        <input id="txtOrg_department_name" readonly>

        <label>Created</label>
        <input id="txtCreated_at" readonly>

        <label>Status</label>
        <input id="txtStatus" readonly>
    </div>

    <div class="approvalUtil-container">
        <button class="btnActive">Activate</button>
        <button class="btnDeact">Deactivate</button>
        <button class="btnCancel">Close</button>
    </div>
</div>

<script>
    const tableBody = document.querySelector("tbody");
const search = document.querySelector("#txtSearchbar");
const btnDeact = document.querySelector(".btnDeact");
const btnActive = document.querySelector(".btnActive");

let sponsor_id = null;
let allData = [];

document.addEventListener("DOMContentLoaded", () => {
    loadSponsors();

    document.querySelector(".btnCloseModal").onclick = () => {
        document.querySelector(".orgInfo-modal").style.display = "none";
    };

    document.querySelector(".btnCancel").onclick = () => {
        document.querySelector(".orgInfo-modal").style.display = "none";
    };

    btnDeact.onclick = () => updateStat("inactive");
    btnActive.onclick = () => updateStat("active");
});

async function loadSponsors() {
    const res = await fetch("backend/forBackendData/adminNsponsors/manage/displaySponsors.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ sponsor_id: null })
    });
    const data = await res.json();
    allData = data.record || [];
    renderTable(allData);
}

function renderTable(records) {
    tableBody.innerHTML = "";
    if (!records.length) {
        tableBody.innerHTML = `<tr><td colspan="8">No data</td></tr>`;
        return;
    }
    records.forEach(e => {
        tableBody.innerHTML += `
        <tr>
            <td>${e.sponsor_id}</td>
            <td>${e.company_name}</td>
            <td>${e.sponsor_email}</td>
            <td>${e.sponsor_contact_no}</td>
            <td>${e.company_address}</td>
            <td>${e.status}</td>
            <td><button data-id="${e.sponsor_id}">View</button></td>
        </tr>`;
    });
}

search.oninput = () => {
    const val = search.value.toLowerCase();
    const filtered = allData.filter(e =>
        e.company_name.toLowerCase().includes(val) ||
        e.sponsor_email.toLowerCase().includes(val)
    );
    renderTable(filtered);
};

tableBody.addEventListener("click", e => {
    if (e.target.tagName === "BUTTON") {
        sponsor_id = e.target.dataset.id;
        document.querySelector(".orgInfo-modal").style.display = "flex";
        fetchSponsor(sponsor_id);
    }
});

async function fetchSponsor(id) {
    const res = await fetch("backend/forBackendData/adminNsponsors/manage/displaySponsors.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ sponsor_id: id })
    });
    const d = await res.json();
    const r = d.record[0];

    document.getElementById("txtOrg_application_id").value = r.sponsor_id;
    document.getElementById("txtOrg_name").value = r.company_name;
    document.getElementById("txtOrg_email").value = r.sponsor_email;
    document.getElementById("txtOrg_contact_no").value = r.sponsor_contact_no;
    document.getElementById("txtOrg_department_name").value = r.company_address;
    document.getElementById("txtStatus").value = r.status;
    document.getElementById("txtCreated_at").value = r.created_at;

    if (r.status === "inactive") {
        btnActive.disabled = false;
        btnDeact.disabled = true;
    } else {
        btnActive.disabled = true;
        btnDeact.disabled = false;
    }
}

async function updateStat(newStat) {
    await fetch("backend/forBackendData/adminNsponsors/manage/updateStatus.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ sponsor_id, status: newStat })
    });
    alert("Sponsor Account Changed Status");
    location.reload();
}
</script>