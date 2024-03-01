document.addEventListener("DOMContentLoaded", function () {
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();
    const sessions = extractData(document.getElementById("sessions-value").content);
    const patientId = document.getElementById("patient-value").content;
    renderCalendar(currentYear, currentMonth, sessions, patientId);
    
});


function renderCalendar(year, month, sessions, patientId){
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
           let td =  document.createElement("td");
           let div =  document.createElement("td");
           let subdiv =  document.createElement("td");
            document.createElement("td");
            document.createElement("td");
            calendarHTML += `<td>
                                <div class="row row-day-calendar">
                                    <div class="col-md-6 text-left">                                     
                                      <form action="/createsessiondated/${patientId}/${createSessionOnDate(year, month, day)}" method="GET">
                                        <button type="submit">+</button>                                    
                                      </form>
                                    </div>
                                    <p class="col-md-5 text-right">${day}</p>
                                </div>
                                
                                ${getSessionName(sessions, year, month, day, 0, patientId)}
                                ${getSessionName(sessions, year, month, day, 1, patientId)}
                                ${getSessionName(sessions, year, month, day, 2, patientId)}
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

function getPatientStrId(patient_id){
  return patient_id+"";
}
function extractData(jsonData) {
  var result = {};
  var jsonParsed = JSON.parse(jsonData);
  console.log(jsonParsed);
  for (var i = 0; i < jsonParsed.length; i++) {
      var entry = jsonParsed[i];
      var dateStart = entry.date_start+"";
      if (!result[dateStart]) {
          result[dateStart] = [];
      }
      result[dateStart].push(entry);
  }
  return result;
}
 
function getSessionName(sessions, year, month, day, index, patientId){
   
    let key = createSessionOnDate(year, month, day);
    
    if(typeof sessions[key] === 'undefined' || typeof sessions[key][index] === 'undefined')
      return ``

    if(index == 2)
      return `
      <form action="/createsessiondated/${patientId}/${createSessionOnDate(year, month, day)}" method="GET">
        <button id="${day}" class="button-session">...</button>
      </form>`

    return `
      <form action="/createsessiondated/${patientId}/${createSessionOnDate(year, month, day)}" method="GET">
        <button id="${day}" class="button-session">${ sessions[key][index]["name"]}</button>
      </form>`

}

function createSessionOnDate(year, month, day){
    let daystr = "";
    let monthstr = "";
    if(day < 10) daystr = "0"+day;
    else daystr = day;
    
    if(month+1 < 10) monthstr = "0"+(month+1);
    return year + "-" + monthstr + "-" + daystr;
}

  function sendForm(day){
    getForm(day).submit();
  }
  function getForm(day){
      return document.getElementById("form-create-"+day);
  }