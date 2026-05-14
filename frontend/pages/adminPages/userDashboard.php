<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6 bg-white p-6 rounded-xl shadow-sm">
        <div>
            <h1 class="text-2xl font-bold">Member Directory</h1>
            <p class="text-gray-500 text-sm">Manage roles, status, and bulk registration</p>
        </div>

        <div class="flex items-center gap-2">
            <input type="file" id="csvFile" class="text-sm border rounded-lg p-1">
            <button onclick="handleUpload()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                Bulk Upload
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr class="text-xs font-bold text-gray-400 uppercase">
                    <th class="p-4">User Details</th>
                    <th class="p-4">Program & Year</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
            </tbody>
        </table>
    </div>
</div>

<div id="statusModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-80">
        <h2 class="text-lg font-bold mb-4">Change User Status</h2>
        <div class="space-y-3">
            <button onclick="submitStatus('active')" class="w-full py-3 bg-green-50 text-green-700 font-bold rounded-xl border border-green-200 hover:bg-green-100">
                Set to Active
            </button>
            <button onclick="submitStatus('inactive')" class="w-full py-3 bg-red-50 text-red-700 font-bold rounded-xl border border-red-200 hover:bg-red-100">
                Set to Inactive
            </button>
        </div>
        <button onclick="toggleModal()" class="w-full mt-4 text-gray-400 text-sm">Cancel</button>
    </div>
</div>

<script>
    // Global variable to track which user we are editing
let selectedUserId = null;

// FLOW 1: LOAD USERS
async function loadUsers() {
    const response = await fetch('backend/forBackendData/adminNusers/get_users.php');
    const users = await response.json();
    
    const container = document.getElementById('userTableBody');
    container.innerHTML = users.map(user => `
        <tr class="border-b hover:bg-gray-50 transition">
            <td class="p-4">
                <p class="font-bold text-gray-900">${user.first_name} ${user.last_name}</p>
                <p class="text-xs text-gray-500">${user.email} | ${user.contact_no}</p>
            </td>
            <td class="p-4 text-sm text-gray-600">
                ${user.program_id} <span class="text-gray-300 mx-1">|</span> Year ${user.year_level}
            </td>
            <td class="p-4">
                <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase 
                    ${user.status === 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'}">
                    ${user.status}
                </span>
            </td>
            <td class="p-4">
                <button onclick="prepareStatusChange(${user.users_id})" class="text-indigo-600 text-sm font-bold">
                    Edit Status
                </button>
            </td>
        </tr>
    `).join('');
}

// FLOW 2: CHANGE STATUS (Modal Flow)
function prepareStatusChange(userId) {
    selectedUserId = userId; // Store ID for the fetch call
    toggleModal();
}

async function submitStatus(newStatus) {
    const formData = new FormData();
    formData.append('users_id', selectedUserId);
    formData.append('status', newStatus);

    await fetch('backend/forBackendData/adminNusers/update_status.php', {
        method: 'POST',
        body: formData
    });

    toggleModal();
    loadUsers(); // Refresh the list to show the change
}

// FLOW 3: CSV UPLOAD
async function handleUpload() {
    const fileInput = document.getElementById('csvFile');
    const formData = new FormData();
    formData.append('user_file', fileInput.files[0]);

    await fetch('backend/forBackendData/adminNusers/upload_users.php', {
        method: 'POST',
        body: formData
    });

    alert("Upload processed!");
    loadUsers();
}

function toggleModal() {
    document.getElementById('statusModal').classList.toggle('hidden');
}

// Start the flow on page load
loadUsers();
</script>