$(document).ready(function(){

    // Definig Variables and elements
    let  allMedecinsData = [] ,TempMedecinsData = [];
    const MedecinInfoLabel = document.getElementById("MedecinInfoLabel");
    const label  = $("#dossier_fk_medecin label");
    const selecter = $("#dossier_fk_specialite");
    // Creating the Object Template for others Objects tp inherit from
    const Medecin = {
        labelid : "",
        nom : "" ,
        prenom : "" ,
        medecin_image : "" ,
        status : "" ,
        specialties : ""
    };
    // ############################# This loop ################################
    for( let i = 0 ; i < label.length ; i++) {
        // label and its input elements  
        let labelI = label[i];

        allMedecinsData.push(labelI.innerText.split('|')) ;
        // Creating Object for each label to put doctor data in it , using the window golbal object 
        window[`medecin_${i + 1}`] = Object.create(Medecin);
        let medecinObject = window[`medecin_${i + 1}`] ;
        medecinObject.labelid = labelI.getAttribute('for');
        medecinObject.nom = allMedecinsData[i][0];
        medecinObject.prenom = allMedecinsData[i][1];
        medecinObject.medecin_image = allMedecinsData[i][2];
        medecinObject.status = allMedecinsData[i][3];
        medecinObject.specialties = allMedecinsData[i][4].replace(/ /g,'').replace(/,+$/, '');
        // Hiding the input and its label
        document.querySelector(`input[id=${medecinObject.labelid}]`).classList.add("d-none");
        labelI.classList.add("d-none");
        // console.log(medecinObject) ;
        TempMedecinsData.push(medecinObject);  
    }
    // console.log(TempMedecinsData);
    // Calling the function to put data , before the user toogles speciality ( Psychologist : By Default )
    getDoctorData();
        // Events
        selecter.on("change", getDoctorData );
    // ########################################## Function Area ###############################################
    
    function getDoctorData () {
        // Clearing the view to display other medecins each times the user selects a speciality
        for( let i = 0 ; i < label.length ; i++ ) {                                                                                                                                                                                                        
            let labelForAtt = label[i].getAttribute('for');
            let MedecinImage = document.querySelector(`img[id=${labelForAtt}]`);
            let checkboxInput = document.querySelector(`input[id=${labelForAtt}]`);
            // Make sure that every checkbox is being unchecked
            checkboxInput.checked = false ;
            // Hiding Checkboces
            checkboxInput.classList.add("d-none");
            // Hiding Labels
            label[i].classList.add("d-none");
            if (MedecinImage != null) {
                // Deleting Image To create it later
               MedecinImage.remove();
            }
                        
        }
        // Defining Variables and getting elements value
       let MedecinsData , Color , Specialite = selecter.val();
       // Conditions to get the doctor Speciality
       Specialite = Specialite == 1 ? "Psychologist"
                    : Specialite == 2 ? "Dentist" 
                    : '' ;
       
       // Giving the Specialite to the Medecin label info
       MedecinInfoLabel.innerHTML = `Medecins with Speciality ( <span class="fw-bolder text-primary">${Specialite}</span> ) :`;
       MedecinsData = SelectingDoctorData(Specialite); // This function returns an array of selected Medecins to be displayed
    //    console.log(MedecinsData) ;
       MedecinsData.forEach((MedecinObj)=> {
           // Selecting Every Label Using its for attribute that was stored in doctor's objects
           let labelForChange = document.querySelector(`[for=${MedecinObj.labelid}]`);
           let inputCheck =  document.querySelector(`input[id=${MedecinObj.labelid}]`);
           let medecinImageElem = document.createElement("img"); // Create an image Element foreach doctor
           let medecinImage ;
           // Showing the input checkboxes
          inputCheck.classList.remove("d-none");
          // Give it some css
          inputCheck.setAttribute("style" ,"width: 50px; margin-left:1rem;");
          // Checking if the Medecin Has an image
          medecinImage = MedecinObj.medecin_image != "" ? ("/assets/Uploads/medecin/" + MedecinObj.medecin_image) : "https://img.freepik.com/free-photo/doctor-with-his-arms-crossed-white-background_1368-5790.jpg?w=2000" ;
           // Giving the img some attributes 
           medecinImageElem.setAttribute("src", medecinImage);
           medecinImageElem.setAttribute("id" , `${MedecinObj.labelid}`);
           medecinImageElem.setAttribute("style" , "width:60px; height:65px; border-radius:50%; margin-right:1rem; margin-left:1rem;");
           medecinImageElem.setAttribute("alt" , "Medecin Image");
           inputCheck.after(medecinImageElem);
           // Checking the status to give a color
           Color = MedecinObj.status == "active" ? "success"
               : MedecinObj.status == "inactive" ? "secondary"
               : MedecinObj.status == "malade" ? "danger"
               : "warning";
               // Putting Doctor data in label
           labelForChange.innerHTML = `<span>${MedecinObj.nom}</span>
                                       <span>${MedecinObj.prenom}</span>
                                       <br>
                                       <span class="d-block text-center fw-bolder text-${Color}">${MedecinObj.status}</span>`;
           // Showing the label  
           labelForChange.classList.remove("d-none");
       });
     }
     
    function SelectingDoctorData(Specialite) {

        // Defining Variables & array
        let isPushable , SelectedMedecinsData = [] ;

        TempMedecinsData.forEach((medecinObj)=>{

            if (medecinObj.specialties.includes(",")) {
                let tempSpecArr = medecinObj.specialties.split(',');
                isPushable = tempSpecArr.includes(Specialite) ? true : false ;
            } else {
                isPushable = (medecinObj.specialties == Specialite ) ? true : false ;
            }
            // if isPushable Variable is true that means that the specialite exists in the doctor object so we have to push it in the array to display it later .
            if(isPushable) {
                SelectedMedecinsData.push(medecinObj);
            } else {
                return ;
            }
       });
            return SelectedMedecinsData ;
    }
});