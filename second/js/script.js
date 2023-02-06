$(document).ready(
    function(){

        $('form').submit(function(e){
            e.preventDefault();

            if (window.FormData === undefined) {
                alert('В вашем браузере FormData не поддерживается');
            } else {
                var formData = new FormData();
                formData.append('file', [$('#file')[0].files[0]]);
                
                for (var key of formData.entries()) {
                    console.log(key[0] + ', ' + key[1]);
                }
                
                $.ajax({
                    type: "POST",
                    url: '/second/include/LoadFile_ajax.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType : 'json',
                    success: function(msg){
                        console.log(msg);
                        // if (msg.error == '') {
                        //     $("#js-file").hide();
                        //     $('#result').html(msg.success);
                        // } else {
                        //     $('#result').html(msg.error);
                        // }
                    },
                    error: function (jqXHR, exception) {
                            if (jqXHR.status === 0) {
                                alert('Not connect. Verify Network.');
                            } else if (jqXHR.status == 404) {
                                alert('Requested page not found (404).');
                            } else if (jqXHR.status == 500) {
                                alert('Internal Server Error (500).');
                            } else if (exception === 'parsererror') {
                                alert('Requested JSON parse failed.');
                            } else if (exception === 'timeout') {
                                alert('Time out error.');
                            } else if (exception === 'abort') {
                                alert('Ajax request aborted.');
                            } else {
                                alert('Uncaught Error. ' + jqXHR.responseText);
                            }
                    }
                });
            }
            // $.ajax({
            //     url:'/first/ajax.php',
            //     data: data,
            //     method: 'POST',
            //     success: function(response){
            //         console.log(response);
            //     },
            //     error: function (jqXHR, exception) {
            //         if (jqXHR.status === 0) {
            //             alert('Not connect. Verify Network.');
            //         } else if (jqXHR.status == 404) {
            //             alert('Requested page not found (404).');
            //         } else if (jqXHR.status == 500) {
            //             alert('Internal Server Error (500).');
            //         } else if (exception === 'parsererror') {
            //             alert('Requested JSON parse failed.');
            //         } else if (exception === 'timeout') {
            //             alert('Time out error.');
            //         } else if (exception === 'abort') {
            //             alert('Ajax request aborted.');
            //         } else {
            //             alert('Uncaught Error. ' + jqXHR.responseText);
            //         }
            //     }
            // });

            
        });
    }
);