<style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    .main-container {
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
        animation: formContainer 0.8s ease;
        display: flex;
    flex-direction: column;
    }

    .main-container h2 {
        text-align: center;
        margin-bottom: 100px;
        font-size: 1.5rem;
    }

    .main-container h1 {
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 30px;
    }

    .main-container .input-container {
    display: flex;
    flex-direction: column;
    align-items: stretch;       /* was: center — caused centering push */
    justify-content: flex-start; /* was: center — this was clipping fields */
    flex: 1;                    /* grow to fill available space in parent */
    min-height: 0;              /* critical: allows flex child to scroll */
    width: 100%;
    gap: 20px;
    overflow-y: auto;
    padding: 20px 0px;
    scrollbar-width: thin;
}

    .txtBoxes-container {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .txtBoxes-container label {
        margin-bottom: 5px;
        color: #555;
        font-size: 0.95rem;
    }

    .txtBoxes-container input {
        width: 100%;
        padding: 10px 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .main-container .btnLogin-container {
        width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0px auto;
        margin-top: 20px;
        gap: 15px;
    }

    .main-container .btnLogin-container #btnLogin {
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

    .btnLogin-container #btnLogin:hover {
        cursor: pointer;
        transform: scale(1.02);
        box-shadow: 3px 0px 5px rgba(0, 0, 0, 0.5);
    }

    .btnLogin-container a {
        color: black;
        transition: 0.1s ease-in;
    }

    .btnLogin-container a:hover {
        transform: scale(1.01);
    }

    @keyframes formContainer {
        from {
            opacity: 0;
            top: 0px;
        }
        to {
            opacity: 1;
            top: 5%;
        }
    }

    .resultModal-container {
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

    .wrongPass {
        border: 2px red solid;
        background-color: white;
        color: black;
        visibility: visible;
    }

    .correctPass {
        border: 2px rgb(0, 175, 0) solid;
        background-color: white;
        color: black;
        visibility: visible;
    }
</style>

<div class="main-container">
    <h1>Create Sponsor Account Now!</h1>
    <div class="input-container">

    <div class="txtBoxes-container">
        <input type="text" name="sponsor_name" placeholder="Enter Sponsor Name">
    </div>

    <div class="txtBoxes-container">
        <input type="text" name="description" placeholder="Enter Description">
    </div>

    <div class="txtBoxes-container">
        <textarea name="" id=""></textarea>
    </div>

    <div class="txtBoxes-container">
        <input type="file" name="sponsor_logo">
    </div>

    <div class="txtBoxes-container">
        <input type="email" name="sponsor_email" placeholder="Enter Email">
    </div>

    <div class="txtBoxes-container">
        <input type="text" name="sponsor_contact_no" placeholder="Enter Contact Number">
    </div>

    <div class="txtBoxes-container">
        <input type="file" name="additional_documents">
    </div>

    <div class="txtBoxes-container">
        <input type="text" name="status" placeholder="Enter Status">
    </div>

    <div class="txtBoxes-container">
        <input type="text" name="username" placeholder="Enter Username">
    </div>

    <div class="txtBoxes-container">
        <input type="password" name="password" placeholder="Enter Password">
    </div>

</div>

    <div class="btnLogin-container">
        <button id="btnLogin">Create Account</button>
        <a href="loginLanding.php?page=sponsorForm0">Already have an account? Click Here</a>
    </div>
</div>

<div class="resultModal-container">
    <p></p>
</div>

<script>
    const notifModal = document.querySelector(".resultModal-container");
    const notifModal_message = document.querySelector(".resultModal-container p");

    const btn_login = document.querySelector("#btnLogin");

    btn_login.addEventListener("click", login);

    async function login() {
        try {
            const school_ID = document.querySelector("#txtUsername").value;
            const password = document.querySelector("#txtPassword").value;
            const response = await fetch("backend/forBackendData/loginSponsorPage/login0.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "users_id": school_ID,
                    "password": password
                })
            });
            const data = await response.json();
            if (data.remarks == true) {
                notifModal.classList.remove("wrongPass");
                notifModal.classList.add("correctPass");

                let count = 2;

                notifModal_message.textContent = data.message + " Redirecting in " + count + "s";

                const interval = setInterval(() => {
                    count--;

                    if (count > 0) {
                        notifModal_message.textContent = data.message + " Redirecting in " + count + "s";
                    } else {
                        clearInterval(interval);
                        location.href = ""
                    }
                }, 1000);
            } else {
                notifModal.classList.remove("correctPass");
                notifModal.classList.add("wrongPass");
                notifModal_message.textContent = data.message;
                setTimeout(() => {
                    notifModal.classList.remove("wrongPass");
                }, 3000)
            }

        } catch (error) {
            alert("Error Occured");
        }
    }
</script>