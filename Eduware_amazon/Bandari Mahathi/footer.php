<html>
<body>
<!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    
      <script>
$(document).ready(function() {
    $('.trigger').click(function(){
var obj =$(this).parent().find('ul');
      if(obj.hasClass("in")){
        obj.removeClass('in');
      }else{
        obj.addClass("in");
      }
    });

});   
 </script>     
   
</body>
</html>