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

        eventClick: function(info) {
          alert('You clicked: ' + info.event.title);
        }
      });

      calendar.render();
    });