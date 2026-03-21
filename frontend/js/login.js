const btnLogin = document.querySelector("#btnLogin");
btnLogin.addEventListener("click",()=>{
    window.location.href = "index.php" ;  
});
async function checkConn() {
    const response = await fetch("../../login.php",{
        method: "GET"
    });
    const data = response.json();
    console.log(data);
}
checkConn();