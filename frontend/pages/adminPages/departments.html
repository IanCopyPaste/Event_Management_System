<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif
    }

    body {
        background: #f5f7fb
    }

    .orgsApply-container {
        width: 100%;
        padding: 5px
    }

    .manage-events {
        margin: 20px 0;
        font-size: 27px;
        font-weight: 600;
        color: rgba(0, 65, 156, 1)
    }

    .utilities-container {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 10px
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 4px
    }

    .field label {
        font-size: 12px;
        font-weight: 600
    }

    .utilities-container select,
    .utilities-container input {
        padding: 10px 12px;
        border: 1px solid #cfe8ff;
        border-radius: 6px;
        outline: none
    }

    #txtSearchbar {
        margin-left: auto;
        width: 240px
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #cfe8ff;
        margin-top: 20px
    }

    .orgApplication-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff
    }

    .orgApplication-table thead {
        background: rgba(0, 65, 156, 1)
    }

    .orgApplication-table th,
    .orgApplication-table td {
        padding: 12px;
        font-size: 13px;
        text-align: left;
        border-bottom: 1px solid #e0f0ff
    }

    .orgApplication-table th {
        color: #fff
    }

    .orgApplication-table tbody tr:hover {
        background: #f0f8ff
    }

    .orgApplication-table td button {
        padding: 5px 10px;
        background: rgba(0, 65, 156, 1);
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-right: 5px
    }

    .empty {
        text-align: center;
        color: #60a5fa
    }

    .add-btn {
        margin: 10px;
        padding: 10px 15px;
        background: rgba(0, 65, 156, 1);
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer
    }

    .orgInfo-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 70vh;
        width: 50%;
        background: #fff;
        border-radius: 14px;
        border: 1px solid rgba(83, 155, 255, .3);
        box-shadow: 0 20px 40px rgba(0, 65, 156, .2);
        display: none;
        flex-direction: column
    }

    .btnCloseModal {
        position: absolute;
        top: 10px;
        right: 15px;
        background: transparent;
        border: none;
        font-size: 18px;
        cursor: pointer
    }

    .allOrgInfo-container {
        padding: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px
    }

    .allOrgInfo-container input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px
    }

    .logo-upload {
        grid-column: span 2;
        display: flex;
        flex-direction: column;
        gap: 8px
    }

    .logo-upload img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ddd
    }

    .approvalUtil-container {
        margin-top: auto;
        padding: 15px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #eee
    }

    .approvalUtil-container button {
        padding: 8px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer
    }

    .btnApprove {
        background: green;
        color: #fff
    }

    .btnReject {
        background: red;
        color: #fff
    }

    .btnCancel {
        background: #ddd
    }
    #txtDept_status {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #cfe8ff;
    border-radius: 8px;
    background: #fff;
    font-size: 14px;
    color: #000000;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2300419c' viewBox='0 0 16 16'%3E%3Cpath d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 14px;
    transition: all 0.2s ease;
}

#txtDept_status:focus {
    border-color: grey;
    box-shadow: 0 0 0 3px rgba(0, 65, 156, 0.15);
}
</style>

<div class="orgsApply-container">
    <p class="manage-events">Manage Departments</p>

    <div class="utilities-container">
        <div class="field">
            <label>Filter</label>
            <select id="filterStatus">
                <option value="all">All</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <input type="text" id="txtSearchbar" placeholder="Search department...">
    </div>

    <button id="btnAddDept" class="add-btn">+ Add Department</button>

    <div class="table-wrapper">
        <table class="orgApplication-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="orgInfo-modal" id="deptModal">
    <button class="btnCloseModal">✕</button>
    <h3 style="margin:20px">Department Details</h3>

    <div class="allOrgInfo-container">
        <div class="logo-upload">
            <label>Department Logo</label>
            <img id="logoPreview">
            <input type="file" id="logoInput">
        </div>

        <label>ID</label>
        <input id="txtDept_id" readonly>

        <label>Name</label>
        <input id="txtDept_name">

        <label>Status</label>
        <select id="txtDept_status">
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select>
    </div>

    <div class="approvalUtil-container">
        <button class="btnUpdate">Save Active</button>
        <button class="btnCancel">Close</button>
    </div>
</div>

