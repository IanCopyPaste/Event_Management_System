<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    body {
        background: #f4f6fb;
    }

    .container {
        max-width: 1000px;
        margin: auto;
        padding: 30px;
    }

    .back-btn {
        padding: 10px 16px;
        border: none;
        border-radius: 10px;
        background: #3b82f6;
        color: white;
        font-weight: 600;
        cursor: pointer;
        margin-bottom: 20px;
    }

    .back-btn:hover {
        background: #2563eb;
    }

    .hero {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        height: 280px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px;
        color: white;
    }

    .hero-title {
        font-size: 28px;
        font-weight: 700;
    }

    .status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 6px;
        width: fit-content;
        text-transform: capitalize;
        color: #fff;
    }

    .status-open {
        background: #22c55e;
    }

    .status-closed {
        background: #ef4444;
    }

    .status-ongoing {
        background: #3b82f6;
    }

    .status-finished {
        background: #6b7280;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 25px;
    }

    .card {
        background: white;
        border-radius: 14px;
        padding: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .label {
        font-size: 11px;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
    }

    .value {
        margin-top: 6px;
        font-size: 15px;
        color: #111827;
        font-weight: 500;
    }

    .full {
        grid-column: span 2;
    }

    .actions {
        margin-top: 25px;
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .register-btn {
        padding: 12px 18px;
        border: none;
        border-radius: 10px;
        background: #22c55e;
        color: white;
        font-weight: 700;
        cursor: pointer;
    }
    .cancel-btn{
        padding: 12px 18px;
        border: none;
        border-radius: 10px;
        background: #3b82f6;
        color: white;
        font-weight: 700;
        cursor: pointer;
    }

    .register-btn:hover {
        background: #16a34a;
    }

    .restriction {
        display: none;
        padding: 10px 14px;
        border-radius: 10px;
        background: #fee2e2;
        color: #991b1b;
        font-weight: 600;
        font-size: 13px;
    }
</style>

<div class="container">
    <button class="back-btn" onclick="history.back()">← Go Back</button>

    <div class="hero">
        <img id="eventImg">
        <div class="hero-overlay">
            <div class="hero-title" id="eventName"></div>
            <span class="status" id="eventStatus"></span>
        </div>
    </div>

    <div class="grid">
        <div class="card full">
            <div class="label">Description</div>
            <div class="value" id="eventDesc"></div>
        </div>
        <div class="card">
            <div class="label">Location</div>
            <div class="value" id="eventLocation"></div>
        </div>
        <div class="card">
            <div class="label">Organization</div>
            <div class="value" id="orgName"></div>
        </div>
        <div class="card">
            <div class="label">Org Email</div>
            <div class="value" id="orgEmail"></div>
        </div>
        <div class="card">
            <div class="label">Contact</div>
            <div class="value" id="orgContact"></div>
        </div>
        <div class="card">
            <div class="label">Department</div>
            <div class="value" id="deptName"></div>
        </div>
        <div class="card">
            <div class="label">Capacity</div>
            <div class="value" id="capacity"></div>
        </div>
        <div class="card">
            <div class="label">Slots</div>
            <div class="value" id="slots"></div>
        </div>
        <div class="card">
            <div class="label">Deadline</div>
            <div class="value" id="deadline"></div>
        </div>
        <div class="card">
            <div class="label">Start</div>
            <div class="value" id="startDate"></div>
        </div>
        <div class="card">
            <div class="label">End</div>
            <div class="value" id="endDate"></div>
        </div>
        <div class="card">
            <div class="label">Approval</div>
            <div class="value" id="approval"></div>
        </div>
    </div>

    <div class="actions">
        <button class="register-btn" id="registerBtn" style="display:none;">Register Now</button>
        <button class="cancel-btn" id="cancelBtn" style="display:none;">Cancel Registration</button>
        <p class="restriction" id="restrictionMsg">⚠ You are restricted to register for this event.</p>
    </div>
</div>

<script>
    const params = new URLSearchParams(window.location.search);
    const eventID = params.get("eventID");

    const btnRegister = document.querySelector(".register-btn");
    const btnCancel = document.querySelector(".cancel-btn");

    let isRestricted = true;
    let isRegistered = true;

    const fmtDate = d => d ? new Date(d).toLocaleDateString("en-PH", {
        year: "numeric",
        month: "long",
        day: "numeric"
    }) : "N/A";
    const fmtText = t => t ? t.charAt(0).toUpperCase() + t.slice(1) : "N/A";
    const fmtNum = n => n ? Number(n).toLocaleString() : "0";
    const safe = v => v || "N/A";

    function getStatusClass(s) {
        switch ((s || "").toLowerCase()) {
            case "open":
                return "status-open";
            case "closed":
                return "status-closed";
            case "ongoing":
                return "status-ongoing";
            case "finished":
                return "status-finished";
            default:
                return "status-open";
        }
    }

    async function verifyRestriction(event_id) {
        const res = await fetch("backend/forBackendData/event_page/verify.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                event_id
            })
        });
        const data = await res.json();
        isRestricted = data.status === true;
    }

    async function loadEvent() {
        const res = await fetch("backend/forBackendData/event_page/loadOneEvent.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                event_id: eventID
            })
        });

        const {
            record: [r]
        } = await res.json();
        const restrict = JSON.parse(r.restrictions || "{}");

        document.getElementById("eventImg").src = "image_data/event_bg_picture/" + (r.event_bg_picture || "nothing.48043394.jpg");
        document.getElementById("eventName").textContent = safe(r.event_name);

        const statusEl = document.getElementById("eventStatus");
        statusEl.textContent = fmtText(r.status);
        statusEl.className = "status " + getStatusClass(r.status);

        document.getElementById("eventDesc").textContent = safe(r.description);
        document.getElementById("eventLocation").textContent = safe(r.location);
        document.getElementById("orgName").textContent = safe(r.org_name);
        document.getElementById("orgEmail").textContent = safe(r.org_email);
        document.getElementById("orgContact").textContent = safe(r.org_contact_no);
        document.getElementById("deptName").textContent = safe(r.department_name);
        document.getElementById("capacity").textContent = fmtNum(r.capacity);
        document.getElementById("slots").textContent = fmtNum(r.slot_taken);
        document.getElementById("deadline").textContent = fmtDate(r.registration_deadline);
        document.getElementById("startDate").textContent = fmtDate(r.start_date);
        document.getElementById("endDate").textContent = fmtDate(r.end_date);
        document.getElementById("approval").textContent = fmtText(r.approval_status);

        await verifyRestriction(eventID);
        await verifyRegistration();

        const msg = document.getElementById("restrictionMsg");
        const btn = document.getElementById("registerBtn");
        const btnCancel = document.getElementById("cancelBtn");

        if (isRegistered) {
            btn.style.display = "none";
            btnCancel.style.display = "inline-block";
        } else {
            btn.style.display = "inline-block";
            btnCancel.style.display = "none";
        }

        if (isRestricted) {
            msg.style.display = "block";
            btn.disabled = true;
            btn.style.opacity = "0.5";
            btn.style.cursor = "not-allowed";
        } else {
            msg.style.display = "none";
            btn.disabled = false;
            btn.style.opacity = "1";
            btn.style.cursor = "pointer";
        }
    }

    if (eventID) loadEvent();

    async function verifyRegistration() {
        const response = await fetch("backend/forBackendData/event_page/verifyRegs.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "event_id": eventID
            })
        });
        const data = await response.json();
        isRegistered = data.status === true;
        console.log(data.message);
    }

    btnRegister.addEventListener("click",async()=>{
        const response = await fetch("backend/forBackendData/event_page/register.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "event_id": eventID
            })
        });
        const data = await response.json();
        if(data.status === true){
            alert("You Registered Successfully!");
            location.reload();
        }else{
            alert("Registration went wrong :(");
        }
    })

    btnCancel.addEventListener("click",async()=>{
        const response = await fetch("backend/forBackendData/event_page/cancel.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "event_id": eventID
            })
        });
        const data = await response.json();
        if(data.status === true){
            alert("You Canceled Your Registration");
            location.reload();
        }else{
            alert("Canceling went wrong :(");
        }
    })
</script>