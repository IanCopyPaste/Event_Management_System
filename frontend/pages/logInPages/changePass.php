<div class="resetPass-container">
    <div id="backFormReset">
        <button>
            < </button>
    </div>
    <h2 style="margin-top: 10px;">Change Password</h2>
    <p style="font-style:italic;">Please enter your new password and confirm to continue.</p>
    <div class="txtBoxes-container" style="margin-top: 50px;">
        <input type="password" id="txtNewPass" name="studID" placeholder=" ">
        <label for="txtNewPass">Enter New Password</label>
    </div>
    <div class="txtBoxes-container" style="margin-top: 30px;">
        <input type="password" id="txtConfirmNewPass" name="studID" placeholder=" ">
        <label for="txtConfirmNewPass">Confirm New Password</label>
    </div>
    <p id="txtMatchedNotif"></p>
    <button id="btnProceed">Confirm</button>
</div>
<div class="confirmedPass-container">
    <h2 style="font-family: 'Barlow',sans-serif;">Password changed successfuly! ✓</h2>
    <h3 style="font-family: 'Barlow',sans-serif;">Redirecting to log in page in 4s...</h3>
</div>
<script>
    const btnBack = document.querySelector("#backFormReset button");
    const btnNewPass = document.querySelector("#txtNewPass");
    const btnConfNewPass = document.querySelector("#txtConfirmNewPass");
    const txtMatchedNotif = document.querySelector("#txtMatchedNotif");
    const modal = document.querySelector(".confirmedPass-container");

    const btnConfirm = document.querySelector("#btnProceed");
    btnConfirm.style.backgroundColor = "grey";
    btnConfirm.disabled = true;

    let isMatch = false;



    btnBack.addEventListener("click", () => {
        window.location.href = "loginLanding.php?page=login1";
    });

    function checkMatch() {
        if (btnConfNewPass.value === "") {
            txtMatchedNotif.textContent = "";
            return;
        }

        if (btnNewPass.value === btnConfNewPass.value) {
            txtMatchedNotif.textContent = "Passwords match";
            txtMatchedNotif.style.color = "#16a34a";
            btnConfirm.style.backgroundColor = "rgba(0, 55, 158, 1)";
            btnConfirm.disabled = false;
            isMatch = true;
        } else {
            txtMatchedNotif.textContent = "Passwords do not match";
            txtMatchedNotif.style.color = "#dc2626";
            btnConfirm.style.backgroundColor = "grey";
            btnConfirm.disabled = true;
            isMatch = false;
        }
    }

    btnNewPass.addEventListener("input", checkMatch);
    btnConfNewPass.addEventListener("input", checkMatch);

    const modalNotifCountDown = document.querySelector(".confirmedPass-container h3");

    let count = 4;

    function showSuccess() {
        try {
            modal.classList.add("active");
            modalNotifCountDown.textContent = "Redirecting to log in page in " + count + "s";
            const interval = setInterval(() => {
                count--;
                modalNotifCountDown.textContent = "Redirecting to log in page in " + count + "s";
                if (count === 0) {
                    clearInterval(interval);
                    window.location.href = "loginLanding.php?page=login1";
                }
            }, 1000);
        } catch (error) {
            alert("error occured in javascript");
        }
    }
    btnConfirm.addEventListener("click", async () => {
        let stored = JSON.parse(sessionStorage.getItem("sendOTP"));
        const response = await fetch("backend/forBackendData/loginPage/updatePassword.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "users_id": stored.student_id,
                "newPass": btnConfNewPass.value
            })
        });
        const data = await response.json();
        if (data.status == true) {
            showSuccess();
        }
    });
</script>