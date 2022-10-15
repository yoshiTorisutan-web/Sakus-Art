/* Explication Calendar js */
document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "fr",
    weekNumbers: true,
    navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: true,
    selectable: true,
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
    },
    buttonText: {
      today: "Aujourd'hui",
      month: "Mois",
      week: "Semaine",
      day: "Jour",
      list: "Liste",
    },
    initialDate: "2022-07-01",
    events: [
      {
        title: "Présentation du site",
        start: "2022-07-01",
        color: "lightgreen",
      },
      {
        title: "Ouverture du site",
        start: "2022-08-31",
        color: "green",
      },
      {
        title: "Forum ouvert",
        start: "2022-09-31",
        color: "yellow",
      },
      {
        title: "Maintenance du site",
        start: "2022-10-13T11:00:00",
        end: "2022-10-14T11:00:00",
        color: "red",
      },
      {
        title: "Evolution du site",
        start: "2022-10-15",
        color: "purple",
      },
      {
        title: "Maintenance du site",
        start: "2023-03-23T11:00:00",
        end: "2023-03-24T11:00:00",
        color: "red",
      },
      {
        title: "Mise en place de la boutique",
        start: "2023-03-25",
        color: "blue",
      },

      // areas where "Meeting" must be dropped
      {
        groupId: "availableForMeeting",
        start: "2020-09-11T10:00:00",
        end: "2020-09-11T16:00:00",
        display: "background",
      },
      {
        groupId: "availableForMeeting",
        start: "2020-09-13T10:00:00",
        end: "2020-09-13T16:00:00",
        display: "background",
      },

      // red areas where no events can be dropped
      {
        start: "2020-09-24",
        end: "2020-09-28",
        overlap: false,
        display: "background",
        color: "#ff9f89",
      },
      {
        start: "2020-09-06",
        end: "2020-09-08",
        overlap: false,
        display: "background",
        color: "#ff9f89",
      },
    ],
  });

  calendar.render();
});
