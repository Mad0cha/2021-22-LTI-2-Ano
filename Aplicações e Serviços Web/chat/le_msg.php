<?php 
    include "abreconexao.php";

    if($_POST){
        $emissor = $_POST["emissor"];
        $recetor = $_POST["recetor"];

        $str = "";
        $query2 = "SELECT * FROM mensagens WHERE (de = '$emissor' AND para = '$recetor') OR  (de = '$recetor' AND para = '$emissor')";
        $res2 = mysqli_query($conn, $query2);

        while($row = $res2-> fetch_assoc()){

            if ($row["de"] == $emissor){
                $str .= 'enviou-'. $row["msg"] . "-" . $row["hora"] . "~";
            }else if ($row["para"] == $emissor){
                $str .= 'recebeu-'. $row["msg"] . "-" . $row["hora"] . "~";
            }

        }

        echo $str;

        mysqli_close($conn);
    }
?>