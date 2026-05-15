<?php
// organizer_dashboard.php
include("backend/database/config.php");

// Added check to prevent undefined index error if session isn't started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$org_id = $_SESSION["org_id"];

/* =========================================================
    FETCH EVENTS
========================================================= */
$sql = "
SELECT 
    event_id,
    event_name,
    start_date,
    end_date,
    location,
    capacity,
    slot_taken,
    status
FROM events
WHERE org_id = ?
ORDER BY start_date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $org_id);
$stmt->execute();
$events = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organizer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .page-wrapper { max-width: 1400px; margin: auto; padding: 40px 20px; }
        .page-title { font-size: 2rem; font-weight: 700; color: #1c1917; margin-bottom: 28px; letter-spacing: -0.5px; }
        .events-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(330px, 1fr)); gap: 20px; }
        
        .event-card {
            position: relative; overflow: hidden; border-radius: 12px; padding: 24px; cursor: pointer;
            transition: box-shadow 0.2s ease, transform 0.2s ease; border: 1px solid #e7e5e4;
            background: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }
        .event-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 0, 0, 0.10); }
        .event-card h2 { font-size: 1.15rem; font-weight: 600; margin-bottom: 14px; color: #1c1917; padding-right: 80px; }
        .event-meta { color: #78716c; margin-bottom: 8px; font-size: 0.9rem; }
        
        .status-badge {
            position: absolute; top: 20px; right: 20px; padding: 4px 12px; border-radius: 6px;
            font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;
            background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a;
        }

        .registration-footer {
            margin-top: 18px; padding-top: 14px; border-top: 1px solid #e7e5e4;
            display: flex; justify-content: space-between; align-items: center;
        }
        .registration-footer span:first-child { color: #a8a29e; font-size: 0.875rem; }
        .registration-footer span:last-child { color: #1c1917; font-weight: 600; font-size: 0.95rem; }

        .progress-wrapper { margin-top: 14px; }
        .progress-bar { width: 100%; height: 6px; background: #e7e5e4; border-radius: 999px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 999px; background: #1c1917; }
        .progress-text { margin-top: 6px; font-size: 0.8rem; color: #a8a29e; }

        /* MODAL STYLES */
        .modal-overlay {
            position: fixed; inset: 0; background: rgba(28, 25, 23, 0.40); backdrop-filter: blur(4px);
            display: none; justify-content: center; align-items: center; z-index: 999; animation: fadeIn 0.2s ease;
        }
        .modal {
            width: 95%; max-width: 1250px; max-height: 90vh; overflow: hidden;
            border-radius: 16px; border: 1px solid #e7e5e4; background: #ffffff;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15); display: flex; flex-direction: column;
        }
        .modal-header { padding: 22px 26px; border-bottom: 1px solid #e7e5e4; display: flex; justify-content: space-between; align-items: center; background: #fafaf9; }
        .modal-header h2 { font-size: 1.25rem; font-weight: 600; color: #1c1917; }
        .modal-header p { color: #a8a29e; margin-top: 3px; font-size: 0.875rem; }
        .close-btn { width: 36px; height: 36px; border: 1px solid #e7e5e4; border-radius: 8px; background: #ffffff; color: #78716c; font-size: 16px; cursor: pointer; transition: 0.2s ease; }
        .close-btn:hover { background: #fef2f2; border-color: #fecaca; color: #dc2626; }
        .modal-body { padding: 24px; overflow: auto; }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-bottom: 24px; }
        .stat-card { padding: 18px 20px; border-radius: 10px; background: #fafaf9; border: 1px solid #e7e5e4; }
        .stat-card h3 { color: #a8a29e; font-size: 0.8rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .stat-card p { font-size: 1.75rem; font-weight: 700; color: #1c1917; }

        table { width: 100%; border-collapse: collapse; }
        thead th { color: #a8a29e; font-size: 11px; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 600; padding: 0 16px 10px; text-align: left; border-bottom: 1px solid #e7e5e4; }
        tbody tr { border-bottom: 1px solid #f5f5f4; transition: background 0.15s ease; }
        tbody tr:hover { background: #fafaf9; }
        tbody td { padding: 14px 16px; color: #44403c; font-size: 0.9rem; }
        tbody td:first-child { color: #1c1917; font-weight: 500; }

        .program-badge { display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 500; background: #eff6ff; border: 1px solid #bfdbfe; color: #2563eb; }
        .active-badge { display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; background: #f0fdf4; color: #16a34a; }
        .empty-state { text-align: center; padding: 60px 20px; color: #a8a29e; font-size: 1rem; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #d6d3d1; border-radius: 999px; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body>

<div class="page-wrapper">
    <h1 class="page-title">My Created Events</h1>

    <div class="events-grid">
        <?php while ($event = $events->fetch_assoc()): ?>
            <?php $percentage = $event["capacity"] > 0 ? round(($event["slot_taken"] / $event["capacity"]) * 100) : 0; ?>

            <div class="event-card" onclick="openModal(<?= $event['event_id'] ?>, '<?= htmlspecialchars(addslashes($event['event_name'])) ?>')">
                <div class="status-badge"><?= htmlspecialchars($event['status']) ?></div>
                <h2><?= htmlspecialchars($event['event_name']) ?></h2>
                <p class="event-meta">📅 <?= date('M d, Y', strtotime($event['start_date'])) ?></p>
                <p class="event-meta">📍 <?= htmlspecialchars($event['location']) ?></p>
                <p class="event-meta">👥 <?= $event['slot_taken'] ?> Registrants</p>

                <div class="progress-wrapper">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:<?= $percentage ?>%"></div>
                    </div>
                    <div class="progress-text"><?= $percentage ?>% capacity filled</div>
                </div>

                <div class="registration-footer">
                    <span>Registrations</span>
                    <span><?= $event['slot_taken'] ?> / <?= $event['capacity'] ?></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="modal-header">
            <div>
                <h2 id="modalEventTitle">Event Name</h2>
                <p id="modalEventStats">Loading...</p>
            </div>
            <button class="close-btn" onclick="closeModal()">✕</button>
        </div>

        <div class="modal-body">
            <div class="stats-grid" id="statsGrid"></div>

            <table>
                <thead>
                    <tr>
                        <th>Student ID</th> <th>Name</th>
                        <th>Contact</th>
                        <th>Course & Year</th>
                        <th>Status</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>

            <div class="empty-state" id="emptyState" style="display:none;">No respondents found.</div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById("modalOverlay");

    async function openModal(eventID, eventName) {
        modal.style.display = "flex";
        document.getElementById("modalEventTitle").innerText = eventName;
        
        // Changed layout colspan to 6 to support the new column during load status
        document.getElementById("tableBody").innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-4">Loading respondents...</td>
            </tr>
        `;

        try {
            const response = await fetch(`backend/forBackendData/orgNresponses/fetch_respondents.php?event_id=${eventID}`);
            const data = await response.json();
            renderModalData(data);
        } catch (error) {
            console.error("Fetch Error:", error);
            document.getElementById("tableBody").innerHTML = `<tr><td colspan="6" class="text-center text-red-500 py-4">Error loading data.</td></tr>`;
        }
    }

    function renderModalData(data) {
        document.getElementById("modalEventStats").innerText = `${data.stats.total_registrants} registered • ${data.stats.remaining_slots} remaining slots`;

        document.getElementById("statsGrid").innerHTML = `
            <div class="stat-card"><h3>Total Registrants</h3><p>${data.stats.total_registrants}</p></div>
            <div class="stat-card"><h3>Remaining Slots</h3><p>${data.stats.remaining_slots}</p></div>
            <div class="stat-card"><h3>Capacity Filled</h3><p>${data.stats.percentage}%</p></div>
        `;

        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        if (!data.respondents || data.respondents.length === 0) {
            document.getElementById("emptyState").style.display = "block";
            return;
        }
        document.getElementById("emptyState").style.display = "none";

        data.respondents.forEach(user => {
            const middle = user.middle_name ? `${user.middle_name.charAt(0)}.` : "";

            tableBody.innerHTML += `
                <tr>
                    <td style="font-weight: 600; color: #1c1917;">
                        ${user.student_id || 'N/A'}
                    </td>

                    <td>
                        ${user.first_name} ${middle} ${user.last_name}
                    </td>

                    <td>
                        <div>${user.contact_no}</div>
                        <div style="font-size:12px; color:#78716c; margin-top:4px;">
                            ${user.email}
                        </div>
                    </td>

                    <td>
                        <span class="program-badge">
                            ${user.program_id} - Year ${user.year_level}
                        </span>
                    </td>

                    <td>
                        <span class="active-badge">
                            ${user.status}
                        </span>
                    </td>

                    <td>
                        ${user.registered_at}
                    </td>
                </tr>
            `;
        });
    }

    function closeModal() { modal.style.display = "none"; }

    modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });
    </script>