document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.habit-name-button');
    const popup = document.getElementById('habit-popup');
    const popupName = document.getElementById('popup-name');
    const popupQuestion = document.getElementById('popup-question');
    const popupFrequency = document.getElementById('popup-frequency');
    const popupNote = document.getElementById('popup-note');
    const popupTarget = document.getElementById('popup-target');
    const closeBtn = document.getElementById('popup-close');
  
    buttons.forEach(function(button) {
      button.onclick = function() {
        const data = JSON.parse(this.dataset.habit);
        popupName.textContent = data.name;
        popupQuestion.textContent = data.question || '---';
        popupFrequency.textContent = data.frequency || '---';
        popupNote.textContent = data.note || '---';
        popupTarget.textContent = data.target || '---';
        popup.style.display = 'flex';
      };
    });
  
    closeBtn.onclick = function() {
      popup.style.display = 'none';
    };
  
    popup.onclick = function(e) {
      if (e.target === popup) {
        popup.style.display = 'none';
      }
    };
  });