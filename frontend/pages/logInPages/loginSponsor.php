<div class="main-container">
    <div id="backForm">
        <button>
            <<button>
    </div>
    <h2></h2>
    <p style="color: red; text-align: center;">Only verified sponsor accounts can login.</p>
    <h1>Hello Sponsor! Login Now!</h1>
    <div class="input-container">
        <div class="txtBoxes-container">
            <input type="text" id="txtUsername" name="username" placeholder=" ">
            <label for="txtUsername">Enter Username</label>
        </div>

        <div class="txtBoxes-container">
            <input type="password" id="txtPassword" name="password" placeholder=" ">
            <label for="txtPassword">Enter Password</label>
        </div>
    </div>
    <div class="btnLogin-container">
        <button id="btnLogin">Login</button>
        <!--<a href="loginLanding.php?page=sponsorForm1">No Account Yet? Click Here</a>-->
    </div>
</div>
<div class="resultModal-container">
    <p></p> 
</div>
<script>
    const notifModal = document.querySelector(".resultModal-container");
    const notifModal_message = document.querySelector(".resultModal-container p");

    const btn_back = document.querySelector("#backForm button");
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
                    "username": school_ID,
                    "password": password
                })
            });
            const data = await response.json();
            if (data.status == true) {
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
                        location.href = "sponsor.php"
                    }
                }, 1000); // runs every 1 second
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

    btn_back.addEventListener("click", () => {
        window.location.href = "loginLanding.php?page=login0"
    });

// Function to handle the Enter key press
window.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
        // Prevents default behavior (like form submission if inside a <form> tag)
        event.preventDefault(); 
        // Triggers the login function directly
        login();
    }
});

</script>