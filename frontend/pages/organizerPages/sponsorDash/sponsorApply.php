<style>
    body {
        margin: 0;
        font-family: 'Barlow', sans-serif;
        background: #f5f7fb;
    }

    .container {
        margin: auto;
        padding: 20px;
    }

    .hero {
        height: 280px;
        background-size: cover;
        background-position: center;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }

    .overlay {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px;
        color: white;
    }

    .overlay h1 {
        font-size: 32px;
    }

    .price {
        font-size: 20px;
        font-weight: bold;
    }

    .card {
        background: white;
        margin-top: 20px;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 600;
        color: #00419c;
    }

    .benefits {
        list-style: none;
        padding: 0;
    }

    .benefits li {
        background: #eaf4ff;
        margin-bottom: 8px;
        padding: 10px;
        border-radius: 8px;
    }

    .sponsor-box {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .sponsor-box img {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
    }

    .actions {
        width: 100%;
    }

    .apply-btn {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #00419c, #2f80ed);
        color: white;
        font-weight: 600;
        cursor: pointer;
        display: none;
        width: 40%;
        margin: 20px auto;
        transition: .2s;
    }

    .cancel-btn {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: #ff4d4d;
        color: white;
        font-weight: 600;
        cursor: pointer;
        display: none;
        width: 40%;
        margin: 20px auto;
    }

    .apply-btn:hover {
        transform: scale(1.02);
    }

    .cancel-btn:hover {
        transform: scale(1.02);
    }

    #backButton {
        background-color: transparent;
        font-size: 2rem;
        border: none;
        position: relative;
        left: -20px;
    }

    #backButton:hover {
        cursor: pointer;
    }

    .eventsChoice {
        padding: 5px;
        border-radius: 5px;
        font-size: 1rem;
        width: 100%;
    }
</style>
<div class="container">
    <button id="backButton">
        <</button>
            <div class="hero" id="hero">
                <div class="overlay">
                    <h1 id="pkgName"></h1>
                    <div class="price" id="pkgPrice"></div>
                </div>
            </div>

            <div class="card">
                <div class="section-title">Description</div>
                <p id="pkgDesc"></p>
            </div>

            <div class="card">
                <div class="section-title">Choose Event to apply with:</div>
                <select class="eventsChoice" id="eventList">
                </select>
            </div>

            <div class="card">
                <div class="section-title">Upload Requirements / Documents</div>
                <input type="file" id="fileUpload" accept=".pdf,.jpg,.png,.doc,.docx">
            </div>

            <div class="card">
                <div class="section-title">Offers</div>
                <ul class="benefits" id="benefitsList"></ul>
            </div>

            <div class="card sponsor-box" style="display: flex; flex-direction:column; align-items:start; width:100%;">
                <div class="section-title">Company Offered</div>
                <div style="display: flex; gap:15px;">
                    <img id="sponsorLogo">
                    <div>
                        <h3 id="companyName"></h3>
                        <p id="companyAddress"></p>
                        <p id="companyEmail"></p>
                        <p id="companyContact"></p>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button class="apply-btn">Apply</button>
                <button class="cancel-btn">Cancel Application</button>
            </div>

</div>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const packID = urlParams.get("pack_id");

    const pathBG = "image_data/package_bg/";
    const pathLogo = "image_data/sponsor_logo/";

    const eventDrop = document.querySelector("#eventList");

    document.addEventListener("DOMContentLoaded", async () => {
        const btnApply = document.querySelector(".apply-btn");
        const btnCancel = document.querySelector(".cancel-btn");
        await loadEvents();
        if (await checkApplications(packID, eventDrop.value)) {
            btnApply.style.display = "none";
            btnCancel.style.display = "block";
        } else {
            btnCancel.style.display = "none";
            btnApply.style.display = "block";
        }
    });

    eventDrop.addEventListener("change", async () => {
        const btnApply = document.querySelector(".apply-btn");
        const btnCancel = document.querySelector(".cancel-btn");
        if (await checkApplications(packID, eventDrop.value)) {
            btnApply.style.display = "none";
            btnCancel.style.display = "block";
        } else {
            btnCancel.style.display = "none";
            btnApply.style.display = "block";
        }
    });

    async function loadEvents() {
        const r = await fetch("backend/forBackendData/orgNsponsors/getEventsDrop.php");
        const d = await r.json();
        if (d.status === true) {
            const rec = d.records
            rec.forEach(e => {
                eventDrop.innerHTML += `<option value=${e.event_id}>${e.event_name}</option>`
            });
        }
    }
    async function checkApplications(pack_id, event_id) {
        const r = await fetch("backend/forBackendData/orgNsponsors/verifyApplication.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "pack_id": pack_id,
                "event_id": event_id
            })
        });
        const d = await r.json();
        return d.status == true;
    }

    async function loadPackage() {
        const res = await fetch(`backend/forBackendData/orgNsponsors/getApplySponsor.php?pack_id=${packID}`);
        const data = await res.json();

        if (!data.status) return;

        const p = data.record;

        document.getElementById("hero").style.backgroundImage =
            `url(${p.package_bg ? pathBG + p.package_bg : pathBG + "default.png"})`;

        document.getElementById("pkgName").textContent = p.package_name;
        document.getElementById("pkgPrice").textContent = "₱" + Number(p.price).toLocaleString();
        document.getElementById("pkgDesc").textContent = p.description;

        document.getElementById("sponsorLogo").src =
            p.sponsor_logo ? pathLogo + p.sponsor_logo : pathLogo + "profileImg.png";

        document.getElementById("companyName").textContent = p.company_name;
        document.getElementById("companyAddress").textContent = p.company_address;
        document.getElementById("companyEmail").textContent = p.sponsor_email;
        document.getElementById("companyContact").textContent = p.sponsor_contact_no;

        const benefitsContainer = document.getElementById("benefitsList");
        benefitsContainer.innerHTML = "";

        let benefits = [];
        try {
            benefits = JSON.parse(p.benefits || "[]");
        } catch {}

        benefits.forEach(b => {
            benefitsContainer.innerHTML += `<li>✅ ${b}</li>`;
        });
    }

    async function apply() {
        const fileInput = document.getElementById("fileUpload");
        const file = fileInput.files[0];

        const formData = new FormData();
        formData.append("pack_id", packID);
        formData.append("event_id", eventDrop.value);

        if (file) {
            formData.append("document", file);
        }

        const res = await fetch("backend/forBackendData/orgNsponsors/apply.php", {
            method: "POST",
            body: formData
        });

        const data = await res.json();
        if (data.status) location.reload();
    }

    async function cancelApp() {
        const res = await fetch("backend/forBackendData/orgNsponsors/cancel.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                pack_id: packID,
                event_id: eventDrop.value
            })
        });

        const data = await res.json();
        if (data.status) location.reload();
    }

    loadPackage();
    document.querySelector("#backButton").addEventListener("click", () => {
        location.href = "organizer.php?organizerPages=sponsorDash";
    });
    document.querySelector(".apply-btn").addEventListener("click", () => {
        apply();
    });
    document.querySelector(".cancel-btn").addEventListener("click", () => {
        cancelApp();
    });
</script>