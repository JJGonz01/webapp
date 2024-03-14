var sessions;
var selectedDay;
var selectedMonth;
var selectedYear;

document.addEventListener("DOMContentLoaded", function () {
    const currentDate = new Date(); 
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();
    const patientId = document.getElementById("patient-value").content;
    sessions = extractData(document.getElementById("sessions-value").content);
    renderCalendar(currentYear, currentMonth, sessions, patientId);
    createSessionTableWithDay(currentYear, currentMonth, currentDate.getDay());
    divClick(currentYear, currentMonth, currentDate.getDate());
});

function changeMonth(direction, month, year){
  var currentYear = year;
  var currentMonth = month + direction;
  if(currentMonth < 0){
    currentMonth = 11;
    currentYear = year - 1;
  }else if(currentMonth > 11){
    currentMonth = 0;
    currentYear = year + 1;
  }
  var patientId = document.getElementById("patient-value").content;
  sessions = extractData(document.getElementById("sessions-value").content);
  renderCalendar(currentYear, currentMonth, sessions, patientId);
  
  //renderMiniCalendar(currentYear, currentMonth, sessions, patientId);
}

function renderCalendar(year, month, sessions, patientId){
    const firstDay = new Date(year, month,1);
    const lastDay = new Date(year, month+1, 0);
    const daysInMonth = lastDay.getDate();
    var startingDay = firstDay.getDay();
    const monthNames = [
        "Enero", "Febero", "Marzo",
        "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre",
        "Octubre", "Noviembre", "Diciembre"
    ];

    var calendarHTML = `
    <div class="row">
      <div class="col-md-2 button-end-container">
        <div class="row button-container-change-month">
          <button class="button-change-month"  onclick="changeMonth(-1, ${month}, ${year});"><</button>
          <button class="button-change-month"  onclick="changeMonth(+1, ${month}, ${year});">></button>
        </div>
      </div>
      <h2 class="col-md-8">${monthNames[month]} ${year}</h2>
      <div class="col-md-2 button-end-container">
        <button onclick="openPopUpCreateEvent();" class="calendar-button-add">Añadir</button>
      </div>
    </div>
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
            calendarHTML += `<td id="td-${day}" onclick="divClick(${year}, ${month}, ${day})">
                                <div class="row row-day-calendar">
                                    <div class="col-md-6 text-left">                                     
                                      <form action="/createsessiondated/${patientId}/${createSessionOnDate(year, month, day)}" method="GET">
                                        <button class="button-add-session-month" type="submit">+</button>                                    
                                      </form>
                                    </div>
                                    <div class="col-md-5 text-end">   
                                      <p id="p-${day}">${day}</p>
                                    </div>
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
      showCurrentDay(month,year);
      showSelectedDay(month, year);
}

function openPopUpCreateEvent(){
  document.getElementById("eventCreatepopup").style="display:fixed";
}

function showCurrentDay(month,year){
  var currentDate = new Date();
  var day = currentDate.getDate();
  var cMonth = currentDate.getMonth();
  var cYear = currentDate.getFullYear();
  if(month == cMonth && year == cYear){
        document.getElementById(`p-${day}`).className = " p-current-day";
  }
}

function showSelectedDay(month, year){
  if(month == selectedMonth && year == selectedYear){
        divClick(year, month, selectedDay);
  }
}
function getPatientStrId(patient_id){
  return patient_id+"";
}
function extractData(jsonData) {
  var result = {};
  var jsonParsed = JSON.parse(jsonData);
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
        <button onclick="divClick(${year}, ${month}, ${day})" id="${day}" class="button-session">...</button>`

    return `
      <form action="/sessionedit/${ sessions[key][index]["id"]}" method="GET">
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


  function divClick(year, month, day){
    var tdselected = document.getElementsByClassName("calendar-selected") [0];
    if(tdselected)
      tdselected.className = "";
    document.getElementById(`td-${day}`).className = "calendar-selected";
    selectedDay = day;
    selectedMonth = month;
    selectedYear = year;
    createSessionTableWithDay(year, month, day);
  }

  function createSessionTableWithDay(year, month, day){
    let key = createSessionOnDate(year, month, day);
    var table = document.getElementById("sessions-table");
    table.innerHTML = "";
    var tableHTML = '';
    document.getElementById("session-title").innerHTML=`Sesiones programadas para el ${day}/${month+1}/${year}`;
    if(typeof sessions[key] === 'undefined'){
      table.innerHTML = "No hay sesiones creadas para este día"
      return ``
    }

    
    sessions[key].forEach(session => {
      if(typeof session  ===  'undefined'){
        
      }else{
        let completed = "Completada";
        if(session["completed"] == 0){
          completed = "Sin completar";
        }
        tableHTML += `
        <form action="/sessionedit/${ session["id"]}" method="GET">
          <button class="button-session-calendar">
            <div class="row col-md-12">
              <div class="col-md-4">
                ${session["time_start"]}
              </div>
              <div class="col-md-4">
                ${session["name"]}
              </div>
              <div class="col-md-4">
                ${completed}
              </div>
            </div>
          </button>
        </form>
        `
      }
    });
      table.innerHTML = tableHTML;
  }


