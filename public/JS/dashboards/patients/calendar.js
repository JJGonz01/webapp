document.addEventListener("DOMContentLoaded", function () {
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();
  
    renderCalendar(currentYear, currentMonth);
});


function renderCalendar(year, month){
    const firstDay = new Date(year, month,1);
    const lastDay = new Date(year, month+1, 0);
    const daysInMonth = lastDay.getDate();
    var startingDay = firstDay.getDay();

    console.log(firstDay.getDay());
    console.log(startingDay);
    const monthNames = [
        "Enero", "Febero", "Marzo",
        "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre",
        "Octubre", "Noviembre", "Diciembre"
    ];

    var calendarHTML = `
    <h2>${monthNames[month]} ${year}</h2>
    <table id="calendar">
      <thead>
        <tr>
          <th>Lunes</th>
          <th>Martes</th>
          <th>Miercoles</th>
          <th>Jueves</th>
          <th>Viernes</th>
          <th>Sábado</th>
          <th>Domingo</th>
        </tr>
      </thead>
      <tbody>`;

    let day = 1;
    calendarHTML += "<tr>";
    for (let i = 0; i < 7; i++) {
        for (let j = 1; j <= 7; j++) {
          if (i === 0 && j < startingDay) {
            calendarHTML += "<td></td>";
          } else if (day > daysInMonth) {
            break;
          } else {
            calendarHTML += `<td>
                                <div class="row row-day-calendar">
                                    <div class="col-md-6 text-left">
                                        <button onclick='createSessionOnDate(${day}, ${monthNames[month]})'>+</button>
                                    </div>
                                
                                    <p class="col-md-5 text-right">${day}<p>
                                </div>
                            </td>`;
            day++;
          }
        }
        if (day > daysInMonth) {
          break;
        } else {
          calendarHTML += "</tr><tr>";
        }
      }
      calendarHTML += "</tr></tbody></table>";
    
      document.getElementById("calendar").innerHTML = calendarHTML;
}