<script>
    const tableBody = document.querySelector("tbody")
    const modal = document.querySelector(".orgInfo-modal")
    const btnClose = document.querySelector(".btnCloseModal")
    const btnCancel = document.querySelector(".btnCancel")
    const btnUpdate = document.querySelector(".btnUpdate")
    const btnAdd = document.getElementById("btnAddDept")
    const logoInput = document.getElementById("logoInput")
    const logoPreview = document.getElementById("logoPreview")
    const txtId = document.getElementById("txtDept_id")
    const txtName = document.getElementById("txtDept_name")
    const txtStatus = document.getElementById("txtDept_status")
    const search = document.getElementById("txtSearchbar")
    const filterStatus = document.getElementById("filterStatus")
    const sort = document.getElementById("sortByDept")

    const path = "image_data/department_logo/";
    let logo = null;

    let selectedId = null
    let departments = [];

    document.addEventListener("DOMContentLoaded", async () => {
        getDepartments();
    });

    async function getDepartments() {
        const response = await fetch("backend/forBackendData/adminNdepartments/getDepartments.php");
        const data = await response.json();
        const d = data.records;
        departments = d;
        render(departments);
    }

    function render(dept) {
        tableBody.innerHTML = ""
        dept.forEach(d => {
            tableBody.innerHTML += `
<tr>
<td><img src="${d.department_logo ? path + d.department_logo : path + 'logoUKE.svg'}" width="35" height="35"></td>
<td>${d.department_id}</td>
<td>${d.department_name}</td>
<td>${d.status}</td>
<td>
<button class="edit" data-id="${d.department_id}">Edit</button>
<button class="del" data-id="${d.department_id}">Delete</button>
</td>
</tr>`
        })
    }

    function filters() {
        const status = filterStatus.value
        const searchVal = search.value.toLowerCase()

        tableBody.innerHTML = ``

        departments.forEach(d => {
            const matchStatus = status === "all" || d.status === status
            const matchSearch = d.department_name.toLowerCase().includes(searchVal)

            if (matchStatus && matchSearch) {
                tableBody.innerHTML += `
<tr>
<td><img src="${d.department_logo ? path + d.department_logo : 'image_data/department_logo/logoUKE.svg'}" width="35" height="35"></td>
<td>${d.department_id}</td>
<td>${d.department_name}</td>
<td>${d.status}</td>
<td>
<button class="edit" data-id="${d.department_id}">Edit</button>
<button class="del" data-id="${d.department_id}">Delete</button>
</td>
</tr>`
            }
        })
    }

    filterStatus.addEventListener("change", filters)
    search.addEventListener("input", filters)

    tableBody.addEventListener("click", e => {
        const btn = e.target.closest("button")
        const btnDel = e.target.closest(".del")
        if (!btn) return

        const id = btn.dataset.id

        if (btn.classList.contains("edit")) {
            modal.style.display = "flex"

            const dpt = departments.find(d => d.department_id == id)

            if (dpt) {
                logo = dpt.department_logo;
                logoPreview.src = dpt.department_logo
                    ? path + dpt.department_logo
                    : path + "logoUKE.svg"

                txtId.value = dpt.department_id
                txtName.value = dpt.department_name
                txtStatus.value = dpt.status
                console.log(logo);
            }
        }

        if (btn.classList.contains("del")) {
            const result = confirm("Are you to delete Department ID: " + id);
            if (result) {
                deleteDept(id);
            } else {
                console.log("not deleted", id);
            }
        }
    });

    btnCancel.addEventListener("click", () => {
        modal.style.display = "none";
    });
    btnClose.addEventListener("click", () => {
        modal.style.display = "none";
    });
    btnUpdate.addEventListener("click", async () => {
        const formData = new FormData()

        formData.append("dept_name", txtName.value)
        formData.append("dept_status", txtStatus.value)

        if (logoInput.files[0]) {
            formData.append("dept_logo", logoInput.files[0])
        }

        if (txtId.value !== "Auto" && txtId.value !== "") {
            formData.append("dept_id", txtId.value)

            var url = "backend/forBackendData/adminNdepartments/updateDept.php"
        } else {
            var url = "backend/forBackendData/adminNdepartments/insertDept.php"
        }

        const response = await fetch(url, {
            method: "POST",
            body: formData
        })

        const data = await response.json()

        if (data.status) {
            alert("Saved Successfully")
            location.reload()
        } else {
            console.error("save failed")
        }
    });

    async function deleteDept(dept_id) {
        const r = await fetch("backend/forBackendData/adminNdepartments/deleteDept.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "dept_id": dept_id
            })
        });
        const d = await r.json();
        if (d.status === true) {
            //alert("Department ID: " + dept_id + " Deleted");
            location.reload();
        } else {
            alert("something occured");
        }
    }

    btnAdd.addEventListener("click", () => {
        modal.style.display = "flex"

        txtId.value = "Auto"
        txtName.value = ""
        txtStatus.value = "active"
        logoPreview.src = ""
        logoInput.value = ""
        logo = null

        selectedId = null
    })
</script>