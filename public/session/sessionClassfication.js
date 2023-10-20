function showSessionCompleted(yes){
    if(yes){
        document.getElementById("completed_sessions").style.display="flex";
        document.getElementById("notCompleted_sessions").style.display="none";

        document.getElementById("session_completed_tab_patient").style.backgroundColor = "var(--container-session-selected-color)";
        document.getElementById("session_pending_tab_patient").style.backgroundColor = "var(--container-session-show-color)";
 }
    else{

        document.getElementById("completed_sessions").style.display="none";
        document.getElementById("notCompleted_sessions").style.display="flex";

        document.getElementById("session_completed_tab_patient").style.backgroundColor = "var(--container-session-show-color)";
        document.getElementById("session_pending_tab_patient").style.backgroundColor = "var(--container-session-selected-color)";
        
    }
}