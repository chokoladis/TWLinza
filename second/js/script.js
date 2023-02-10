function ShowFiles(){
    $.ajax({
        url:'/second/include/ShowFiles_ajax.php',
        method: 'GET',
        // dataType: 'json',
        success: function(response){
            $('#files').empty();
            $('#files').append(response);
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

$(document).ready(
    function(){

        ShowFiles();

        $('form').submit(function(e){
            e.preventDefault();

            var formData = new FormData();
            formData.append('file', $('#file')[0].files[0]);
            
            $.ajax({
                type: "POST",
                url: '/second/include/UploadFile_ajax.php',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                // dataType : 'json',
                success: function(msg){
                    if (msg.error != ''){
                        UIkit.notification({
                            message: msg.error,
                            status: 'warning',
                            pos: 'bottom-left',
                            timeout: 5000
                        });
                    } else{
                        UIkit.notification({
                            message: msg.success,
                            status: 'success',
                            pos: 'bottom-left',
                            timeout: 5000
                        });
                    }
                    console.log(msg);
                    ShowFiles();
                },
                error: function (error) {
                    console.log(error);
                }
            });
            
        });

        $(document).on('click', '.remove', function(){

            $.ajax({
                type: "POST",
                url: '/second/include/DeleteFile_ajax.php',
                data: { 'file': $(this).attr('data-remove') },
                success: function(msg){

                    UIkit.notification({
                        message: msg,
                        status: 'success',
                        pos: 'bottom-left',
                        timeout: 5000
                    });

                    ShowFiles();

                    console.log(msg);
                   
                },
                error: function (error) {
                    console.log(error);
                }
            });

        });

        // $(document).on('click', '.file', function(){
                
        //     let fileName = $(this).attr('data-read');
            
        //     $.ajax({
        //         type: "POST",
        //         url: '/second/include/ReadFile_ajax.php',
        //         data: { 'file': fileName},
        //         success: function(msg){

        //             $('body').append(msg);
        //             console.log(msg);               
                   
        //         },
        //         error: function (error) {
        //             console.log(error);
        //         }
        //     });
        // });
           
    }
);