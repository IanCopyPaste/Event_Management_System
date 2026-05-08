<style>
* {
    font-family: 'Barlow', sans-serif;
}

#pageLabel {
    color: hsl(212, 100%, 42%);
}

.st1-section {
    width: 100%;
    padding: 10px;
    display: flex;
    justify-content: space-evenly;
    gap: 20px;
    margin: 20px 0px;
}

.st1-section .st1box {
    padding: 30px 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12),
                0 4px 10px rgba(0, 0, 0, 0.08);
    width: 30%;
    border-radius: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 20px;
    background: #fff;
}

.label {
    color: rgba(0, 55, 158, 1);
    font-size: 1.1rem;
    font-weight: 600;
}

.value {
    color: rgba(39, 115, 255, 1);
    font-size: 3rem;
    font-weight: 600;
}

.nd2-section {
    width: 100%;
    padding: 20px;
    margin: 20px 0px;
}

.nd2-section p {
    font-size: 1.2rem;
    font-weight: 600;
    color: rgba(0, 55, 158, 1);
    margin-bottom: 15px;
}

.graph-container {
    width: 100%;
    height: 300px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12),
                0 4px 10px rgba(0, 0, 0, 0.08);
    border-radius: 20px;
    background: #fff;
}

.rd3-section {
    width: 100%;
    padding: 10px;
    display: flex;
    justify-content: space-evenly;
    gap: 20px;
    margin: 20px 0px;
}

.rd3box {
    padding: 30px 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12),
                0 4px 10px rgba(0, 0, 0, 0.08);
    width: 45%;
    border-radius: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 20px;
    background: #fff;
}
</style>

<div class="analytics-container">
    <h1 id="pageLabel">Analytics Dashboard</h1>

    <div class="st1-section">
        <div class="st1box" id="totalRegs">
            <p class="label">Total Registration</p>
            <p class="value">100</p>
        </div>

        <div class="st1box" id="ongoingEvents">
            <p class="label">Event Count</p>
            <p class="value">3</p>
        </div>

        <div class="st1box" id="completionRate">
            <p class="label">Completion Rate</p>
            <p class="value">100%</p>
        </div>
    </div>

    <div class="nd2-section">
        <p>Your Organization's Top 5 Most Viewed and Trending Events</p>
        <div class="graph-container"></div>
    </div>

    <div class="rd3-section">
        <div class="rd3box" id="positiveFeedback">
            <p class="label">Positive Feedback Rate</p>
            <p class="value">67%</p>
        </div>

        <div class="rd3box" id="negativeFeedback">
            <p class="label">Negative Feedback Rate</p>
            <p class="value">33%</p>
        </div>
    </div>
</div>