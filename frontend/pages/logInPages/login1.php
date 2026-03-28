<div class="main-container">
    <div id="backForm">
        <button>
            <<button>
    </div>
    <h2></h2>
    <h1>Login to start now!</h1>
    <div class="input-container">
        <div class="txtBoxes-container">
            <input type="text" id="txtUsername" name="username" placeholder=" ">
            <label for="txtUsername">Enter School ID</label>
        </div>

        <div class="txtBoxes-container">
            <input type="password" id="txtPassword" name="password" placeholder=" ">
            <label for="txtPassword">Enter Password</label>
        </div>
    </div>
    <div class="btnLogin-container">
        <button id="btnLogin">Login</button>
        <a href="">Forgot Password</a>
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
        const school_ID = document.querySelector("#txtUsername").value;
        const password = document.querySelector("#txtPassword").value;
        const response = await fetch("backend/forBackendData/loginPage/login.php", {
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

            notifModal_message.textContent = data.message;
            window.location.href = "index.php";
        } else {
            notifModal.classList.remove("correctPass");
            notifModal.classList.add("wrongPass");

            notifModal_message.textContent = data.message;
        }

    }

    btn_back.addEventListener("click", () => {
        window.location.href = "loginLanding.php"
    });
</script>