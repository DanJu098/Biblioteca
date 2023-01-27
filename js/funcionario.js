
const carerForm = document.getElementById('carerForm')
console.log('carerForm', carerForm)

carerForm.addEventListener('submit', function(e) {
  alert()
  e.preventDefault();

  var action = this.attr('action')
  console.log('action', action)

  
  $.ajax({
  url: "https://fiddle.jshell.net/favicon.png",
  data: {
      name: formElements['name'].value,
      surname:  formElementsT ['surname'].value,
      mail:  formElementsT ['mail'].value,
      phone:  formElements ['phone'].value,
      vacancy:  formElements ['vacancy'].value,
      file:  formElements ['file'].value,
    },
  success: function(response) {
    console.log(response)
  }
})
  
})

function pg_crudfun() {
    window.location.href = "crudfun.php";
}
function pg_crudclie() {
    window.location.href = "crudclie.php";
}
function pg_crudliv() {
    window.location.href = "crudliv.php";
}
function pg_crudest() {
    window.location.href = "crudest.php";
}
function pg_crudco() {
  window.location.href = "crudco.php";
}