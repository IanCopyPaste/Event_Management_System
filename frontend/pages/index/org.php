<style>
    .orgForm-container {
        margin: 5vh auto 10vh auto;
        width: 60%;
        height: 100%;
        padding: 20px;
        border: none;
        border-radius: 10px;
        box-shadow: 3px 3px 5px 2px grey
    }

    .orgForm-container #formLabel {
        margin-bottom: 40px;
        text-align: center;
        font-weight: 600;
        font-size: 1.5rem;
        color: rgba(0, 55, 158, 1);
    }

    .txtFields-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 30px;
    }

    .option-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .option-container select {
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
    }

    .txtInputs-container {
        position: relative;
        margin: auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .txtInputs-container input {
        width: 100%;
        padding: 10px 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .txtInputs-container label {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #555;
        pointer-events: none;
        transition: 0.2s ease all;
        background-color: none;
        padding: 0 4px;
        font-size: 1rem;
    }

    .txtInputs-container input:focus+label,
    .txtInputs-container input:not(:placeholder-shown)+label {
        top: -10px;
        left: 5px;
        font-size: 0.8rem;
        color: blue;
    }

    .btnSubmit-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .btnSubmit-container .btnSubmit {
        width: 40%;
        font-family: 'Barlow', sans-serif;
        font-weight: 600;
        font-size: 15px;
        padding: 10px 35px;
        border-radius: 5px;
        border: none;
        background-color: rgba(39, 115, 255, 1);
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15), 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btnSubmit:hover {
        cursor: pointer;
        transform: scale(1.02);
    }

    .disabled {
        background-color: grey;
    }

    .filesInput-container {
        margin: 10px auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        padding: 10px;
    }
</style>
<form action="" method="POST" class="orgForm-container">
    <p id="formLabel">Create an Organization</p>

    <div class="txtFields-container">
        <div class="txtInputs-container">
            <input type="text" placeholder=" " id="org_name" required>
            <label for="org_name">Enter Organization Name</label>
        </div>

        <div class="option-container">
            <label for="option" style="font-weight:600;">Select Department to Apply with</label>
            <select name="option" id="option" required>
                <option value="10">Department of Information Technology - College of Computing Studies</option>
                <option value="11">Department of Computer Science - College of Computing Studies</option>
                <option value="12">Department of Business Administration - College of Business and Management</option>
                <option value="13">Department of Accountancy - College of Business and Management</option>
                <option value="14">Department of Civil Engineering - College of Engineering</option>
                <option value="15">Department of Psychology - College of Arts and Sciences</option>
            </select>
        </div>

        <div class="txtInputs-container">
            <input type="email" placeholder=" " id="org_email" required>
            <label for="org_email">Enter Organization Email</label>
        </div>

        <div class="txtInputs-container">
            <input type="number" placeholder=" " id="org_number" required>
            <label for="orgname">Enter Organization No. (+63)</label>
        </div>
        <div class="txtInputs-container">
            <input type="text" placeholder=" " id="org_username" required>
            <label for="org_number">Create Username</label>
        </div>
        <div class="txtInputs-container">
            <input type="password" placeholder=" " id="org_password" required>
            <label for="org_password">Create Password</label>
        </div>

        <div class="txtInputs-container">
            <input type="password" placeholder=" " id="org_confirmPassword" required>
            <label for="org_confirmPassword">Confirm Password</label>
        </div>
        <small id="matchMessage"></small>
        <div class="filesInput-container">
            <label for="org_files" style="font-weight: 600;">Additional Files (optional)</label>
            <input type="file" placeholder=" " id="org_files">
        </div>
        <div class="btnSubmit-container">
            <input type="submit" class="btnSubmit">
        </div>
        <p style="color: red; display: none;" id="pendingNotif">You still have a pending application</p>
    </div>
</form>
<script>
    const confirmPass = document.getElementById("org_confirmPassword");
    const pass = document.getElementById("org_password");
    const message = document.getElementById("matchMessage");

    const btnSubmit = document.querySelector(".btnSubmit");

    document.addEventListener("DOMContentLoaded", async () => {
        const pendingNotif = document.querySelector("#pendingNotif");
        const btnSubmit = document.querySelector(".btnSubmit");
        const response = await fetch("backend/forBackendData/createOrganizationPage/checkOrgUserApplication.php");
        const data = await response.json();
        if (data.status) {
            btnSubmit.style.display = "block";
            pendingNotif.style.display = "none"
        } else {
            btnSubmit.style.display = "none";
            pendingNotif.style.display = "block"
        }
    });

    function checkPassword() {
        if (confirmPass.value === "") {
            message.textContent = "";
            btnSubmit.disabled = true;
            btnSubmit.style.backgroundColor = "grey";
            return;
        }

        if (pass.value === confirmPass.value) {
            message.textContent = "Passwords match";
            message.style.color = "green";
            btnSubmit.disabled = false;
            btnSubmit.style.backgroundColor = "rgba(39, 115, 255, 1)";
        } else {
            message.textContent = "Passwords do not match";
            message.style.color = "red";
            btnSubmit.disabled = true;
            btnSubmit.style.backgroundColor = "grey";
        }
    }
    pass.addEventListener("input", checkPassword);
    confirmPass.addEventListener("input", checkPassword);

    btnSubmit.addEventListener("click", async (e) => {
        const txtOrgName = document.getElementById("org_name");
        const txtOrgDept = document.getElementById("option");
        const txtOrgEmail = document.getElementById("org_email");
        const txtOrgNumber = document.getElementById("org_number");
        const txtOrgUsername = document.getElementById("org_username");
        const confirmPass1 = document.getElementById("org_confirmPassword");
        const orgAddedFiles = document.getElementById("org_files");

        e.preventDefault();

        const formData = new FormData();

        if (orgAddedFiles.files[0] != null) {
            formData.append("file", orgAddedFiles.files[0]);
        }

        formData.append("org_name", txtOrgName.value);
        formData.append("org_dept", txtOrgDept.value);
        formData.append("org_email", txtOrgEmail.value);
        formData.append("org_number", txtOrgNumber.value);
        formData.append("org_username", txtOrgUsername.value);
        formData.append("org_password", confirmPass1.value);
        formData.append("user_id", <?php echo $_SESSION["users_id"]; ?>);

        const response = await fetch("backend/forBackendData/createOrganizationPage/orgApplication.php", {
            method: "POST",
            body: formData
        });

        const data = await response.json();
        alert(data.message);
    });
</script>