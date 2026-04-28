<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    .events-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        padding: 40px;
        overflow-x: auto;
    }

    /* Card */
    .card {
        min-width: 280px;
        max-width: 320px;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        flex-shrink: 0;
        transition: 0.2s ease-out;
    }

    .card:hover {
        cursor: pointer;
        transform: scale(1.01);
    }

    /* Image */
    .image-container {
        position: relative;
        width: 100%;
        height: 180px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Status badge */
    .status {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #22c55e;
        color: #fff;
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 999px;
        font-weight: 600;
    }

    /* Content */
    .content {
        padding: 16px;
    }

    .title {
        font-size: 16px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .desc {
        font-size: 14px;
        color: #555;
        line-height: 1.4;
    }
</style>
<div class="events-container">
    
</div>
<script>
    document.addEventListener("DOMContentLoaded", async () => {

    });

    async function loadEvents() {
        const bg_path = "image_data/event_bg_picture";
        const eventContainer = document.querySelector(".events-container");

        const response = await fetch("backend/forBackendData/event_page/loadEvents.php");
        const data = await response.json();

        data.forEach(element => {
            eventContainer.innerHTML +=
                `<div class="card">
        <div class="image-container">
            <span class="status">${element.status}</span>
            <img src="${bg_path + element.event_bg_picture}" alt="">
        </div>

        <div class="content">
            <h3 class="title">${element.event_name}</h3>
            <p class="desc">
                ${element.description} 
            </p>
        </div>
    </div>`
        });
    }
</script>