/**
 * Script for changing the displayed fields of the registration form.
 */

/*
 * The function shows or removes the text fields
 * only for registration of the teacher account type.
 */
function showExtendedRegistration() {
    if (document.getElementById("teacher").checked) {
        // Teacher.
        document.getElementById('degree-front-field').style.display = "flex";
        document.getElementById('degree-after-field').style.display = "flex";
        document.getElementById('school-field').style.display = "flex";
    } else {
        // Student.
        document.getElementById('degree-front-field').style.display = "none";
        document.getElementById('degree-after-field').style.display = "none";
        document.getElementById('school-field').style.display = "none";
    }
}
