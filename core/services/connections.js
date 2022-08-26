
    function VerifyConnection() {
       return $.ajax({
           type: "GET",
           url: URL,
           cache: false,
           async: !1,
           dataType: "html",
       });
    }
