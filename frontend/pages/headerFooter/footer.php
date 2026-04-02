 <footer class="footer-container">
     <H1 style="text-align: center;">FOOTER</H1>
     <button id="logout">Log out</button>
 </footer>
 <script>
     const btnLogout = document.querySelector("#logout");
     btnLogout.addEventListener("click", async () => {
         try {
             const response = await fetch("backend/forBackendData/logout.php");
             const data = await response.json();
             alert(data.message);
             window.location.href = "loginLanding.php?page=login0"
         } catch (error) {
             console.error(error);
         }
     });
 </script>