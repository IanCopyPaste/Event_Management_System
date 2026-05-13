<style>
    :root {
        /* Professional Color Palette */
        --color-open: #22c55e;
        --color-closed: #ef4444;
        --color-ongoing: #3b82f6;
        --color-finished: #6b7280;
        --color-rescheduled: #f59e0b;
        /* Amber/Orange */
        --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    body {
        background-color: #f8fafc;
    }

    .utilities {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        padding: 40px 20px 20px;
    }

    .utilities input,
    .utilities select {
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        outline: none;
        font-size: 14px;
        background: white;
        transition: border-color 0.2s;
        box-shadow: var(--shadow);
        width: 20%;
    }

    .utilities input:focus {
        border-color: #3b82f6;
    }

    .events-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        padding: 40px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f5f9;
    }

    .card:hover {
        cursor: pointer;
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .image-container {
        position: relative;
        height: 200px;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .status-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 14px;
        font-size: 11px;
        border-radius: 50px;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(4px);
    }

    /* Dynamic Status Colors */
    .status-open {
        background: var(--color-open);
    }

    .status-closed {
        background: var(--color-closed);
    }

    .status-ongoing {
        background: var(--color-ongoing);
    }

    .status-finished {
        background: var(--color-finished);
    }

    .status-rescheduled {
        background: var(--color-rescheduled);
    }
    .status-cancelled {
        background-color: black;
    }

    .content {
        padding: 20px;
        flex-grow: 1;
    }

    .date-text {
        font-size: 12px;
        font-weight: 600;
        color: #3b82f6;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .title {
        font-size: 18px;
        color: #1e293b;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .desc {
        font-size: 14px;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Capacity Bar */
    .capacity-wrapper {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }

    .capacity-info {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 6px;
        color: #475569;
    }

    .progress-bg {
        height: 6px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: #3b82f6;
        transition: width 0.5s ease;
    }
</style>

<div class="utilities">
    <input type="text" id="searchBar" placeholder="Search events or locations...">
    <select id="statusFilter">
        <option value="all">All Status</option>
        <option value="open">Open</option>
        <option value="closed">Closed</option>
        <option value="ongoing">Ongoing</option>
        <option value="finished">Finished</option>
        <option value="rescheduled">Rescheduled</option>
    </select>
</div>

<div class="events-container"></div>

<script>
    let allEvents = [];
    const bg_path = "image_data/event_bg_picture/";

    document.addEventListener("DOMContentLoaded", loadEvents);

    async function loadEvents() {
        try {
            const response = await fetch("backend/forBackendData/event_page/loadEvents.php");
            allEvents = await response.json();
            renderEvents(allEvents);
        } catch (error) {
            console.error("Error loading events:", error);
        }
    }

    function getStatusClass(status) {
        const s = (status || "").toLowerCase();
        const map = {
            'open': 'status-open',
            'closed': 'status-closed',
            'ongoing': 'status-ongoing',
            'finished': 'status-finished',
            'rescheduled': 'status-rescheduled',
            'cancelled': 'status-cancelled'
        };
        return map[s] || 'status-open';
    }

    function renderEvents(data) {
        const container = document.querySelector(".events-container");
        container.innerHTML = "";

        data.forEach(e => {

            // Calculate capacity percentage
            const capacityPercent = Math.min(
                (e.slot_taken / e.capacity) * 100,
                100
            );

            const card = document.createElement("div");

            card.className = "card";

            card.innerHTML = `
        <div class="image-container">

            <span class="status-badge ${getStatusClass(e.status)}">
                ${e.status}
            </span>

            <img 
                src="${bg_path + (e.event_bg_picture || 'nothing.jpg')}" 
                alt="${e.event_name}"
            >

        </div>

        <div class="content">

            <div class="date-text">
                ${e.start_date} • ${e.start_time}
            </div>

            <h3 class="title">
                ${e.event_name}
            </h3>

            <p class="desc">
                ${e.description}
            </p>

            <div class="capacity-wrapper">

                <div class="capacity-info">
                    <span>
                        Department
                    </span>
                </div>

                <div 
                    class="dept-cont"

                    style="
                        display:flex;
                        align-items:center;
                        gap:12px;
                        padding:10px 14px;
                        background:#ffffff;
                        border:1px solid #e5e7eb;
                        border-radius:14px;
                        width:fit-content;
                        margin-top:10px;
                        box-shadow:
                            0 4px 12px rgba(0,0,0,0.05),
                            0 1px 3px rgba(0,0,0,0.03);
                    "
                >

                    <img 
                        src="${
                            e.org_logo
                            ? 'image_data/org_logo/' + e.org_logo
                            : 'image_data/org_logo/profileImg.png'
                        }"

                        style="
                            width:48px;
                            height:48px;
                            border-radius:50%;
                            object-fit:cover;
                            border:2px solid #dbeafe;
                            background:#f8fafc;
                        "
                    >

                    <p 
                        style="
                            margin:0;
                            font-size:15px;
                            font-weight:700;
                            color:#111827;
                            white-space:nowrap;
                            overflow:hidden;
                            text-overflow:ellipsis;
                            max-width:220px;
                        "
                    >
                        ${e.org_name}
                    </p>

                </div>

            </div>

        </div>
    `;

            card.onclick = () => location.href = `index.php?page=eventView&eventID=${e.event_id}`;
            container.appendChild(card);
        });
    }

    function applyFilters() {
        const search = document.getElementById("searchBar").value.toLowerCase();
        const status = document.getElementById("statusFilter").value.toLowerCase();

        const filtered = allEvents.filter(e => {
            const matchesSearch = e.event_name.toLowerCase().includes(search) ||
                e.description.toLowerCase().includes(search) ||
                (e.location && e.location.toLowerCase().includes(search));
            const matchesStatus = status === "all" || e.status.toLowerCase() === status;
            return matchesSearch && matchesStatus;
        });
        renderEvents(filtered);
    }

    document.getElementById("searchBar").addEventListener("input", applyFilters);
    document.getElementById("statusFilter").addEventListener("change", applyFilters);

    function formatEventDate(dateStr) {
        if (!dateStr) return "";

        // Creates a date object (ensuring it doesn't shift due to timezone offsets)
        const date = new Date(dateStr);

        // Options: 'long' (January), 'short' (Jan), 'numeric' (01)
        const options = {
            weekday: 'short', // "Tue"
            month: 'long', // "May"
            day: 'numeric', // "12"
            year: 'numeric' // "2026"
        };

        return date.toLocaleDateString('en-US', options);
    }
</script>