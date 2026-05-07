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
        inset: 0;
        margin: auto;
        width: 88%;
        height: 92vh;
        background: #f4f8ff;
        border-radius: 24px;
        overflow: hidden;
        display: none;
        flex-direction: column;
        box-shadow:
            0 20px 60px rgba(0, 65, 156, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(14px);
    }

    .modal-top-banner {
        height: 500px;
        position: relative;
        background-size: cover;
        background-position: center;
        overflow: hidden;
    }

    .modal-banner-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(to top,
                rgba(0, 0, 0, 0.75),
                rgba(0, 0, 0, 0.15));
        display: flex;
        align-items: flex-end;
        padding: 30px;
    }

    .banner-content h1 {
        color: white;
        font-size: 2.1rem;
        margin-bottom: 10px;
    }

    .banner-content p {
        color: rgba(255, 255, 255, 0.85);
    }

    .allOrgInfo-container {
        padding: 25px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .info-section {
        background: white;
        border-radius: 18px;
        padding: 22px;
        border: 1px solid rgba(0, 65, 156, 0.08);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
    }

    .section-header {
        font-size: 1.1rem;
        font-weight: 700;
        color: rgba(0, 65, 156, 1);
        margin-bottom: 18px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .input-group label {
        font-size: .82rem;
        font-weight: 700;
        color: #4b5563;
    }

    .input-group input,
    .input-group textarea {
        border: 1px solid rgba(0, 0, 0, 0.08);
        background: #f9fbff;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: .92rem;
        resize: none;
    }

    .input-group textarea {
        min-height: 120px;
    }

    .full-span {
        grid-column: span 2;
    }

    .beauty-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .beauty-list li {
        background: linear-gradient(135deg,
                rgba(0, 65, 156, 0.08),
                rgba(83, 155, 255, 0.08));
        padding: 12px 14px;
        border-radius: 12px;
        font-size: .92rem;
        color: #1e293b;
        border: 1px solid rgba(83, 155, 255, 0.15);
    }

    .file-preview {
        width: 100%;
        height: 500px;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid rgba(0, 65, 156, 0.1);
    }

    .file-preview iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .btnDownload {
        margin-top: 16px;
        width: 100%;
        padding: 14px;
        border-radius: 14px;
        border: none;
        background: linear-gradient(135deg,
                rgba(0, 65, 156, 1),
                rgba(83, 155, 255, 1));
        color: white;
        font-weight: 700;
        cursor: pointer;
    }

    .approvalUtil-container {
        padding: 20px;
        background: white;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .approvalUtil-container button {
        border: none;
        border-radius: 12px;
        padding: 12px 18px;
        font-weight: 700;
        cursor: pointer;
    }

    .btnApprove {
        background: rgb(33, 163, 71);
        color: white;
    }

    .btnReject {
        background: rgb(220, 38, 38);
        color: white;
    }

    .btnCancel {
        background: #eef2ff;
    }

    .btnCloseModal {
        position: absolute;
        top: 18px;
        right: 22px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        color: white;
        font-size: 1.1rem;
        cursor: pointer;
        z-index: 20;
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
                    <th>Event</th>
                    <th>Organization</th>
                    <th>Department</th>
                    <th>Package</th>
                    <th>Status</th>
                    <th>Applied At</th>
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

    <button class="btnCloseModal">✕</button>

    <div class="modal-top-banner" id="eventBanner">
        <div class="modal-banner-overlay">
            <div class="banner-content">
                <h1 id="bannerEventName"></h1>
                <p id="bannerOrgName"></p>
            </div>
        </div>
    </div>

    <div class="allOrgInfo-container">

        <div class="info-section">
            <div class="section-header">
                Application Information
            </div>

            <div class="info-grid">

                <div class="input-group">
                    <label>Application ID</label>
                    <input id="txtAdvertisement_id" readonly>
                </div>

                <div class="input-group">
                    <label>Agreement Status</label>
                    <input id="txtApplication_status" readonly>
                </div>

                <div class="input-group">
                    <label>Applied At</label>
                    <input id="txtApplied_at" readonly>
                </div>

            </div>
        </div>

        <div class="info-section">

            <div class="section-header">
                Event Information
            </div>

            <div class="info-grid">

                <div class="input-group">
                    <label>Event Name</label>
                    <input id="txtEvent_name" readonly>
                </div>

                <div class="input-group">
                    <label>Location</label>
                    <input id="txtLocation" readonly>
                </div>

                <div class="input-group">
                    <label>Start Date</label>
                    <input id="txtStart_date" readonly>
                </div>

                <div class="input-group">
                    <label>End Date</label>
                    <input id="txtEnd_date" readonly>
                </div>

                <div class="input-group">
                    <label>Start Time</label>
                    <input id="txtStart_time" readonly>
                </div>

                <div class="input-group">
                    <label>End Time</label>
                    <input id="txtEnd_time" readonly>
                </div>

                <div class="input-group">
                    <label>Capacity</label>
                    <input id="txtCapacity" readonly>
                </div>

                <div class="input-group full-span">
                    <label>Description</label>
                    <textarea id="txtEvent_description" readonly></textarea>
                </div>

                <div class="input-group full-span">
                    <label>Restrictions</label>
                    <ul class="beauty-list" id="restrictionList"></ul>
                </div>

            </div>

        </div>

        <div class="info-section">

            <div class="section-header">
                Organization & Representative
            </div>

            <div class="info-grid">

                <div class="input-group">
                    <label>Organization</label>
                    <input id="txtOrg_name" readonly>
                </div>

                <div class="input-group">
                    <label>Organization Email</label>
                    <input id="txtOrg_email" readonly>
                </div>

                <div class="input-group">
                    <label>Organization Contact</label>
                    <input id="txtOrg_contact" readonly>
                </div>

                <div class="input-group">
                    <label>Representative</label>
                    <input id="txtRepresentative_name" readonly>
                </div>

                <div class="input-group">
                    <label>Representative Email</label>
                    <input id="txtRepresentative_email" readonly>
                </div>

                <div class="input-group">
                    <label>Year Level</label>
                    <input id="txtYear_level" readonly>
                </div>

                <div class="input-group">
                    <label>Department</label>
                    <input id="txtDepartment_name" readonly>
                </div>

                <div class="input-group">
                    <label>Program</label>
                    <input id="txtProgram_name" readonly>
                </div>

            </div>

        </div>

        <div class="info-section">

            <div class="section-header">
                Sponsorship Package
            </div>

            <div class="info-grid">

                <div class="input-group">
                    <label>Package Name</label>
                    <input id="txtPackage_name" readonly>
                </div>

                <div class="input-group">
                    <label>Price</label>
                    <input id="txtPrice" readonly>
                </div>

                <div class="input-group full-span">
                    <label>Benefits</label>
                    <ul class="beauty-list" id="benefitsList"></ul>
                </div>

            </div>

        </div>

        <div class="info-section">

            <div class="section-header">
                Uploaded Proposal / Documents
            </div>

            <div class="file-preview">
                <iframe></iframe>
            </div>

            <button class="btnDownload" onclick="downloadFile()">
                Download Attachment
            </button>

        </div>

    </div>

    <div class="approvalUtil-container">
        <p style="visibility: hidden;">Already decided</p>
        <button class="btnApprove">Reconsider</button>
        <button class="btnReject">Hold Agreement</button>
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

    const fileDirectory = "image_data/package_application/";

    let selectedApp = {
        id: null,
        email: null,
        orgName: null,
        fileName: null
    };

    let allRecords = [];

    document.addEventListener("DOMContentLoaded", loadSponsors);

    async function loadSponsors() {
        const res = await fetch("backend/forBackendData/sponsor_pages/applications/getAdManage.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            }
        });
        const data = await res.json();
        allRecords = data.records || [];
        applyFilters();
    }

    function renderTable(records) {

        tableBody.innerHTML = "";

        if (!records || records.length === 0) {

            tableBody.innerHTML =
                `<tr><td colspan="8">No data available</td></tr>`;

            return;
        }

        records.forEach(e => {

            tableBody.innerHTML += `
        <tr>
            <td>${e.advertisement_id}</td>
            <td>${e.event_name}</td>
            <td>${e.org_name}</td>
            <td>${e.department_name}</td>
            <td>${e.package_name}</td>
            <td>${e.agreement_status}</td>
            <td>${e.applied_at}</td>
            <td>
                <button data-id="${e.advertisement_id}">
                    ⌕ View
                </button>
            </td>
        </tr>`;
        });
    }

    function applyFilters() {

        let filtered = [...allRecords];

        const search = txtSearchbar.value.toLowerCase();

        if (search) {

            filtered = filtered.filter(e =>
                e.event_name.toLowerCase().includes(search) ||
                e.org_name.toLowerCase().includes(search) ||
                e.department_name.toLowerCase().includes(search) ||
                e.package_name.toLowerCase().includes(search)
            );
        }

        const status = sortByStatus.value;

        if (status !== "all") {

            filtered = filtered.filter(e =>
                e.application_status === status
            );
        }

        const sort = sortByNewest.value;

        if (sort === "newest") {

            filtered.sort((a, b) =>
                new Date(b.applied_at) - new Date(a.applied_at)
            );

        } else if (sort === "oldest") {

            filtered.sort((a, b) =>
                new Date(a.applied_at) - new Date(b.applied_at)
            );

        } else if (sort === "az") {

            filtered.sort((a, b) =>
                a.event_name.localeCompare(b.event_name)
            );

        } else if (sort === "za") {

            filtered.sort((a, b) =>
                b.event_name.localeCompare(a.event_name)
            );
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
    btnApprove.onclick = () => updateStatus("Ongoing");
    btnReject.onclick = () => updateStatus("On Hold");

    async function fetchSpecificSponsor(id) {

        const res = await fetch("backend/forBackendData/sponsor_pages/applications/getAdManage.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                advertisement_id: id
            })
        });

        const d = await res.json();
        const r = d.record;

        const formatDate = (date) => {
            return new Date(date).toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric"
            });
        };

        const formatDateTime = (date) => {
            return new Date(date).toLocaleString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "numeric",
                minute: "2-digit"
            });
        };

        const formatTime = (time) => {

            const fakeDate = new Date(`2000-01-01T${time}`);

            return fakeDate.toLocaleTimeString("en-US", {
                hour: "numeric",
                minute: "2-digit"
            });
        };

        document.querySelector("#eventBanner").style.backgroundImage =
            `url(image_data/event_bg_picture/${r.event_bg_picture})`;

        bannerEventName.textContent = r.event_name;
        bannerOrgName.textContent = r.org_name;

        txtAdvertisement_id.value = r.advertisement_id;
        txtApplication_status.value = r.agreement_status.toUpperCase();
        txtApplied_at.value = formatDateTime(r.applied_at);

        txtEvent_name.value = r.event_name;
        txtEvent_description.value = r.event_description;
        txtLocation.value = r.location;

        txtStart_date.value = formatDate(r.start_date);
        txtEnd_date.value = formatDate(r.end_date);

        txtStart_time.value = formatTime(r.start_time);
        txtEnd_time.value = formatTime(r.end_time);

        txtCapacity.value = `${r.slot_taken}/${r.capacity}`;

        txtOrg_name.value = r.org_name;
        txtOrg_email.value = r.org_email;
        txtOrg_contact.value = r.org_contact_no;

        txtRepresentative_name.value = r.representative_name;
        txtRepresentative_email.value = r.representative_email;
        txtYear_level.value = r.year_level;

        txtDepartment_name.value = r.department_name;
        txtProgram_name.value =
            `${r.program_name} (${r.prog_abv})`;

        txtPackage_name.value = r.package_name;

        txtPrice.value =
            "₱" + Number(r.price).toLocaleString();

        const benefitsList =
            document.querySelector("#benefitsList");

        benefitsList.innerHTML = "";

        try {

            const benefits =
                JSON.parse(r.benefits || "[]");

            benefits.forEach(b => {

                benefitsList.innerHTML += `
                <li>✅ ${b}</li>
            `;
            });

        } catch {

            benefitsList.innerHTML =
                `<li>${r.benefits}</li>`;
        }

        const restrictionList =
            document.querySelector("#restrictionList");

        restrictionList.innerHTML = "";

        try {

            const restrictions =
                JSON.parse(r.restrictions || "{}");

            if (restrictions.year_level?.length > 0) {

                restrictions.year_level.forEach(y => {

                    restrictionList.innerHTML += `
                    <li>🎓 Year Level: ${y}</li>
                `;
                });
            }

            if (restrictions.programs?.length > 0) {

                restrictions.programs.forEach(p => {

                    restrictionList.innerHTML += `
                    <li>📘 Program ID: ${p}</li>
                `;
                });
            }

        } catch {

            restrictionList.innerHTML =
                `<li>No restrictions available</li>`;
        }

        selectedApp.id = r.advertisement_id;
        selectedApp.email = r.org_email;
        selectedApp.orgName = r.org_name;

        if (!r.additional_files) {

            selectedApp.fileName = null;

            iframe.src = "";

            btnDownload.disabled = true;
            btnDownload.classList.add("btnDownloadDisabled");

        } else {

            selectedApp.fileName = r.additional_files;

            iframe.src =
                fileDirectory + r.additional_files;

            btnDownload.disabled = false;

            btnDownload.classList.remove(
                "btnDownloadDisabled"
            );
        }

        /*const isPending =
            r.application_status === "pending";

        btnApprove.disabled = !isPending;
        btnReject.disabled = !isPending;

        btnApprove.classList.toggle(
            "btnDisabled",
            !isPending
        );

        btnReject.classList.toggle(
            "btnDisabled",
            !isPending
        );

        statusText.style.visibility =
            isPending ? "hidden" : "visible";*/
    }

    async function updateStatus(status) {
        btnApprove.disabled = true;
        btnReject.disabled = true;
        btnApprove.classList.add("btnDisabled");
        btnReject.classList.add("btnDisabled");

        const response = await fetch("backend/forBackendData/sponsor_pages/applications/updateAgreement.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                agreement_status: status,
                advertisement_id: selectedApp.id
            })
        });

        const data = await response.json();

        //await sendStatusToEmail(status);

        alert(`Advertisement ID: ${data.advertisement_id} ${data.message}`);
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
        const r = await fetch("backend/forBackendData/sponsor_pages/applications/email.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "org_email": selectedApp.email,
                "org_name": selectedApp.orgName,
                "approval_status": status
            })
        });
        const d = await r.json();
        if (d.status == true) {
            console.log("email sent");
        }
    }
</script>