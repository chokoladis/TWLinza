
function valueIsNull(input){

    let parent = input.parents('.form_control');
    let alert = parent.find('.uk-alert-danger');

    if (input.val() == ''){

        alert.removeClass('uk-hidden');
        let placeholder = input.attr('placeholder');
        input.addClass('uk-form-danger');

        if(placeholder == '+7 (123) 456-78-91'){
            alert.find('p').text('Заполните поле "Телефон"');
        } else {
            alert.find('p').text('Заполните поле "'+placeholder+'"');
        }

        window.errors++;

    } else {
        alert.addClass('uk-hidden');
        input.removeClass('uk-form-danger');
    }

}

function checkOnRegexp(input,regexp){

    let parent = input.parents('.form_control');
    let alert = parent.find('.uk-alert-danger');

    if (! (regexp.test( input.val() )) ){

        alert.removeClass('uk-hidden');
        let placeholder = input.attr('placeholder');
        input.addClass('uk-form-danger');

        alert.find('p').text('Вы заполнили поле не в верном формате');

        window.errors++;

    } else {
        alert.addClass('uk-hidden');
        input.removeClass('uk-form-danger');
    }
}

var errors = 0;

$(document).ready(
    function(){

        

        $("#phone").mask(" +7 (999) 999-99-99");

        $('form').submit(function(e){
            e.preventDefault();

            console.clear();
            errors = 0;

            let name = $('input[name="name"]');
            let sname = $('input[name="sname"]');
            let email = $('input[name="email"]');
            let phone = $('input[name="phone"]');

            valueIsNull(name);
            valueIsNull(sname);
            valueIsNull(email);
            valueIsNull(phone);

            // Проверка телефона по регулярке
            checkOnRegexp(phone,/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,12}(\s*)?$/);

            let data = {
                'name': name.val(),
                'sname': sname.val(),
                'email': email.val(),
                'phone': phone.val(),
            };

            console.log('ошибок');
            console.log(errors);

            if (errors == 0){
                
                console.log(data);
                $.ajax({
                    url:'/first/ajax.php',
                    data: data,
                    method: 'POST',
                    success: function(response){
                        console.log(response);
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
                })

            }

            
            
        });
    }
);