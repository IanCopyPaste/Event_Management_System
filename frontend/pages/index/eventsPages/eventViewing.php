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

        .status-open { background: #22c55e; }
        .status-closed { background: #ef4444; }
        .status-ongoing { background: #3b82f6; }
        .status-finished { background: #6b7280; }
        .status-resched { background: #d67d00; }
        .status-cancelled { background: #000000; }

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

        .register-btn, .cancel-btn {
            padding: 12px 18px;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 700;
            cursor: pointer;
        }

        .register-btn { background: #22c55e; }
        .register-btn:hover { background: #16a34a; }
        .cancel-btn { background: #3b82f6; }

        .restriction {
            display: none;
            padding: 10px 14px;
            border-radius: 10px;
            background: #fee2e2;
            color: #991b1b;
            font-weight: 600;
            font-size: 13px;
        }

        /* FEEDBACK SECTION */
        .feedback-section {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #edf2f7;
        }

        .feedback-header {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 20px;
        }

        .feedback-form {
            background: white;
            padding: 24px;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: none;
            border: 1px solid #edf2f7;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 8px;
            margin-bottom: 16px;
        }

        .star-rating input { display: none; }
        .star-rating label {
            font-size: 28px;
            color: #cbd5e1;
            cursor: pointer;
            transition: color .2s ease;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b;
        }

        .feedback-input {
            width: 100%;
            padding: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-family: inherit;
            font-size: 14px;
            resize: vertical;
            margin-bottom: 16px;
            outline: none;
            transition: border-color .2s;
        }

        .feedback-input:focus { border-color: #3b82f6; }

        .submit-feedback-btn {
            background: linear-gradient(135deg, #111827, #374151);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s ease;
        }

        .submit-feedback-btn:hover { transform: translateY(-2px); }

        .comment-card {
            background: white;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 16px;
            border: 1px solid #edf2f7;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background: #e2e8f0;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .user-info-meta {
            display: flex;
            flex-direction: column;
        }

        .user-full-name {
            font-weight: 700;
            font-size: 14px;
            color: #1e293b;
        }

        .user-badge {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
        }

        .comment-stars { color: #f59e0b; font-size: 14px; }
        .comment-text { margin-top: 10px; color: #475569; font-size: 14px; line-height: 1.5; }
        .comment-date { font-size: 11px; color: #94a3b8; margin-top: 8px; }

        /* CONFIRMATION MODALS */
        .confirm-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            backdrop-filter: blur(2px);
        }

        .confirm-modal-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .confirm-modal-box h3 { font-size: 20px; color: #111827; margin-bottom: 12px; font-weight: 700; }
        .confirm-modal-box p { font-size: 14px; color: #4b5563; margin-bottom: 24px; line-height: 1.5; }
        .confirm-modal-actions { display: flex; gap: 12px; justify-content: center; }

        .confirm-modal-btn { padding: 10px 20px; border: none; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; }
        .confirm-modal-btn.yes { background: #22c55e; color: white; }
        .confirm-modal-btn.yes:hover { background: #16a34a; }
        .confirm-modal-btn.cancel-yes { background: #ef4444; color: white; }
        .confirm-modal-btn.cancel-yes:hover { background: #dc2626; }
        .confirm-modal-btn.no { background: #e2e8f0; color: #475569; }
        .confirm-modal-btn.no:hover { background: #cbd5e1; }

        .success-icon-wrapper { display: flex; justify-content: center; align-items: center; margin-bottom: 18px; }
        .success-icon-circle { width: 64px; height: 64px; background-color: #dcfce7; border-radius: 50%; display: flex; justify-content: center; align-items: center; color: #16a34a; font-size: 32px; font-weight: bold; animation: scaleIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .cancel-success-icon-circle { width: 64px; height: 64px; background-color: #fee2e2; border-radius: 50%; display: flex; justify-content: center; align-items: center; color: #dc2626; font-size: 32px; font-weight: bold; animation: scaleIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

        @keyframes scaleIn { from { transform: scale(0); } to { transform: scale(1); } }
    </style>
</head>
<body>

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
        <div class="card full"><div class="label">Description</div><div class="value" id="eventDesc"></div></div>
        <div class="card"><div class="label">Location</div><div class="value" id="eventLocation"></div></div>
        <div class="card"><div class="label">Organization</div><div class="value" id="orgName"></div></div>
        <div class="card"><div class="label">Org Email</div><div class="value" id="orgEmail"></div></div>
        <div class="card"><div class="label">Contact</div><div class="value" id="orgContact"></div></div>
        <div class="card"><div class="label">Department</div><div class="value" id="deptName"></div></div>
        <div class="card"><div class="label">Capacity</div><div class="value" id="capacity"></div></div>
        <div class="card"><div class="label">Registered Count</div><div class="value" id="slots"></div></div>
        <div class="card"><div class="label">Registration Deadline</div><div class="value" id="deadline"></div></div>
        <div class="card"><div class="label">Start</div><div class="value" id="startDate"></div></div>
        <div class="card"><div class="label">End</div><div class="value" id="endDate"></div></div>
        <div class="card"><div class="label">Restricted Year Level</div><div class="value" id="restrictedYear"></div></div>
        <div class="card"><div class="label">Restricted Programs</div><div class="value" id="restrictedProg"></div></div>
    </div>

    <div class="actions">
        <button class="register-btn" id="registerBtn" style="display:none;">Register Now</button>
        <button class="cancel-btn" id="cancelBtn" style="display:none;">Cancel Registration</button>
        <p class="restriction" id="restrictionMsg">⚠ You are restricted to register for this event.</p>
    </div>
    
    <div class="feedback-section">
        <h2 class="feedback-header">Attendee Feedback</h2>
        <form id="feedbackForm" class="feedback-form">
            <div class="label" style="margin-bottom: 10px;">Rate your experience</div>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
            </div>
            <textarea class="feedback-input" id="feedbackComment" rows="3" placeholder="What did you think of the event? Leave a comment..." required></textarea>
            <button type="submit" class="submit-feedback-btn">Post Review</button>
        </form>
        <div id="feedbackList"><p style="color: #64748b; font-size: 14px;">Loading reviews...</p></div>
    </div>
</div>

<div class="confirm-modal-overlay" id="confirmModal">
    <div class="confirm-modal-box">
        <h3>Confirm Registration</h3>
        <p>Are you sure you want to register for this event? Please verify your availability before finalizing.</p>
        <div class="confirm-modal-actions">
            <button class="confirm-modal-btn no" id="confirmNoBtn">Cancel</button>
            <button class="confirm-modal-btn yes" id="confirmYesBtn">Yes, Register</button>
        </div>
    </div>
</div>

<div class="confirm-modal-overlay" id="cancelConfirmModal">
    <div class="confirm-modal-box">
        <h3>Cancel Registration</h3>
        <p>Are you sure you want to cancel your registration? This action will surrender your slot back to the capacity pool.</p>
        <div class="confirm-modal-actions">
            <button class="confirm-modal-btn no" id="cancelConfirmNoBtn">Go Back</button>
            <button class="confirm-modal-btn cancel-yes" id="cancelConfirmYesBtn">Yes, Remove Me</button>
        </div>
    </div>
</div>

<div class="confirm-modal-overlay" id="successModal">
    <div class="confirm-modal-box">
        <div class="success-icon-wrapper"><div class="success-icon-circle">✓</div></div>
        <h3>Success!</h3><p>You are now registered!</p>
        <div class="confirm-modal-actions"><button class="confirm-modal-btn yes" id="successDoneBtn" style="padding: 10px 32px;">OK</button></div>
    </div>
</div>

<div class="confirm-modal-overlay" id="cancelSuccessModal">
    <div class="confirm-modal-box">
        <div class="success-icon-wrapper"><div class="cancel-success-icon-circle">✓</div></div>
        <h3>Cancelled Successfully</h3><p>Your registration has been removed.</p>
        <div class="confirm-modal-actions"><button class="confirm-modal-btn cancel-yes" id="cancelSuccessDoneBtn" style="padding: 10px 32px;">OK</button></div>
    </div>
</div>

<script>
const params = new URLSearchParams(window.location.search);
const eventID = params.get("eventID");

const btnRegister = document.querySelector(".register-btn");
const btnCancelGlobal = document.querySelector(".cancel-btn");
const confirmModal = document.getElementById("confirmModal");
const confirmYesBtn = document.getElementById("confirmYesBtn");
const confirmNoBtn = document.getElementById("confirmNoBtn");
const cancelConfirmModal = document.getElementById("cancelConfirmModal");
const cancelConfirmYesBtn = document.getElementById("cancelConfirmYesBtn");
const cancelConfirmNoBtn = document.getElementById("cancelConfirmNoBtn");
const successModal = document.getElementById("successModal");
const successDoneBtn = document.getElementById("successDoneBtn");
const cancelSuccessModal = document.getElementById("cancelSuccessModal");
const cancelSuccessDoneBtn = document.getElementById("cancelSuccessDoneBtn");

let isRestricted = true;
let isRegistered = true;

const fmtDate = d => d ? new Date(d).toLocaleDateString("en-PH", { year: "numeric", month: "long", day: "numeric" }) : "N/A";
const fmtText = t => t ? t.charAt(0).toUpperCase() + t.slice(1) : "N/A";
const fmtNum = n => n ? Number(n).toLocaleString() : "0";
const safe = v => v || "N/A";

function getStatusClass(s) {
    switch ((s || "").toLowerCase()) {
        case "open": return "status-open";
        case "closed": return "status-closed";
        case "ongoing": return "status-ongoing";
        case "finished": return "status-finished";
        case "rescheduled": return "status-resched";
        case "cancelled": return "status-cancelled";
        default: return "status-open";
    }
}

async function verifyRestriction(event_id) {
    const res = await fetch("backend/forBackendData/event_page/verify.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ event_id })
    });
    const data = await res.json();
    isRestricted = data.status === true;
}

async function verifyRegistration() {
    const response = await fetch("backend/forBackendData/event_page/verifyRegs.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ event_id: eventID })
    });
    const data = await response.json();
    isRegistered = data.status === true;
}

async function loadEvent() {
    try {
        const res = await fetch("backend/forBackendData/event_page/loadOneEvent.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ event_id: eventID })
        });
        const data = await res.json();
        if (!data || !data.records) return;

        // FIXED: Correctly extracts the first item from the array if records is an array
        const r = Array.isArray(data.records) ? data.records : data.records;
        if (!r) return;

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
        
        // FIXED: Safeguarded against null/undefined values before performing .join()
        document.getElementById("restrictedYear").textContent = (r.restrictions && r.restrictions.year_level) ? r.restrictions.year_level.join(", ") : "None";
        document.getElementById("restrictedProg").textContent = (r.program_names && Array.isArray(r.program_names)) ? r.program_names.join(", ") : "None";
        
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
            btn.disabled = true; btnCancel.disabled = true;
            btn.style.opacity = "0.5"; btn.style.cursor = "not-allowed";
            btnCancel.style.opacity = "0.5"; btnCancel.style.cursor = "not-allowed";
        } else {
            msg.style.display = "none";
            btn.disabled = false; btn.style.opacity = "1"; btn.style.cursor = "pointer";
        }
    } catch (err) { console.error("Load event error:", err); }
}

btnRegister.addEventListener("click", () => { confirmModal.style.display = "flex"; });
confirmNoBtn.addEventListener("click", () => { confirmModal.style.display = "none"; });
confirmYesBtn.addEventListener("click", async () => {
    confirmModal.style.display = "none"; 
    const response = await fetch("backend/forBackendData/event_page/register.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ event_id: eventID })
    });
    const data = await response.json();
    if (data.status === true) successModal.style.display = "flex";
    else alert("Registration went wrong :(");
});

successDoneBtn.addEventListener("click", () => { successModal.style.display = "none"; location.reload(); });
btnCancelGlobal.addEventListener("click", () => { cancelConfirmModal.style.display = "flex"; });
cancelConfirmNoBtn.addEventListener("click", () => { cancelConfirmModal.style.display = "none"; });
cancelConfirmYesBtn.addEventListener("click", async () => {
    cancelConfirmModal.style.display = "none";
    const response = await fetch("backend/forBackendData/event_page/cancel.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ event_id: eventID })
    });
    const data = await response.json();
    if (data.status === true) cancelSuccessModal.style.display = "flex";
    else alert("Canceling went wrong :(");
});

cancelSuccessDoneBtn.addEventListener("click", () => { cancelSuccessModal.style.display = "none"; location.reload(); });
window.addEventListener("click", (e) => {
    if (e.target === confirmModal) confirmModal.style.display = "none";
    if (e.target === cancelConfirmModal) cancelConfirmModal.style.display = "none";
});

if (eventID) loadEvent();

/* FEEDBACK LOGIC */
async function loadFeedback() {
    const list = document.getElementById("feedbackList");
    try {
        const res = await fetch("backend/forBackendData/event_page/feedback_list.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ event_id: eventID })
        });
        const data = await res.json();
        if (data.status && data.records.length > 0) {
            list.innerHTML = data.records.map(f => {
                const fullName = `${f.first_name} ${f.last_name}`;
                const profileImg = f.profile_pic ? `image_data/profile_pics/${f.profile_pic}` : 'image_data/profile_pics/default_user.png';
                const yearLevel = f.year_level ? `${f.year_level} Year` : 'Alumni/Other';
                return `
                <div class="comment-card">
                    <div class="comment-header">
                        <img src="${profileImg}" class="user-avatar" alt="User">
                        <div class="user-info-meta">
                            <span class="user-full-name">${safe(fullName)}</span>
                            <span class="user-badge">${yearLevel} • ${safe(f.program_name)}</span>
                        </div>
                        <div style="margin-left: auto;">
                             <span class="comment-stars">${"★".repeat(f.feedback_star)}${"☆".repeat(5 - f.feedback_star)}</span>
                        </div>
                    </div>
                    <div class="comment-text">${safe(f.feedback_comment)}</div>
                    <div class="comment-date">Reviewed on ${fmtDate(f.created_at)}</div>
                </div>`;
            }).join('');
        } else {
            list.innerHTML = `<p style="color: #94a3b8; font-size: 14px; padding: 20px 0;">No reviews yet. Be the first to share your thoughts!</p>`;
        }
    } catch (err) { list.innerHTML = `<p style="color: #ef4444;">Error loading reviews.</p>`; }
}

function checkFeedbackEligibility(eventStatus) {
    const form = document.getElementById("feedbackForm");
    if (isRegistered && (eventStatus || "").toLowerCase() === "finished") form.style.display = "block";
    else form.style.display = "none";
}

document.getElementById("feedbackForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const rating = document.querySelector('input[name="rating"]:checked')?.value;
    const comment = document.getElementById("feedbackComment").value;
    if (!rating) return alert("Please select a star rating!");

    try {
        const res = await fetch("backend/forBackendData/event_page/submit_feedback.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ event_id: eventID, star: rating, comment: comment })
        });
        const data = await res.json();
        if (data.status) {
            alert("Thank you for your feedback!");
            document.getElementById("feedbackForm").reset();
            await loadFeedback();
        } else { alert(data.message || "Failed to submit feedback."); }
    } catch (err) { alert("An error occurred while submitting your feedback."); }
});

const originalLoadEvent = loadEvent;
loadEvent = async () => {
    await originalLoadEvent();
    const currentStatus = document.getElementById("eventStatus").textContent;
    checkFeedbackEligibility(currentStatus);
    loadFeedback();
};
loadEvent();
</script>
