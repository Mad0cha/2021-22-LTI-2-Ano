
function envia_mensagem(envia_msg, recebe_msg){

    if (envia_msg !== "" && recebe_msg !== ""){
        let data = new Date();
        let formData = new FormData();

        let emissor = envia_msg;
        let recetor = recebe_msg;

        let msg = $('#msg').val();

        let hora = data.getFullYear() + ":" + data.getMonth() + ":"+ data.getDate()+ ":" + data.getHours() + ":" + data.getMinutes();
    
        // let resposta = "";
        // let array_msg = [];
        // console.log(envia, recebe, msg, hora);

        formData.append("emissor" , emissor);
        formData.append("recetor" , recetor);
        formData.append("msg" , msg);
        formData.append("data" , hora);


        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                // resposta = this.responseText;
                // array_msg = resposta.split("/");

                // le_mensagens(envia,recebe);
                // document.getElementById("mensagens_emissor").innerHTML = this.responseText;


                // document.getElementById("mensagens_emissor").innerHTML = "";

                // for (let a of array_msg){
                //     str = "<div><p id = msg_enviada>" + a.split('-')[0]  +  "</p> <p id = hora_enviada>" + a.split('-')[1]  +  "</p> </div>"
                //     document.getElementById("mensagens_emissor").innerHTML += str;
                // }

            }

        }
        xhttp.open("POST", "poe_msg.php", true);
        xhttp.send(formData);

        // console.log(resposta);
        // console.log(array_msg);
        $("#msg").val('');

    
    }

}



function le_mensagens(envia_msg, recebe_msg){
    if (envia_msg !== "" && recebe_msg !== ""){
        console.log(envia_msg, recebe_msg);
        // console.log("READING");
        // console.log(array_mensagens);   
        // document.getElementById("mensagens_emissor").innerHTML = "";

        // for (let i = 0; i < array_mensagens.length - 1; i++){
        //     str = "<div><p id = msg_enviada>" + array_mensagens[i].split('-')[0]  +  "</p> <p id = hora_enviada>" + array_mensagens[i].split('-')[1]  +  "</p> </div>"
        //     document.getElementById("mensagens_emissor").innerHTML += str;
        // }
        let formData = new FormData();
        let array_msg_nao_filtrada = [];
        let array_msg = [];

        formData.append("emissor" , envia_msg);
        formData.append("recetor" , recebe_msg);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                // resposta = this.responseText;

                resposta = this.responseText;
                array_msg_nao_filtrada = resposta.split("~");
                array_msg = array_msg_nao_filtrada.filter(function (el) {
                    return el != "";
                });
                console.log(array_msg);

                if (array_msg.length > 1){
                    array_msg.sort((a,b) => comparaDatas(a,b));
                }
                console.log(array_msg);

                document.getElementById("caixa_msgs").innerHTML = " ";


                for (let i = 0; i < array_msg.length; i++){
                    let data = array_msg[i].split('-')[2].split(":");
                    data[1]++;
                    let dia = data.slice(0,3).reverse().join("/");
                    let hora = data.slice(3).join(":") 

                    if (array_msg[i].split('-')[0] == "enviou"){
                        str = '<div class="outgoing_msg"><div class="sent_msg"><p>' + array_msg[i].split('-')[1] + '</p> <span class="time_date">' + hora + " " + dia  + '</span> </div> </div>';
                    }else if(array_msg[i].split('-')[0] == "recebeu"){
                        str = '<div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>' + array_msg[i].split('-')[1] + '</p><span class="time_date">' + hora + " " + dia  + '</span></div></div></div>';
                    
                    }
                    

                    document.getElementById("caixa_msgs").innerHTML += str;

                }

            }
        }
        xhttp.open("POST", "le_msg.php", true);
        xhttp.send(formData);

    }
    
}

// Função que retorna qual é a mais recente
function comparaDatas(data1, data2){

    let array_data1 = data1.split('-')[2].split(":");
    let array_data2 = data2.split('-')[2].split(":");

    let d1 = new Date (array_data1[0],array_data1[1],array_data1[2],array_data1[3],array_data1[4]);
    let d2 = new Date (array_data2[0],array_data2[1],array_data2[2],array_data2[3],array_data2[4]);

    if (d1 < d2){
        return -1;
    }else if (d1 > d2){
        return 1;
    }else{
        return 0;
    }
}

    

