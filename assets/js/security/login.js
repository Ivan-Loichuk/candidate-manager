import '../../sass/security/login.scss';

import $ from 'jquery';

$(document).ready(function() {
    /*[ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        })
    })
});