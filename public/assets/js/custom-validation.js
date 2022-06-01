"use strict"
$(document).ready(function (){
    $('#mobile').on('blur',function (){
        var number = $(this).val();
        if (!(number.startsWith('5') || number.startsWith('6') || number.startsWith('9'))) {
            $('#mobile-error').show().text('mobile should starts with 5 or 6 or 9');
            $('#submit').attr('disabled','disabled');
        }
        else if(number.length != 8){
            $('#mobile-error').show().text('mobile length should be 8 digits');
            $('#submit').attr('disabled','disabled');
        }
        else {
            $('#mobile-error').hide().text('');
            $('#submit').attr('disabled',false);
        }
    });

    $('#c_mobile').on('blur',function (){
        var number = $(this).val();
        if (!(number.startsWith('5') || number.startsWith('6') || number.startsWith('9'))) {
            $('#c_mobile-error').show().text('mobile should starts with 5 or 6 or 9');
            $('#submit').attr('disabled','disabled');
        }
        else if(number.length != 8){
            $('#c_mobile-error').show().text('mobile length should be 8 digits');
            $('#submit').attr('disabled','disabled');
        }
        else {
            $('#c_mobile-error').hide().text('');
            $('#submit').attr('disabled',false);
        }
    });

    $('#phone').on('blur',function (){
        var number = $(this).val();
        if (!(number.startsWith('5') || number.startsWith('6') || number.startsWith('9'))) {
            $('#phone-error').show().text('phone should starts with 5 or 6 or 9');
            $('#submit').attr('disabled','disabled');
        }
        else if(number.length != 8){
            $('#phone-error').show().text('phone length should be 8 digits');
            $('#submit').attr('disabled','disabled');
        }
        else {
            $('#phone-error').hide().text('');
            $('#submit').attr('disabled',false);
        }
    });

    $('#civil_id').on('blur',function (){
        var number = $(this).val();
        if(number.length !== 12 || ! /^-?\d+$/.test(number)){
            $('#civil-id-error').show().text('civil id length should be 12 digit and be a number');
            $('#submit').attr('disabled','disabled');
        }
        else {
            $('#civil-id-error').hide().text('');
            $('#submit').attr('disabled',false);
        }
    });

    $('#fees').on('blur',function (){
        var number = $(this).val();
        if(! /^[+-]?(\d+\.?\d*|\.\d+)$/.test(number)){
            $('#fees-error').show().text('fees should be a number');
            $('#submit').attr('disabled','disabled');
        }
        else {
            $('#fees-error').hide().text('');
            $('#submit').attr('disabled',false);
        }
    });

    $('#commission').on('blur',function (){
        var number = $(this).val();
        if(! /^[+-]?(\d+\.?\d*|\.\d+)$/.test(number)){
            $('#commission-error').show().text('commission should be a number');
            $('#submit').attr('disabled','disabled');
        }
        else {
            $('#commission-error').hide().text('');
            $('#submit').attr('disabled',false);
        }
    });


    $('#sallary').on('blur',function (){
        var number = $(this).val();
        if(! /^[+-]?(\d+\.?\d*|\.\d+)$/.test(number)){
            $('#salary-error').show().text('salary should be a number');
            $('#submit').attr('disabled','disabled');
        }
        else {
            $('#salary-error').hide().text('');
            $('#submit').attr('disabled',false);
        }
    });

});
