 <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
 <script src="https://unpkg.com/lucide@latest"></script>
 <style>
     * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Barlow', sans-serif;
     }

     body {
         background-color: #f8fafc;
         color: #1e293b;
     }

     .container {
         max-width: 1100px;
         margin: 0 auto;
     }

     /* Header & Navigation */
     .headerss {
         margin-bottom: 40px;
         margin-top: 20px;
     }

     .back-btn {
         display: flex;
         align-items: center;
         gap: 8px;
         background: none;
         border: none;
         cursor: pointer;
         color: #64748b;
         font-weight: 600;
         margin-bottom: 20px;
         transition: color 0.2s;
     }

     .back-btn:hover {
         color: #3b82f6;
     }

     /* Search Bar */
     .search-wrapper {
         max-width: 500px;
         margin: 20px 0;
         position: relative;
     }

     .search-input {
         width: 100%;
         padding: 12px 20px 12px 45px;
         border-radius: 30px;
         border: 1px solid #e2e8f0;
         font-size: 1rem;
         outline: none;
         transition: all 0.2s;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
     }

     .search-input:focus {
         border-color: #3b82f6;
         box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
     }

     .search-icon {
         position: absolute;
         left: 16px;
         top: 50%;
         transform: translateY(-50%);
         color: #94a3b8;
     }

     /* Majestic Grid */
     .majestic-grid {
         display: grid;
         grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
         gap: 25px;
         margin-top: 30px;
     }

     .org-card-majestic {
         background: white;
         border-radius: 20px;
         padding: 30px 20px;
         text-align: center;
         cursor: pointer;
         transition: all 0.3s ease;
         border: 1px solid #f1f5f9;
     }

     .org-card-majestic:hover {
         transform: translateY(-5px);
         box-shadow: 0 12px 20px rgba(0, 0, 0, 0.05);
     }

     .logo-circle-majestic {
         width: 110px;
         height: 110px;
         border-radius: 50%;
         margin: 0 auto 15px;
         overflow: hidden;
         border: 4px solid #f8fafc;
         background: #fff;
         display: flex;
         align-items: center;
         justify-content: center;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
     }

     .logo-circle-majestic img {
         width: 100%;
         height: 100%;
         object-fit: contain;
     }

     .dept-pill {
         background: #eff6ff;
         color: #3b82f6;
         padding: 4px 12px;
         border-radius: 20px;
         font-size: 0.75rem;
         font-weight: 700;
         text-transform: uppercase;
     }

     /* Simple Modal */
     .modal-overlay {
         position: fixed;
         inset: 0;
         background: rgba(15, 23, 42, 0.5);
         backdrop-filter: blur(4px);
         display: none;
         align-items: center;
         justify-content: center;
         z-index: 1000;
         padding: 20px;
     }

     .modal-card {
         background: white;
         width: 100%;
         max-width: 550px;
         border-radius: 24px;
         padding: 30px;
         max-height: 85vh;
         overflow-y: auto;
         position: relative;
     }

     .close-btn {
         position: absolute;
         top: 20px;
         right: 20px;
         cursor: pointer;
         color: #94a3b8;
     }

     .event-item {
         display: flex;
         align-items: center;
         gap: 15px;
         padding: 15px;
         border-radius: 12px;
         margin-bottom: 10px;
         border: 1px solid #f1f5f9;
         transition: background 0.2s;
     }

     .event-item:hover {
         background: #f8fafc;
     }

     .event-item img {
         width: 55px;
         height: 55px;
         border-radius: 10px;
         object-fit: cover;
     }

     .btn-go-event {
         margin-left: auto;
         background: #1e293b;
         color: white;
         border: none;
         padding: 8px 16px;
         border-radius: 8px;
         font-size: 0.8rem;
         font-weight: 700;
         cursor: pointer;
         opacity: 0;
         transition: opacity 0.2s;
     }

     .event-item:hover .btn-go-event {
         opacity: 1;
     }
 </style>

 <div class="container">
     <div class="headerss">
         <button class="back-btn" onclick="window.location.href='index.php'">
             <i data-lucide="arrow-left" size="20"></i> Go Back
         </button>
         <h1 style="font-size: 2.2rem; font-weight: 800;">Authorized Organizers</h1>

         <div class="search-wrapper">
             <i data-lucide="search" class="search-icon" size="18"></i>
             <input type="text" id="orgSearch" class="search-input" placeholder="Search organization or department...">
         </div>
