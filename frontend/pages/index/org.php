<style>
    .orgForm-container {
        margin: auto;
        width: 75%;
        height: fit-content;
        padding: 20px;
        border: none;
        border-radius: 10px;
        box-shadow: 3px 3px 5px 2px grey
    }

    .orgForm-container #formLabel {
        margin-bottom: 20px;
    }
    .txtFields-container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .txtInputs-container {
        position: relative;
        margin: auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .txtInputs-container input {
        width: 100%;
        padding: 10px 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .txtInputs-container label {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #555;
        pointer-events: none;
        transition: 0.2s ease all;
        background-color: none;
        padding: 0 4px;
        font-size: 1rem;
    }

    .txtInputs-container input:focus+label,
    .txtInputs-container input:not(:placeholder-shown)+label {
        top: -10px;
        left: 5px;
        font-size: 0.8rem;
        color: blue;
    }
</style>
<div class="orgForm-container">
    <p id="formLabel">Create an Organization</p>

    <div class="txtFields-container">
        <div class="txtInputs-container">
            <input type="text" placeholder=" " id="orgname">
            <label for="orgname">Enter Organization Name</label>
        </div>

        <div class="txtInputs-container">
            <select name="option" id="opition">
                <option value="Hello">Hello</option>
                <option value="Hi">Hi</option>
            </select>
        </div>

        <div class="txtInputs-container">
            <input type="email" placeholder=" " id="orgname">
            <label for="orgname">Enter Organization Email</label>
        </div>
        
        <div class="txtInputs-container">
            <input type="number" placeholder=" " id="orgname">
            <label for="orgname">Enter Organization No.</label>
        </div>
        <div class="txtInputs-container">
            <input type="number" placeholder=" " id="orgname">
            <label for="orgname">Create Username</label>
        </div>
        <div class="txtInputs-container">
            <input type="number" placeholder=" " id="orgname">
            <label for="orgname">Create Password</label>
        </div>
        <div class="txtInputs-container">
            <input type="number" placeholder=" " id="orgname">
            <label for="orgname">Confirm Password</label>
        </div>
        <div class="txtInputs-container">
            <button>Submit</button>
        </div>
    </div>
</div>
<script>
    const btnSubmit= document.querySelector(".txtInputs-container button");
    btnSubmit.addEventListener("click",()=>{
        alert("Pressed Form");
    });
</script>