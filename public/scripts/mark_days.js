document.addEventListener("DOMContentLoaded", function () {
    const dayButtons = document.querySelectorAll(".day");

    dayButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault(); 
            this.classList.toggle("checked");

            const date = this.dataset.date;
            const habitId = this.dataset.habitId;
            const isChecked = this.classList.contains("checked");

            console.log(`Habit ${habitId}, date ${date} is now ${isChecked ? 'checked' : 'unchecked'}`);

            fetch('/toggleHabitDay', {
                method: 'POST',
                headers: {'Content-Type': 'application/json' },
                body: JSON.stringify({
                    habit_id: habitId,
                    date: date,
                    checked: isChecked
                })
            })
            .catch(error => console.error('Błąd podczas wysyłania żądania:', error));
        });
    });
});