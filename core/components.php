<?php

  
        function mdi_messaje($class, $msj){
            echo "<div class='col-12'><center><br><br><br><i class='mdi ".$class." display-3' style='color: #d3d3d3; font-size: 100px'></i><br><br><span class='font-18' style='color: #d3d3d3;'> ". $msj. " </span><br></center></div>";
        }   
        function mdi_return($class, $msj){
            return "<div class='col-12'><center><br><br><br><i class='mdi ".$class." display-3' style='color: #d3d3d3; font-size: 100px'></i><br><br><span class='font-18' style='color: #d3d3d3;'> ". $msj. " </span><br></center></div>";
        }
    