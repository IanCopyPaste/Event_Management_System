<div class="resetPass-container">
    <div id="backFormReset">
        <button>
            < </button>
    </div>
    <h2 style="margin: 20px 0px 0px 0px;">Reset Password</h2>
    <div class="resets-container" style="margin: 20px 0px 40px 0px;">
        <p style="color: red; text-align:end;">*</p>
        <div class="txtBoxes-container">
            <input type="number" id="studID" name="studID" placeholder=" ">
            <label for="studID">Enter Student ID</label>
        </div>
    </div>

    <div class="method-section">
        <h2>Select recovery method Email or SMS:</h2>

        <div class="method-options">
            <div class="option">
                <input type="radio" name="method" id="email" checked>
                <label for="email">Email: email@gmail.com</label>
            </div>
            <div class="option">
                <input type="radio" name="method" id="sms" disabled>
                <label for="sms">SMS: PH+6367676769</label>
                <p style="font-size: 0.9rem; color:red; font-style:italic;">SMS verification is currently unavailable for now walang pambili api yung developer</p>
            </div>
        </div>
    </div>
    <button id="btnProceed">Proceed</button>
</div>
<div class="emailNot-container">
    <p></p>
</div>
<script>
    window.sendOTP = null
    const btnProceed = document.querySelector("#btnProceed");
    const email = document.getElementById("email");
    const sms = document.getElementById("sms");


    const btnBack = document.querySelector("#backFormReset button");

    btnBack.addEventListener("click", () => {
        window.location.href = "loginLanding.php?page=login1"
    });

    btnBack.addEventListener("click", () => {
        window.location.href = "loginLanding.php?page=login1";
    });

    btnProceed.addEventListener("click", async () => {
        btnProceed.innerHTML = "<img src='frontend/assetsImages/loadingGif.gif' style='width:10%; height:22px;'>"
        btnProceed.disabled = true;
        const txtstudID = document.querySelector("#studID");
        let mode = "";

        if (email.checked) {
            mode = "email";
        } else if (sms.checked) {
            mode = "sms";
        }

        const response = await fetch("backend/forBackendData/loginPage/sendOTP.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                student_id: txtstudID.value,
                mode: mode
            })
        });

        const data = await response.json();

        if (data.status) {
            sessionStorage.setItem("sendOTP", JSON.stringify({
                student_id: data.student_id,
                otp: data.otp,
                mode: data.mode
            }));
            const stored = JSON.parse(sessionStorage.getItem("sendOTP"));
            alert(data.message)
            window.location.href = "loginLanding.php?page=confirmOTP";
        } else {
            alert("User not found");
        }
        btnProceed.innerHTML = "Proceed";
        btnProceed.disabled = false;
    });
</script>