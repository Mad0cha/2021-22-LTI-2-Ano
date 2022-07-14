(function($) {

    $("#cancela").on('click', function(){
        window.location = "index.php";
  });

  $('#register-form').validate({
    rules : {
        first_name : {
            required: true,
        },
        last_name : {
            required: true,
        },
        cartao_cidadao : {
            required: true
        },
        email : {
            required: true,
        },
        carta_conducao : {
            required: true
        },
        birthdayDate : {
            required: true,
        },
        imagem : {
            required: true,
        },
        distrito : {
            required: true,
        },
        concelho : {
            required: true,
        },
        freguesia : {
            required: true,
        },
        telefone : {
            required: true,
        },
        pass : {
            required: true,
        },
        nome_inst : {
            required: true,
        },
        morada : {
            required : true,
        },
        telefone_instituicao : {
            required : true,
        },
        nome_pessoa : {
            required : true,
        },
        telefone_pessoa : { 
            required : true,
        } 
    },
    onfocusout: function(element) {
        $(element).valid();
    },
});

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });
})(jQuery);