<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script>
        function getCrimeData(){
        alert("Requesting");
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    alert(position.coords.latitude+" "+position.coords.longitude);
                    $.ajax({
                        type: "POST",
                        url: "getCrimeData.php",
                        data: {
                            x: position.coords.latitude,
                            y: position.coords.longitude
                    },
                    success: function (data) {
            
                        var c = $.parseJSON(data);
                        alert(data);
                        var pointslat = new Array();
                        var pointlng = new Array();
                        
                        /*for(i =0; i<c.length; i++){
                            pointslat[i] = c[i].location.latitude;
                            pointlng[i] = c[i].location.longitude;
                        }*/
                        //$("#listarea").html(data);
                     }
                    });
                });
            }
        alert("done") ; 
        }  
        </script>
    </head>
    <body><button onclick="getCrimeData();">Button</button></body>
</html>