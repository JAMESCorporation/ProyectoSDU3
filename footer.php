

  
  <!--<footer class="navbar navbar-fixed-bottom" id="footer">
    <p>Copyright © 2016 JAMES todos los derechos reservados | Ingenieria en Sistemas Computacionales | IS-801</p>
  </footer>-->
	<script type="text/javascript" src="includes/bootstrap/dist/js/jquery.js"></script>
	<script type="text/javascript" src="includes/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="includes/jquery-ui/jquery-ui.js"></script>
  <script type="text/javascript" src="includes/script.js"></script>
  <script type="text/javascript" src="includes/slider.js"></script>
  <script type="text/javascript" src="includes/effects.js"></script>
  <script type="text/javascript">
  	
  </script>

  <script>
    function check(res) {
      var check = res;
      document.getElementById("r").value = check;
    }
    function funcion(res) {
      var indice = res;
      document.getElementById("p").value = indice;
    }
     
  </script>
  
  <script>
    var i = 0;
      $("#agregar").click(function(){
        var pregunta = document.getElementById("pregunta").value;
        var res1 = document.getElementById("res1").value;
        var res2 = document.getElementById("res2").value;
        var res3 = document.getElementById("res3").value;
     var id_test = document.getElementById("id_test").value;
        var res = document.getElementsByName("res");
        for(var con=0; con<3; con++){
          if(res[con].checked){
            var correcta = con+1;;
          }
        }
        $.ajax({
        url: 'nueva_pregunta.php',
        type: 'POST',
        data: {'pregunta':pregunta,'res1':res1,'res2':res2,'res3':res3, 'correcta':correcta, 'id_test':id_test },
        }); 

        i = i + 1;

        if(correcta == 1){
          $("#mostrar").append("<h3>"+i+".- "+pregunta+"</h3>");
          $("#mostrar").append("<label class='text-primary'> a) "+res1+"</label><br>");
          $("#mostrar").append("<p> b) "+res2+"</p>");
          $("#mostrar").append("<p> c) "+res3+"</p><legend></legend>");
        }
        if(correcta == 2){
          $("#mostrar").append("<h3>"+i+".- "+pregunta+"</h3>");
          $("#mostrar").append("<p> a) "+res1+"</p>");
          $("#mostrar").append("<label class='text-primary'> b) "+res2+"</label><br>");
          $("#mostrar").append("<p> c) "+res3+"</p><legend></legend>");
        }
        if(correcta == 3){
          $("#mostrar").append("<h3>"+i+".- "+pregunta+"</h3>");
          $("#mostrar").append("<p> a) "+res1+"</p>");
          $("#mostrar").append("<p> b) "+res2+"</p>");
          $("#mostrar").append("<label class='text-primary'> c) "+res3+"</label><legend></legend>");
          }

      });
   
  </script>

	<!--<script type="text/javascript" src="includes/bootstrap/dist/js/jquery.validate.js"></script>-->

</body>
</html>
