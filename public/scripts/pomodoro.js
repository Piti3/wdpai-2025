let interval = null;
let remainingTime = 0;
let isBreak = false;

function updateTimerDisplay(seconds) {
    const m = String(Math.floor(seconds / 60)).padStart(2, '0');
    const s = String(seconds % 60).padStart(2, '0');
    document.getElementById('timer').textContent = `00:${m}:${s}`;
}

function tick() {
    if (remainingTime > 0) {
        remainingTime--;
        updateTimerDisplay(remainingTime);
    } else {
        clearInterval(interval);
        fetchStatus(); // Po zakończeniu przełącz fazę
    }
}

function startTimer() {
    fetch('startPomodoro', {
        method: 'POST',
        body: new FormData(document.getElementById('settings-form'))
    })
    .then(() => fetchStatus());
}

function stopTimer() {
    fetch('stopPomodoro', { method: 'POST' }).then(() => {
        clearInterval(interval);
        remainingTime = parseInt(document.getElementById('work-duration').value) * 60;
        updateTimerDisplay(remainingTime);
    });
}

function fetchStatus() {
    fetch('pomodoroStatus')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'running') {
                remainingTime = data.remainingTime;
                isBreak = data.isBreak;
                updateTimerDisplay(remainingTime);
                clearInterval(interval);
                interval = setInterval(tick, 1000);
            }
        });
}

function applySettings() {
    stopTimer();
    startTimer();
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('start-pause-button').addEventListener('click', startTimer);
    document.getElementById('reset-button').addEventListener('click', stopTimer);
    document.querySelector('.settings').addEventListener('click', () => {
        document.getElementById('settings-form').classList.toggle('visible');
    });

    // domyślny czas startowy
    remainingTime = parseInt(document.getElementById('work-duration').value) * 60;
    updateTimerDisplay(remainingTime);
});
