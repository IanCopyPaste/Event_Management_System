<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-7xl mx-auto p-0 sm:p-6 lg:p-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Member Directory</h1>
            <p class="mt-2 text-sm text-gray-600">Manage roles, update statuses, and bulk register new members.</p>
        </div>
        
        <div class="mt-4 sm:mt-0 flex items-center gap-3 bg-white p-2 rounded-xl shadow-sm border border-gray-200">
            <input type="file" id="csvFile" class="text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer w-full max-w-[200px]">
            <button onclick="handleUpload()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Upload
            </button>
        </div>
    </div>

    <div class="bg-white p-4 rounded-t-xl border border-b-0 border-gray-200 flex flex-col sm:flex-row gap-4 justify-between items-center">
        <div class="relative w-full sm:max-w-xs">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" id="searchInput" placeholder="Search by name or email..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition">
        </div>
        
        <div class="w-full sm:w-auto">
            <select id="statusFilter" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg border">
                <option value="all">All Statuses</option>
                <option value="active">Active Only</option>
                <option value="inactive">Inactive Only</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-b-xl shadow-sm border border-gray-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">User Details</th>
                    <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Program & Year</th>
                    <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody" class="divide-y divide-gray-200 bg-white">
                </tbody>
        </table>
    </div>
</div>

<div id="statusModal" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm hidden flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm mx-4 transform transition-all">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-xl font-bold text-gray-900">Update Status</h2>
            <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <div class="space-y-3">
            <button onclick="submitStatus('active')" class="w-full flex items-center justify-center gap-2 py-3 bg-green-50 text-green-700 font-semibold rounded-xl border border-green-200 hover:bg-green-100 transition">
                <div class="w-2 h-2 rounded-full bg-green-500"></div> Set to Active
            </button>
            <button onclick="submitStatus('inactive')" class="w-full flex items-center justify-center gap-2 py-3 bg-red-50 text-red-700 font-semibold rounded-xl border border-red-200 hover:bg-red-100 transition">
                <div class="w-2 h-2 rounded-full bg-red-500"></div> Set to Inactive
            </button>
        </div>
    </div>
</div>

<script>
let selectedUserId = null;
let allUsers = []; // Store data globally to allow fast client-side searching

// FLOW 1: LOAD USERS
async function loadUsers() {
    try {
        const response = await fetch('backend/forBackendData/adminNusers/get_users.php');
        allUsers = await response.json();
        renderTable(); // Call render function instead of building HTML directly here
    } catch (error) {
        console.error("Failed to fetch users:", error);
        document.getElementById('userTableBody').innerHTML = `<tr><td colspan="4" class="p-6 text-center text-red-500 font-medium">Failed to load data.</td></tr>`;
    }
}

// FLOW 2: RENDER & FILTER TABLE
function renderTable() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const container = document.getElementById('userTableBody');

    // Filter logic
    const filteredUsers = allUsers.filter(user => {
        const fullName = `${user.first_name} ${user.last_name}`.toLowerCase();
        const matchesSearch = fullName.includes(searchQuery) || user.email.toLowerCase().includes(searchQuery);
        const matchesStatus = statusFilter === 'all' || user.status === statusFilter;
        return matchesSearch && matchesStatus;
    });

    // Empty state handling
    if (filteredUsers.length === 0) {
        container.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <p class="text-base font-semibold text-gray-900">No users found</p>
                    <p class="text-sm">Try adjusting your search or filter.</p>
                </td>
            </tr>`;
        return;
    }

    // Build Table Rows
    container.innerHTML = filteredUsers.map(user => `
        <tr class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold">
                        ${user.first_name.charAt(0)}${user.last_name.charAt(0)}
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">${user.first_name} ${user.last_name}</div>
                        <div class="text-sm text-gray-500">${user.email} &bull; ${user.contact_no}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900 font-medium">${user.program_abv || 'N/A'}</div>
                <div class="text-sm text-gray-500">Year ${user.year_level || 'N/A'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium 
                    ${user.status === 'active' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'}">
                    <span class="w-1.5 h-1.5 rounded-full ${user.status === 'active' ? 'bg-green-500' : 'bg-red-500'}"></span>
                    ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button onclick="prepareStatusChange(${user.users_id})" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md transition">
                    Edit Status
                </button>
            </td>
        </tr>
    `).join('');
}

// EVENT LISTENERS FOR SEARCH & DROPDOWN
document.getElementById('searchInput').addEventListener('input', renderTable);
document.getElementById('statusFilter').addEventListener('change', renderTable);

// FLOW 3: MODAL FLOW
function prepareStatusChange(userId) {
    selectedUserId = userId; 
    toggleModal();
}

async function submitStatus(newStatus) {
    const formData = new FormData();
    formData.append('users_id', selectedUserId);
    formData.append('status', newStatus);

    try {
        await fetch('backend/forBackendData/adminNusers/update_status.php', {
            method: 'POST',
            body: formData
        });
        toggleModal();
        loadUsers(); // Refresh the real data
    } catch (error) {
        alert("Failed to update status.");
    }
}

// FLOW 4: CSV UPLOAD
async function handleUpload() {
    const fileInput = document.getElementById('csvFile');
    if (!fileInput.files.length) {
        return alert("Please select a file first.");
    }

    const formData = new FormData();
    formData.append('user_file', fileInput.files[0]);

    try {
        await fetch('backend/forBackendData/adminNusers/upload_users.php', {
            method: 'POST',
            body: formData
        });
        alert("Upload processed!");
        fileInput.value = ''; // Reset file input
        loadUsers();
    } catch (error) {
        alert("Upload failed.");
    }
}

function toggleModal() {
    document.getElementById('statusModal').classList.toggle('hidden');
}

// Initialize
loadUsers();
</script>