</div>

     <div id="majesticGrid" class="majestic-grid">
     </div>
 </div>

 <div id="majesticModal" class="modal-overlay" onclick="closeMajesticModal()">
     <div class="modal-card" onclick="event.stopPropagation()">
         <i data-lucide="x" class="close-btn" onclick="closeMajesticModal()"></i>

         <div style="text-align: center; margin-bottom: 25px;">
             <div id="modalLogoBox" class="logo-circle-majestic" style="width: 80px; height: 80px;"></div>
             <h2 id="modalOrgName" style="font-weight: 800; font-size: 1.5rem;"></h2>
             <span id="modalOrgDept" class="dept-pill"></span>
         </div>

         <div id="majesticEventList">
         </div>
     </div>
 </div>

 <script>
     let organizations = [];
     const LOGO_BASE = "image_data/org_logo/";
     const EVENT_IMG_BASE = "image_data/event_bg_picture/";

     // 1. Fetch Organizations
     async function loadMajesticData() {
         try {
             const res = await fetch("backend/forBackendData/organization_page/fetch_organizations.php");
             const result = await res.json();
             if (result.status) {
                 organizations = result.data;
                 displayOrgs(organizations);
             }
         } catch (err) {
             console.error("Data fetch error:", err);
         }
     }

     function displayOrgs(data) {
         const grid = document.getElementById("majesticGrid");
         grid.innerHTML = data.map(org => `
            <div class="org-card-majestic" onclick="openOrgDetails(${org.org_id})">
                <div class="logo-circle-majestic">
                    <img src="${org.org_logo ? LOGO_BASE + org.org_logo : LOGO_BASE + 'profileImg.png'}" alt="Logo">
                </div>
                <h3 style="font-weight: 700; margin-bottom: 8px; font-size: 1.1rem;">${org.org_name}</h3>
                <span class="dept-pill">${org.department_name}</span>
            </div>
        `).join('');
     }

     // 2. Real-time Search Logic
     document.getElementById("orgSearch").addEventListener("input", (e) => {
         const val = e.target.value.toLowerCase();
         const filtered = organizations.filter(o =>
             o.org_name.toLowerCase().includes(val) ||
             o.department_name.toLowerCase().includes(val)
         );
         displayOrgs(filtered);
     });

     // 3. Event Modal Logic
     async function openOrgDetails(orgId) {
         const org = organizations.find(o => o.org_id == orgId);
         document.getElementById("modalOrgName").textContent = org.org_name;
         document.getElementById("modalOrgDept").textContent = org.department_name;
         document.getElementById("modalLogoBox").innerHTML = `
            <img src="${org.org_logo ? LOGO_BASE + org.org_logo : LOGO_BASE + 'profileImg.png'}">`;

         const list = document.getElementById("majesticEventList");
         list.innerHTML = "<p style='text-align:center;'>Loading events...</p>";
         document.getElementById("majesticModal").style.display = "flex";

         try {
             const eventRes = await fetch("backend/forBackendData/organization_page/fetch_org_events.php", {
                 method: "POST",
                 headers: {
                     "Content-Type": "application/json"
                 },
                 body: JSON.stringify({
                     org_id: orgId
                 })
             });
             const events = await eventRes.json();

             if (events.status && events.data.length > 0) {
                 list.innerHTML = events.data.map(e => `
                    <div class="event-item">
                        <img src="${e.event_bg_picture ? EVENT_IMG_BASE + e.event_bg_picture : EVENT_IMG_BASE + 'nothing.jpg'}">
                        <div style="flex: 1">
                            <div style="font-weight: 700; font-size: 0.9rem;">${e.event_name}</div>
                            <div style="font-size: 0.75rem; color: #64748b;">${e.status.toUpperCase()} • ${e.start_date}</div>
                        </div>
                        <button class="btn-go-event" onclick="window.location.href='index.php?page=eventView&eventID=${e.event_id}'">
                            Go to Event
                        </button>
                    </div>
                `).join('');
             } else {
                 list.innerHTML = "<p style='text-align: center; color: #94a3b8; padding: 20px;'>No upcoming events found.</p>";
             }
         } catch (err) {
             list.innerHTML = "<p>Error loading events.</p>";
         }
     }

     function closeMajesticModal() {
         document.getElementById("majesticModal").style.display = "none";
     }

     window.onload = () => {
         loadMajesticData();
         lucide.createIcons();
     };
 </script>