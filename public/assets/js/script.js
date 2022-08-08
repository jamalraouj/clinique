// let choicesUsers = document.querySelector('.choicesUsers').innerHtml;

let choicesUsers = document.getElementsByClassName('choicesUsers');
 console.log(choicesUsers);
 
   
// s.addEventListener('input', function(e) {
//     console.log('sdsdsdsd');
//     /

//     // if (e.target.classList.contains('choicesUsers')) {
//     //     e.target.classList.toggle('active');
//     // }
// });

// setInterval(function(){ 
// 	console.log("Oooo Yeaaa!");
//     // dd =choicesUsers.value;
//     console.log(choicesUsers);
// }, 10000);
//function for get value of select
// function getValue(select) {
//     let value = select.options[select.selectedIndex].value;
//     return value;
// }
// //function for get text of select   
// function getText(select) {
//     let text = select.options[select.selectedIndex].text;
//     return text;
// }

// form stepper
var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {

 
            showTab(currentTab);
            
});

            function showTab(n) {
              var x = document.getElementsByClassName("tab");
              x[n].style.display = "block";
              if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
              } else {
                document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
                document.querySelector(".parent_submit").classList.remove('d-none');
                document.getElementById("nextBtn").style.display = "none";

              } else {
                document.getElementById("nextBtn").innerHTML = "Next";
              }
              fixStepIndicator(n)
            }

            function nextPrev(n) {
              var x = document.getElementsByClassName("tab");
              if (n == 1 && !validateForm()) return false;
              x[currentTab].style.display = "none";
              currentTab = currentTab + n;
              if (currentTab >= x.length) {
                // document.getElementById("regForm").submit();
                // return false;
                //alert("sdf");
                 document.getElementById("nextprevious").style.display = "none";
                document.getElementById("all-steps").style.display = "none";
                document.getElementById("register").style.display = "none";
                 document.getElementById("text-message").style.display = "block";



                
              }
              showTab(currentTab);
            }

            function validateForm() {
              var x, y, i, valid = true;
              x = document.getElementsByClassName("tab");
              y = x[currentTab].getElementsByTagName("input");
              for (i = 0; i < y.length; i++) {
                if (y[i].value == "") {
                  y[i].className += " invalid";
                  valid = false;
                }
              }
              if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
              }
              return valid;
            }
            function fixStepIndicator(n) {
              var i, x = document.getElementsByClassName("step");
              for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
              }
              x[n].className += " active";
            }
            // end form stepper