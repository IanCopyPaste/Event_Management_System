async function checkConn() {
    const response = await fetch("../backend/login.php",{
        method: "GET"
    });
    const data = response.json();
    console.log(data);
}
checkConn();