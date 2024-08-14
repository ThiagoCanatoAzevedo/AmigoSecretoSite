var cont = 0;
var nomeArray = []
var presenteArray = []
var familiaArray = []
var emailArray = []

function cadPessoa(){

  var tb = document.getElementById("tbPessoas");
  var qtdLinhas = tb.rows.length;
  var linha = tb.insertRow(qtdLinhas);

  var celNome = linha.insertCell(0)
  var celEmail = linha.insertCell(1)
  var celPresente = linha.insertCell(2)
  var celFamilia = linha.insertCell(3)
  var celRemover = linha.insertCell(4)

  var inputRemover = document.createElement("input");
  inputRemover.value = "Remover";
  inputRemover.id="removerBotaoTh"
  inputRemover.type = "button";
  inputRemover.onclick = SomeDeleteRowFunction
  celRemover.appendChild(inputRemover);

  var inputNome = document.createElement("input");
  inputNome.id = "nome"+cont
  celNome.appendChild(inputNome);

  var inputEmail = document.createElement("input");
  inputEmail.id = "email"+cont
  celEmail.appendChild(inputEmail);

  var inputPresente = document.createElement("input");
  inputPresente.id = "presente"+cont
  celPresente.appendChild(inputPresente);  

  var inputFamilia = document.createElement("input");
  inputFamilia.id = "familia"+cont
  celFamilia.appendChild(inputFamilia);

  cont++;

  // celFamilia.innerHTML = familia[0].toUpperCase() + familia.substr(1);

  document.getElementById("nomeInput").value = ""
  document.getElementById("emailInput").value = ""
  document.getElementById("presenteInput").value = ""
  document.getElementById("familiaInput").value = ""
}

function SomeDeleteRowFunction() {
  // event.target will be the input element.
  var td = event.target.parentNode; 
  var tr = td.parentNode; // the row to be removed
  tr.parentNode.removeChild(tr);

  cont = cont-1

}
$(document).ready(function() {
  $("#salvaValoresBD").click(function(){
    
    
    for (var i = 0; i < cont; i++){
          var nomeValores = document.getElementById("nome"+i).value;
          var emailValores = document.getElementById("email"+i).value;
          var presenteValores = document.getElementById("presente"+i).value;
          var familiaValores =document.getElementById("familia"+i).value;
        
          familiaValores = familiaValores[0].toUpperCase() + familiaValores.substr(1);
      
          nomeArray.push(nomeValores);
          emailArray.push(emailValores);
          presenteArray.push(presenteValores);
          familiaArray.push(familiaValores);
          
          var nomesSemRepetidos = [...new Set(nomeArray)];
          var emailSemRepetidos = [...new Set(emailArray)]
          // var presenteSemRepetidos = [...new Set(presenteArray)]
          // var familiaSemRepetidos = [...new Set(familiaArray)]

          $.ajax({
            url: "../03_PáginaPrincipal/inserir.php",
            method: 'POST',
            data: {familia: familiaArray[i], nome: nomesSemRepetidos[i], email: emailSemRepetidos[i], presente: presenteArray[i]},
            dataType: 'json',
          })


    }

    window.location.reload(true);

  })


})
$(document).ready(function() {
  $("#salvarGrupos").click(function(){
    var nomeGrupos = document.getElementById("nomeGrupo").value

    if  (nomeGrupos == ' '){
      window.location.reload();

    }

    else{
      $.ajax({
        url: "../03_PáginaPrincipal/inserir.php",
        method: 'POST',
        data: {grupo: nomeGrupos},
        dataType: 'json',
      })

      window.location.reload();

    }
    window.location.reload();

      
  })
  // window.location.reload();


})

$(document).ready(function() {
  $("#horaJogo").click(function(){
    window.location.href = "../04_PáginaFim/paginaFim.php";
  })

})

window.addEventListener('scroll', onScroll)
