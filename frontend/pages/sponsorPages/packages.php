<?php
$packPath = "image_data/package_bg/";
?>
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

    .utilities-container input,
    .utilities-container select {
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
        height: 75vh;
        width: 55%;
        background: #fff;
        border-radius: 14px;
        display: none;
        flex-direction: column;
        overflow-y: auto
    }

    .btnCloseModal {
        position: absolute;
        top: 10px;
        right: 15px;
        border: none;
        background: transparent;
        font-size: 18px;
        cursor: pointer
    }

    .allOrgInfo-container {
        padding: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px
    }

    .allOrgInfo-container input,
    .allOrgInfo-container select,
    textarea {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px
    }

    .bg-preview {
        grid-column: span 2;
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ddd
    }

    .benefit-box {
        grid-column: span 2
    }

    .benefit-item {
        display: flex;
        gap: 10px;
        margin-bottom: 8px
    }

    .benefit-item input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 6px
    }

    .benefit-item button {
        background: red;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer
    }

    .add-benefit {
        margin-top: 5px;
        padding: 6px 10px;
        background: green;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 5px
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

    .btn-edit {
        padding: 6px 12px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #00419c, #2f80ed);
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        margin-right: 5px
    }

    .btn-delete {
        padding: 6px 12px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #ff3b3b, #ff6b6b);
        color: #fff;
        font-weight: 600;
        cursor: pointer
    }

    #txtStatus {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cfe8ff;
        border-radius: 10px;
        background: #fff;
        font-size: 14px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2300419c' viewBox='0 0 16 16'%3E%3Cpath d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 14px
    }
</style>

<div class="orgsApply-container">
    <p class="manage-events">Manage Sponsorship Packages</p>

    <div class="utilities-container">
        <select id="filterStatus">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <input type="text" id="txtSearchbar" placeholder="Search package...">
    </div>

    <button id="btnAddDept" class="add-btn">+ Add Package</button>

    <div class="table-wrapper">
        <table class="orgApplication-table">
            <thead>
                <tr>
                    <th>BG</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="orgInfo-modal">
    <div class="title-modal">
        <h3 style="padding:10px">Package Details</h3>
        <button class="btnCloseModal">✕</button>
    </div>

    <div class="allOrgInfo-container">

        <img id="bgPreview" class="bg-preview" src="<?= $packPath . "nothing.jpg" ?>">
        <label>Background</label>
        <input type="file" id="bgInput">

        <label>Package Name</label>
        <input id="txtPackage_name" placeholder="Gold Package">

        <label>Description</label>
        <textarea id="txtDescription" rows="4" placeholder="Describe package..."></textarea>

        <label>Price</label>
        <input id="txtPrice" type="number" placeholder="50000">

        <div class="benefit-box">
            <label>Offered</label>
            <div id="benefitContainer"></div>
            <button type="button" class="add-benefit" id="addBenefit">+ Add Offer</button>
        </div>

        <label>Status</label>
        <select id="txtStatus">
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select>

    </div>

    <div class="approvalUtil-container">
        <button class="btnUpdate" style="background:#00419c;color:#fff">Save</button>
        <button class="btnCancel">Close</button>
    </div>
</div>

