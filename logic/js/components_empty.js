class Component { 
    static Empty(text){
        return `
        <div class="col-12 ">
        <center><br><br><br><i class='mdi mdi-alert-circle display-3' style='color: #d3d3d3; font-size: 100px'></i><br><br><span class='font-18' style='color: #d3d3d3;'>${text}</span><br></center>
        </div>
        `;
    }
}