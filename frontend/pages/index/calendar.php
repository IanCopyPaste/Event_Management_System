<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    /* CALENDAR */
    .calendar-container {
        width: 80%;
        height: 80vh;
        margin: 40px auto;
        padding: 20px;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
    }

    /* TOOLBAR BUTTONS */
    .fc .fc-button-primary {
        background-color: #2563eb;
        border-color: #2563eb;
        color: #fff;
        border-radius: 6px;
        font-family: 'Barlow', sans-serif;
        font-weight: 600;
        transition: background 0.2s;
    }

    .fc .fc-button-primary:hover {
        background-color: #1d4ed8;
        border-color: #1d4ed8;
    }

    .fc .fc-button-primary:disabled {
        background-color: #93c5fd;
        border-color: #93c5fd;
    }

    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active {
        background-color: #1e40af;
        border-color: #1e40af;
    }

    /* TITLE */
    .fc .fc-toolbar-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1e3a8a;
    }

    /* TODAY HIGHLIGHT */
    .fc .fc-day-today {
        background-color: #eff6ff !important;
    }

    /* COLUMN HEADERS (Sun, Mon, ...) */
    .fc .fc-col-header-cell {
        background-color: #2563eb;
        color: white;
        font-weight: 600;
        padding: 8px 0;
    }

    .fc .fc-col-header-cell a {
        color: white !important;
        text-decoration: none;
    }

    /* EVENTS */
    .fc .fc-event {
        background-color: #2563eb;
        border-color: #1d4ed8;
        color: #fff;
        border-radius: 5px;
        font-size: 0.82rem;
        padding: 2px 5px;
    }

    .fc .fc-event:hover {
        background-color: #1d4ed8;
        cursor: pointer;
    }

    /* LIST VIEW */
    .fc .fc-list-event:hover td {
        background-color: #eff6ff;
    }

    .fc .fc-list-day-cushion {
        background-color: #dbeafe;
        color: #1e3a8a;
        font-weight: 600;
    }

    .event-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .event-modal-content {
        width: 500px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.2s ease;
    }

    .event-header {
        position: relative;
        height: 200px;
    }

    .event-header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .event-header-overlay {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 15px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        color: #fff;
    }

    .event-body {
        padding: 20px;
    }

    .event-body p {
        margin-bottom: 10px;
    }

    .event-details p {
        font-size: 14px;
        margin: 4px 0;
    }

    .event-footer {
        display: flex;
        justify-content: space-between;
        padding: 15px 20px;
        border-top: 1px solid #eee;
    }

    .event-footer button {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    #btnCloseModal {
        background: #e5e7eb;
    }

    #btnGoEvent {
        background: #2563eb;
        color: #fff;
    }
