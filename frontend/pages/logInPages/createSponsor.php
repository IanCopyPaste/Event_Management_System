<style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    .sponsor-wrapper {
        position: fixed;
        font-family: 'Barlow', sans-serif;
        font-weight: thin;
        margin: auto;
        top: 5%;
        left: 50%;
        transform: translateX(-50%);
        width: clamp(450px, 70%, 1500px);
        height: 90vh;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px 20px;
        border-radius: 10px;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.7);
        animation: wrapperFadeIn 0.8s ease;
        display: flex;
        flex-direction: column;
    }

    .sponsor-wrapper h2 {
        text-align: center;
        margin-bottom: 100px;
        font-size: 1.5rem;
    }

    .sponsor-wrapper h1 {
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 30px;
    }

    .sponsor-wrapper .field-scroll-area {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        flex: 1;
        min-height: 0;
        width: 100%;
        gap: 20px;
        overflow-y: auto;
        padding: 20px 0px;
        scrollbar-width: thin;
    }

    .field-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        width: 100%;
    }

    .field-group .field-label {
        font-size: 0.9rem;
        color: #000000;
        display: block;
        line-height: 1.3;
    }

    .field-group .field-input {
        display: block;
        width: 100%;
        padding: 10px 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .sponsor-wrapper .action-bar {
        width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0px auto;
        margin-top: 20px;
        gap: 15px;
    }

    .sponsor-wrapper .action-bar #btnRegister {
        width: 90%;
        padding: 10px;
        font-size: 1rem;
        background-color: rgba(0, 55, 158, 1);
        color: white;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-weight: 600;
        outline: none;
        border: none;
        border-radius: 5px;
        transition: 0.1s ease;
    }

    .action-bar #btnRegister:hover {
        cursor: pointer;
        transform: scale(1.02);
        box-shadow: 3px 0px 5px rgba(0, 0, 0, 0.5);
    }

    .action-bar .login-redirect {
        color: black;
        transition: 0.1s ease-in;
    }

    .action-bar .login-redirect:hover {
        transform: scale(1.01);
    }

    @keyframes wrapperFadeIn {
        from {
            opacity: 0;
            top: 0px;
        }

        to {
            opacity: 1;
            top: 5%;
        }
    }

    .status-toast {
        background-color: rgb(238, 0, 0);
        color: white;
        font-weight: 600;
        letter-spacing: 2px;
        font-family: 'Barlow', sans-serif;
        font-size: 1.2rem;
        padding: 25px 65px;
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        border: none;
        visibility: hidden;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.5);
    }

    .toast-error {
        border: 2px red solid;
        background-color: white;
        color: black;
        visibility: visible;
    }

    .toast-success {
        border: 2px rgb(0, 175, 0) solid;
        background-color: white;
        color: black;
        visibility: visible;
    }
</style>
<div class="sponsor-wrapper">
    <h1>Create Sponsor Account Now!</h1>
    <div class="field-scroll-area">
        <div class="field-group"> <label class="field-label">Company Name</label> <input class="field-input" type="text" name="company_name"> </div>
        <div class="field-group"> <label class="field-label">Company Address</label> <input class="field-input" type="text" name="company_address"> </div>
        <div class="field-group"> <label class="field-label">Email</label> <input class="field-input" type="email" name="sponsor_email"> </div>
        <div class="field-group"> <label class="field-label">Contact Number</label> <input class="field-input" type="number" name="sponsor_contact_no"> </div>
        <div class="field-group"> <label class="field-label">Additional Documents</label> <input class="field-input" type="file" name="additional_documents"> </div>
        <div class="field-group"> <label class="field-label">Username</label> <input class="field-input" type="text" name="username"> </div>
        <div class="field-group"> <label class="field-label">Password</label> <input class="field-input" type="password" name="password"> </div>
        <div class="field-group"> <label class="field-label">Confirm Password</label> <input class="field-input" type="password" name="Cpassword"> </div>
    </div>
    <div class="action-bar"> <button id="btnRegister">Create Account</button> <a class="login-redirect" href="loginLanding.php?page=sponsorForm0">Already have an account? Click Here</a> </div>
</div>
<div class="status-toast">
    <p></p>
</div>
<script>
    document.querySelector("#btnRegister").addEventListener("click", () => {
        insertSponsor();
    });
    async function insertSponsor() {

        const company_name = document.querySelector('[name="company_name"]').value.trim();
        const company_address = document.querySelector('[name="company_address"]').value.trim();
        const sponsor_email = document.querySelector('[name="sponsor_email"]').value.trim();
        const sponsor_contact_no = document.querySelector('[name="sponsor_contact_no"]').value.trim();
        const additional_documents = document.querySelector('[name="additional_documents"]').files[0];

        const username = document.querySelector('[name="username"]').value.trim();
        const password = document.querySelector('[name="password"]').value;
        const Cpassword = document.querySelector('[name="Cpassword"]').value;

        // validation
        if (!company_name || !company_address || !sponsor_email || !sponsor_contact_no || !username || !password || !Cpassword) {
            alert("All fields are required");
            return;
        }

        if (password !== Cpassword) {
            alert("Passwords do not match");
            return;
        }

        try {
            const notifSent = await sendNotification(sponsor_email, company_name);

            if (notifSent) {
                const formData = new FormData();
                formData.append("company_name", company_name);
                formData.append("company_address", company_address);
                formData.append("sponsor_email", sponsor_email);
                formData.append("sponsor_contact_no", sponsor_contact_no);
                formData.append("additional_documents", additional_documents);
                formData.append("username", username);
                formData.append("password", password);

                const res = await fetch("backend/forBackendData/loginSponsorPage/createSponsor.php", {
                    method: "POST",
                    body: formData
                });

                const data = await res.json();

                if (data.status === true) {
                    alert("Application Submitted Successfully!");
                    location.reload();
                } else {
                    alert("Submission failed");
                }
            } else {
                alert("Failed to send email notification");
            }

        } catch (err) {
            console.error(err);
            alert("Something went wrong");
        }
    }

    async function sendNotification(email, company_name) {
        try {
            const r = await fetch("backend/forBackendData/loginSponsorPage/sendNotif.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json" // ✅ FIXED
                },
                body: JSON.stringify({
                    sponsor_email: email,
                    company_name: company_name
                })
            });

            const d = await r.json();
            return d.status === true;

        } catch (err) {
            console.error("Notification error:", err);
            return false;
        }
    }
</script>