<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

//Segunda==================
$('.seg1').on('change', function() {
    let val = Number($(this).val());
    $('.seg2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.seg2').on('change', function() {
    let val = Number($(this).val());
    $('.seg1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});
//Terca==================
$('.ter1').on('change', function() {
    let val = Number($(this).val());
    $('.ter2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.ter2').on('change', function() {
    let val = Number($(this).val());
    $('.ter1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});
//Quarta==================
$('.qua1').on('change', function() {
    let val = Number($(this).val());
    $('.qua2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.qua2').on('change', function() {
    let val = Number($(this).val());
    $('.qua1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});
//Quinta==================
$('.qui1').on('change', function() {
    let val = Number($(this).val());
    $('.qui2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.qui2').on('change', function() {
    let val = Number($(this).val());
    $('.qui1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});

//Sexta==================
$('.sex1').on('change', function() {
    let val = Number($(this).val());
    $('.sex2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.sex2').on('change', function() {
    let val = Number($(this).val());
    $('.sex1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});

//Sexta==================
$('.sex1').on('change', function() {
    let val = Number($(this).val());
    $('.sex2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.sex2').on('change', function() {
    let val = Number($(this).val());
    $('.sex1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});

//Sábado==================
$('.sab1').on('change', function() {
    let val = Number($(this).val());
    $('.sab2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.sab2').on('change', function() {
    let val = Number($(this).val());
    $('.sab1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});

//Domingo==================
$('.dom1').on('change', function() {
    let val = Number($(this).val());
    $('.dom2 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) < val)
    })
});

$('.dom2').on('change', function() {
    let val = Number($(this).val());
    $('.dom1 option').each(function() {
        $(this).prop('disabled', Number($(this).val()) > val)
    })
});
