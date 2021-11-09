for (var i = 0; i < document.links.length; i++) {
    if (document.links[i].href == document.URL) {
    document.links[i].parentElement.classList.add('active');
    }
}

function calculated(cep, vendor_single_cep, weight, height, width, length){
    var cep = $('input[name="cep"]').val();
    var vendor_single_cep = $('input[name="vendor_single_cep"]').val();
    var weight = $('input[name="weight"]').val();
    var height = $('input[name="height"]').val();
    var width = $('input[name="width"]').val();
    var length = $('input[name="length"]').val();    


    $.ajax({
        method:'post',
        url:'./js/ajax.php',
        data:{cep:cep, vendor_single_cep:vendor_single_cep, weight:weight, height:height, width:width, length:length},
        success:function(data){
            $('#result').html('<p>'+data+'</p>');
        }
    });
    return false;
}

    document.getElementById('review').addEventListener('click', (e)=>{
        document.querySelector('.reviews-text').style.display = "block";
    });