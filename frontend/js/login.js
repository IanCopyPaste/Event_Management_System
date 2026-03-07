const btnLogin = document.querySelector("#btnLogin");
btnLogin.addEventListener("click",()=>{
    window.location.href = "../index.html" ;  
});
async function checkConn() {
    const response = await fetch("../backend/login.php",{
        method: "GET"
    });
    const data = response.json();
    console.log(data);
}
checkConn();