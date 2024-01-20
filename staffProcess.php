<?php 
    //Process to insert compound details into database table name 'compound'

    if(isset($_POST['submit'])){

        $paymentPaid = "paid"; 
        $paymentUnpaid = "unpaid";

        $studID = $_POST['studID'];
        $compoundType = $_POST['CompoundType'];
        $amount = $_POST['Amount'];
        

        //insert query 
        $sqlInsert = "INSERT INTO compound (compoundType, compoundAmount, paymentStatus, studentID, policeID) VALUES ('$compoundType', '$amount', '$paymentUnpaid', '$studID', '$policeID')";
        

        $res=mysqli_query($conn,$sqlInsert);
        if ($res==1) {echo 
        '<script>
            
        alert("Insert Successful !");
        window.location.href = "staff.php";
        
        </script>';}
        else {
            echo '<script>
            
            alert("Insert failed !")
            
            </script>';}
        mysqli_close($conn);
    }
?>