const modalContainer = document.querySelector(".modal-container");
document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.querySelector('.calendar-container');
  calendarEl.style.margin = "auto";

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',

    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,list'
    },

    events: [
      {
        title: 'Project Meeting',
        start: '2026-04-05'
      },
      {
        title: 'Seminar',
        start: '2026-04-10',
        end: '2026-04-12'
      },
      {
        title: 'Demo Event',
        start: '2026-04-18T13:00:00'
      }
    ],

    eventClick: function (info) {
      const txtName = document.querySelector(".modal-container h1");
      txtName.textContent = info.event.title;
      modalContainer.style.display = "flex";
    }
  });

  calendar.render();
});
const closeModal = document.querySelector("#closeModal");
closeModal.addEventListener("click", () => {
  modalContainer.style.display = "none";
});