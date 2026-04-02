<div class="resetPass-container">
    <div id="backFormReset">
        <button>
            < </button>
    </div>
    <h2 style="margin: 20px 0px 0px 0px;">Reset Password</h2>
    <p style="margin:20px 0px 10px 0px;font-style:italic;">Enter the One-Time Password (OTP) sent to your Email or SMS to reset your password</p>
    <div class="txtBoxes-container" style="margin-top: 20px;">
        <input type="number" id="txtOTP" name="studID" placeholder=" ">
        <label for="txtOTP">Enter OTP code</label>
    </div>
    <p style=" margin:20px 0px 10px 0px;font-style:italic; font-weight:600;">Didn't get the code?
        <a onclick="resendOTP()" style="color: red; text-decoration:underline; cursor:pointer;">Resend</a>
    </p>

    <button id="btnProceed">Confirm</button>
</div>
<script>
    const btnBack = document.querySelector("#backFormReset button");
    const btnConfirm = document.querySelector("#btnProceed");

    let stored = JSON.parse(sessionStorage.getItem("sendOTP"));

    let OTP = stored.otp;

    btnBack.addEventListener("click", () => {
        window.location.href = "loginLanding.php?page=resetPass"
    })

    async function resendOTP() {
        try {
            const response = await fetch("backend/forBackendData/loginPage/sendOTP.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "student_id": stored.student_id,
                    "mode": "email"
                })
            });
            const data = await response.json();
            sessionStorage.setItem("sendOTP", JSON.stringify({
                student_id: stored.student_id,
                otp: data.otp,
                mode: stored.mode
            }));
            OTP = stored.otp
            alert(data.message);
            window.location.href = window.location.href;

        } catch (error) {
            alert(error);
        }
    }

    btnConfirm.addEventListener("click", () => {
        const txtOTP = document.querySelector("#txtOTP").value;
        if (txtOTP == OTP) {
            alert("you're good!");
            window.location.href = "loginLanding.php?page=changePass"
        } else {
            alert("wrong code bitch");
        }
    });
</script>