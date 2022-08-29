$(document).ready(function(){
// Toggling the active class from the patient icon to a doctor
$("#Doctors").removeClass("active");
$("#Patients").addClass("active");
// Looping throw the node list of patient status Element
const statusPatientElements = $(".patientsStatus");
console.log(typeof statusPatientElements);
for(let i = 0 ; i < statusPatientElements.length ; i++) {
     state = statusPatientElements[i].innerText.trim();

    if( state == "s'épuiser") {
        bgColor = "#fad5d9" ; border_text_color = "red" ; 

    }else if (state == "en cours") {
        bgColor = "#d6ffdb" ; border_text_color = "green" ; 

    }else if (state == "il a rendez-vous") {
        bgColor = "#d6fffa" ; border_text_color = "#538c85" ; 

    }else if (state == "il a quitté") {
        bgColor = "#dcdcdc" ; border_text_color = "#888" ; 

    }else if (state == "il a été hospitalisé") {
        bgColor = "#ffe9a9" ; border_text_color = "black" ; 

    }else if (state == "il a été défibéré") {
        bgColor = "#ffc1f9" ; border_text_color = "brown" ; 

    }else if (state == "il a été décédé") {
        bgColor = "#a4a4a4" ; border_text_color = "white" ; 

    }else if (state == "il a été guéri") {
        bgColor = "#6b9069" ; border_text_color = "white" ; 

    }else if (state == "il a été malade") {
        bgColor = "#f3e7fd" ; border_text_color = "#8f13fd" ; 

    }else  {
        bgColor = "#ffffff" ; border_text_color = "#a581c2" ; 

    }
    statusPatientElements[i].setAttribute("style",`background-color: ${bgColor} ; color: ${border_text_color} ; border-color : ${border_text_color} ;`);

}
// Function that checks Patient Status and Give a certain color for each state
function getPatientStatus(ElementId) {
console.log(typeof(ElementId));
const statusPatientElement = document.getElementById(ElementId) ;
const statusPatient = statusPatientElement.innerText.trim() ;

    if( statusPatient == "s'épuiser") {
        bgColor = "#fad5d9" ; border_text_color = "red" ; 

    }else if (statusPatient == "en cours") {
        bgColor = "#d6ffdb" ; border_text_color = "green" ; 

    }else if (statusPatient == "il a rendez-vous") {
        bgColor = "#d6fffa" ; border_text_color = "#538c85" ; 

    }else if (statusPatient == "il a quitté") {
        bgColor = "#dcdcdc" ; border_text_color = "#888" ; 

    }else if (statusPatient == "il a été hospitalisé") {
        bgColor = "#ffe9a9" ; border_text_color = "black" ; 

    }else if (statusPatient == "il a été défibéré") {
        bgColor = "#ffc1f9" ; border_text_color = "brown" ; 

    }else if (statusPatient == "il a été décédé") {
        bgColor = "#a4a4a4" ; border_text_color = "white" ; 

    }else if (statusPatient == "il a été guéri") {
        bgColor = "#6b9069" ; border_text_color = "white" ; 

    }else if (statusPatient == "il a été malade") {
        bgColor = "#f3e7fd" ; border_text_color = "#8f13fd" ; 

    }else {
        bgColor = "#ffffff" ; border_text_color = "#a581c2" ; 

    }
    statusPatientElement.setAttribute("style",`background-color: ${bgColor} ; color: ${border_text_color} ; border-color : ${border_text_color} ;`);
}
});