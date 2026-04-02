 <header class="header-container">
     <div class="upper-container">
         <div class="left-container">
             <a href="index.php">
                 <img src="frontend/assetsImages/univLogo.png" alt="univLogo.png"
                     style="width: clamp(40px, 6vw, 70px); height:auto;">
             </a>

             <h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 
            'Lucida Sans Unicode', Geneva, Verdana, sans-serif; width: 350px;" id="title">
                 University of Kristian Evangelion: Events
             </h2>
         </div>

         <div class="right-container" style="display: none;">
             <div class="info-container">
                 <h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 
                'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                     Dela Cruz, Juan T.
                 </h2>
                 <p>Student ID: 20-2001</p>
             </div>

             <img src="frontend/assetsImages/icons8-management-100.png" alt="profile.png"
                 style="width: clamp(45px, 7vw, 80px); height:auto; border-radius:200px; border:1px solid black;">
         </div>

         <div class="right-container2" style="display: none;">
             <a href="loginLanding.php?page=login0" style="text-decoration: none;"><button class="btnLog" id="btnLogOrg"
                     style="background-color: white; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-weight: bold;">Login</button></a>
             <button class="btnLog" id="btnLogOrg" style="background-color: rgb(0, 100, 214);; color: white; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-weight: bold;">Login as
                 organizer</button>
         </div>
     </div>
     <nav class="nav-container" style="margin:0px 0px 10px 0px;">
         <form action="index.php" method="GET">
             <ul>
                 <li><button name="page" value="home" class="<?= $page == 'home' ? 'active' : '' ?>">Home</button></li>
                 <li><button name="page" value="events" class="<?= $page == 'events' ? 'active' : '' ?>">Events</button></li>
                 <li><button name="page" value="calendar" class="<?= $page == 'calendar' ? 'active' : '' ?>">My Calendar</button></li>
                 <li><button name="page" value="map" class="<?= $page == 'map' ? 'active' : '' ?>">Campus Map</button></li>
             </ul>
         </form>
     </nav>
 </header>
 <script>
     console.log("this is from the header bitch");
     console.log("this is from the header bitch2");
     document.addEventListener("DOMContentLoaded", async () => {
         const profileContainer = document.querySelector(".right-container");
         const profileName = document.querySelector(".info-container h2");
         const profileUserid = document.querySelector(".info-container p");

         const loginContainer = document.querySelector(".right-container2");
         try {
             const response = await fetch("backend/forBackendData/checkUser_id.php");
             const data = await response.json();
             if (data["isStored"] == true) {
                 profileContainer.style.display = "flex";
                 loginContainer.style.display = "none";
                 getUserCredential();
             } else {
                 loginContainer.style.display = "flex";
                 profileContainer.style.display = "none"
             }
         } catch (error) {
             console.error(error);
         }

         async function getUserCredential() {
             const response = await fetch("backend/forBackendData/homePage/userDisplay.php");
             const data = await response.json();
             profileName.textContent = data.last_name + ", " + data.first_name + " " + data.middle_name;
             profileUserid.textContent = "User ID: " + data.users_id;
         }
     });
 </script>