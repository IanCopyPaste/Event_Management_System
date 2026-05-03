<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Barlow',sans-serif;
}
html{scrollbar-width:thin;}
.utilities{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:12px;
    padding:30px 40px 0 40px;
}
.utilities input{
    flex:1;
    max-width:420px;
    padding:12px 14px;
    border-radius:10px;
    border:1px solid #e2e8f0;
    outline:none;
    font-size:14px;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
}
.utilities select{
    padding:12px 14px;
    border-radius:10px;
    border:1px solid #e2e8f0;
    outline:none;
    font-size:14px;
    background:white;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
}
.events-container{
    display:flex;
    justify-content:start;
    flex-wrap: wrap;
    width: 100%;
    gap:40px;
    padding:40px;
}
.card{
    min-width:320px;
    max-width:320px;
    border-radius:16px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    flex-shrink:0;
    transition:0.25s ease;
}
.card:hover{
    cursor:pointer;
    transform:translateY(-5px) scale(1.02);
}
.image-container{
    position:relative;
    width:100%;
    height:180px;
    overflow:hidden;
}
.image-container img{
    width:100%;
    height:100%;
    object-fit:cover;
}
.status{
    position:absolute;
    top:10px;
    left:10px;
    padding:6px 12px;
    font-size:12px;
    border-radius:999px;
    font-weight:600;
    color:#fff;
    text-transform:capitalize;
}
.status-open{background:#22c55e;}
.status-closed{background:#ef4444;}
.status-ongoing{background:#3b82f6;}
.status-finished{background:#6b7280;}
.content{
    padding:16px;
    max-height:150px;
    overflow:hidden;
}
.title{
    font-size:16px;
    margin-bottom:8px;
    font-weight:600;
}
.desc{
    font-size:14px;
    color:#555;
    line-height:1.4;
    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
}
</style>

<div class="utilities">
    <input type="text" id="searchBar" placeholder="Search events...">
    <select id="statusFilter">
        <option value="all">All Status</option>
        <option value="open">Open</option>
        <option value="closed">Closed</option>
        <option value="ongoing">Ongoing</option>
        <option value="finished">Finished</option>
    </select>
</div>

<div class="events-container"></div>

<script>
let allEvents=[];

document.addEventListener("DOMContentLoaded",loadEvents);

function getStatusClass(status){
    switch((status||"").toLowerCase()){
        case"open":return"status-open";
        case"closed":return"status-closed";
        case"ongoing":return"status-ongoing";
        case"finished":return"status-finished";
        default:return"status-open";
    }
}

async function loadEvents(){
    const response=await fetch("backend/forBackendData/event_page/loadEvents.php");
    const data=await response.json();
    allEvents=data;
    renderEvents(allEvents);
}

function renderEvents(data){
    const bg_path="image_data/event_bg_picture/";
    const eventContainer=document.querySelector(".events-container");
    eventContainer.innerHTML="";
    data.forEach(element=>{
        const card=document.createElement("div");
        card.className="card";
        card.innerHTML=`
            <div class="image-container">
                <span class="status ${getStatusClass(element.status)}">${element.status}</span>
                <img src="${bg_path+(element.event_bg_picture ?? "nothing.jpg")}" alt="">
            </div>
            <div class="content">
                <h3 class="title">${element.event_name}</h3>
                <p class="desc">${element.description}</p>
            </div>
        `;
        card.addEventListener("click",()=>{
            location.href=`index.php?page=eventView&eventID=${element.event_id}`;
        });
        eventContainer.appendChild(card);
    });
}

const searchBar=document.getElementById("searchBar");
const statusFilter=document.getElementById("statusFilter");

function applyFilters(){
    const search=searchBar.value.toLowerCase();
    const status=statusFilter.value.toLowerCase();
    const filtered=allEvents.filter(e=>{
        const s=e.event_name.toLowerCase().includes(search)||e.description.toLowerCase().includes(search);
        const st=status==="all"||e.status.toLowerCase()===status;
        return s&&st;
    });
    renderEvents(filtered);
}

searchBar.addEventListener("input",applyFilters);
statusFilter.addEventListener("change",applyFilters);
</script>