<script>
    const tableBody = document.querySelector("tbody")
    const modal = document.querySelector(".orgInfo-modal")
    const btnAdd = document.getElementById("btnAddDept")
    const btnClose = document.querySelector(".btnCloseModal")
    const btnCancel = document.querySelector(".btnCancel")
    const btnUpdate = document.querySelector(".btnUpdate")
    const txtName = document.getElementById("txtPackage_name")
    const txtDescription = document.getElementById("txtDescription")
    const txtPrice = document.getElementById("txtPrice")
    const txtStatus = document.getElementById("txtStatus")
    const bgInput = document.getElementById("bgInput")
    const bgPreview = document.getElementById("bgPreview")
    const benefitContainer = document.getElementById("benefitContainer")
    const addBenefitBtn = document.getElementById("addBenefit")
    const searchInput = document.getElementById("txtSearchbar")
    const filterStatus = document.getElementById("filterStatus")

    const path = "image_data/package_bg/"
    let packages = []
    let editId = null

    function addBenefit(v = "") {
        const d = document.createElement("div")
        d.className = "benefit-item"
        d.innerHTML = `<input value="${v}" placeholder="Offer"><button type="button" style="border-radius:200px;">X</button>`
        d.querySelector("button").onclick = () => d.remove()
        benefitContainer.appendChild(d)
    }

    addBenefitBtn.onclick = () => addBenefit()

    function getBenefits() {
        return [...benefitContainer.querySelectorAll("input")].map(i => i.value.trim()).filter(Boolean)
    }

    function applyFilters() {
        const s = (searchInput.value || "").toLowerCase()
        const st = filterStatus.value
        const f = packages.filter(p => {
            const name = (p.package_name || "").toLowerCase()
            const status = (p.status || "").toLowerCase()
            return name.includes(s) && (st === "all" || status === st)
        })
        render(f)
    }

    async function getPackages() {
        const r = await fetch("backend/forBackendData/sponsor_pages/getPackages.php")
        const d = await r.json()
        packages = d.records || []
        applyFilters()
    }

    function render(data) {
        tableBody.innerHTML = ""
        data.forEach(p => {
            tableBody.innerHTML += `
<tr>
<td><img src="${p.package_bg?path+p.package_bg:path+'default.png'}" width="40" height="40"></td>
<td>${p.package_id}</td>
<td>${p.package_name}</td>
<td>${p.price}</td>
<td>${p.status}</td>
<td>
<button class="btn-edit" onclick="edit(${p.package_id})">Edit</button>
<button class="btn-delete" onclick="del(${p.package_id})">Delete</button>
</td>
</tr>`
        })
    }

    btnAdd.onclick = () => {
        editId = null
        txtName.value = ""
        txtDescription.value = ""
        txtPrice.value = ""
        txtStatus.value = "active"
        bgInput.value = ""
        bgPreview.src = ""
        benefitContainer.innerHTML = ""
        addBenefit()
        modal.style.display = "flex"
    }

    btnClose.onclick = btnCancel.onclick = () => modal.style.display = "none"

    btnUpdate.onclick = async () => {
        const fd = new FormData()
        fd.append("package_name", txtName.value)
        fd.append("description", txtDescription.value)
        fd.append("price", txtPrice.value)
        fd.append("status", txtStatus.value)
        fd.append("benefits", JSON.stringify(getBenefits()))
        if (bgInput.files[0]) fd.append("package_bg", bgInput.files[0])
        if (editId) fd.append("package_id", editId)
        const url = editId ?
            "backend/forBackendData/sponsor_pages/updatePacks.php" :
            "backend/forBackendData/sponsor_pages/insertPacks.php"
        const r = await fetch(url, {
            method: "POST",
            body: fd
        })
        const d = await r.json()
        if (d.status) location.reload()
    }

    window.edit = (id) => {
        const p = packages.find(x => x.package_id == id)
        editId = id
        txtName.value = p.package_name
        txtDescription.value = p.description
        txtPrice.value = p.price
        txtStatus.value = p.status
        bgPreview.src = p.package_bg ? path + p.package_bg : path + "default.png"
        benefitContainer.innerHTML = ""
        let b = []
        try {
            b = JSON.parse(p.benefits || "[]")
        } catch (e) {}
        b.length ? b.forEach(x => addBenefit(x)) : addBenefit()
        modal.style.display = "flex"
    }

    window.del = async (id) => {
        if (!confirm("Delete?")) return
        const r = await fetch("backend/forBackendData/sponsor_pages/delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                package_id: id
            })
        })
        const d = await r.json()
        if (d.status) location.reload()
    }

    searchInput.oninput = applyFilters
    filterStatus.onchange = applyFilters
    getPackages()
</script>