/* HISTORY SECTION */
    .history-container {
        width: 80%;
        margin: 40px auto;
        padding: 30px;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
    }

    .history-container h2 {
        font-size: 1.6rem;
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 5px;
    }

    .history-subtitle {
        color: #6b7280;
        margin-bottom: 25px;
        font-size: 0.95rem;
    }

    .history-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .history-card {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .history-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .history-card img {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }

    .history-card-body {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .history-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .history-detail {
        font-size: 0.85rem;
        color: #4b5563;
        margin-bottom: 4px;
    }

    .history-status {
        margin-top: auto;
        padding-top: 15px;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-finished { background: #dcfce7; color: #166534; }
    .badge-closed { background: #f3f4f6; color: #4b5563; }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

<section class="calendar-container"></section>

<div id="eventModal" class="event-modal">
    <div class="event-modal-content">
        <div class="event-header">
            <img id="eventImage" src="" alt="event image">
            <div class="event-header-overlay">
                <h2 id="eventTitle"></h2>
                <p id="eventOrg"></p>
            </div>
        </div>

        <div class="event-body">
            <p id="eventDesc"></p>

            <div class="event-details">
                <p><strong>Department:</strong> <span id="eventDept"></span></p>
                <p><strong>Location:</strong> <span id="eventLocation"></span></p>
                <p><strong>Date:</strong> <span id="eventDate"></span></p>
                <p><strong>Time:</strong> <span id="eventTime"></span></p>
                <p><strong>Capacity:</strong> <span id="eventCapacity"></span></p>
                <p><strong>Status:</strong> <span id="eventStatus"></span></p>
            </div>
        </div>

        <div class="event-footer">
            <button id="btnCloseModal">Close</button>
            <button id="btnGoEvent">Go to Event</button>
        </div>
    </div>
</div>

<section class="history-container">
    <h2>My Event History</h2>
    <p class="history-subtitle">Events you have previously registered for or attended.</p>
    
    <div class="history-grid" id="historyGrid">
        </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
    const modal = document.getElementById("eventModal");
    const btnClose = document.getElementById("btnCloseModal");
    const btnGo = document.getElementById("btnGoEvent");

    document.addEventListener('DOMContentLoaded', async function() {

        const response = await fetch("backend/forFrontendData/getUserCalendar.php");
        const data = await response.json();

        if (!data.status) return;

        const eventsData = [];

        data.record.forEach(element => {
            let startDate = new Date(element.start_date);
            let endDate = new Date(element.end_date);

            for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                let dateStr = d.toISOString().split('T')[0];

                eventsData.push({
                    id: element.event_id,
                    title: element.event_name,
                    start: dateStr + "T" + element.start_time,
                    end: dateStr + "T" + element.end_time,
                    extendedProps: {
                        description: element.description,
                        department_name: element.department_name,
                        org_name: element.org_name,
                        description: element.description,
                        location: element.location,
                        start_date: element.start_date,
                        end_date: element.end_date,
                        start_time: element.start_time,
                        end_time: element.end_time,
                        capacity: element.capacity,
                        slot_taken: element.slot_taken,
                        status: element.status,
                        event_bg_picture: element.event_bg_picture,
                        created_at: element.created_at
                    }
                });
            }
        });

        const calendar = new FullCalendar.Calendar(
            document.querySelector('.calendar-container'), {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                events: eventsData,
                eventClick: function(info) {
                    const e = info.event;
                    const p = e.extendedProps;

                    document.getElementById("eventTitle").innerText = e.title;
                    document.getElementById("eventOrg").innerText = p.org_name;
                    document.getElementById("eventDesc").innerText = p.description;
                    document.getElementById("eventDept").innerText = p.department_name;
                    document.getElementById("eventLocation").innerText = p.location;
                    document.getElementById("eventDate").innerText = p.start_date + " - " + p.end_date;
                    document.getElementById("eventTime").innerText = p.start_time + " - " + p.end_time;
                    document.getElementById("eventCapacity").innerText = p.slot_taken + "/" + p.capacity;
                    document.getElementById("eventStatus").innerText = p.status;

                    document.getElementById("eventImage").src =
                        "image_data/event_bg_picture/" + p.event_bg_picture;

                    btnGo.onclick = function() {
                        window.location.href = `index.php?page=eventView&eventID=${e.id}`;
                    };

                    modal.style.display = "flex";
                }
            }
        );

        btnClose.onclick = () => modal.style.display = "none";
        window.onclick = (e) => {
            if (e.target === modal) modal.style.display = "none";
        };

        calendar.render();
    });
    async function loadUserHistory() {
    const historyGrid = document.getElementById("historyGrid");
    
    try {
        // You will need to create this PHP endpoint to fetch past responses
        const response = await fetch("backend/forBackendData/myCalendarPage/getUserHistory.php");
        const data = await response.json();

        if (!data.status || !data.record || data.record.length === 0) {
            historyGrid.innerHTML = "<p>No past events found.</p>";
            return;
        }

        let html = "";
        data.record.forEach(event => {
            // Determine badge color based on status
            let badgeClass = event.status === 'finished' ? 'badge-finished' : 'badge-closed';

            html += `
                <div class="history-card">
                    <img src="image_data/event_bg_picture/${event.event_bg_picture || 'default.jpg'}" alt="Event Cover">
                    <div class="history-card-body">
                        <div class="history-title">${event.event_name}</div>
                        <div class="history-detail"><strong>Date:</strong> ${event.start_date} to ${event.end_date}</div>
                        <div class="history-detail"><strong>Location:</strong> ${event.location}</div>
                        <div class="history-status">
                            <span class="badge ${badgeClass}">${event.status}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        historyGrid.innerHTML = html;

    } catch (error) {
        console.error("Error loading history:", error);
        historyGrid.innerHTML = "<p>Failed to load event history.</p>";
    }
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', function() {
    loadUserHistory();
});
</script>