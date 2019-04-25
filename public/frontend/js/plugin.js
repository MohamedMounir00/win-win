$(document).ready(function () {

    'use strict';

    $("#profileImage").click(function (e) {
        $("#imageUpload").click();
    });

    // Add Active Class When Click ...
    $('.content').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    
    // Nice Scroll 



    // Page Loading 
    $.fakeLoader({
        spinner : 'spinner3',
        bgColor : '#3787E0'
    });
    


    
    
});
