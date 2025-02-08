<?php
include 'conection.php'; 

function insertData($first_name,$last_name,$email,$gender,$ip_address,$NHS_Number,$user_name,$password,$therapist,$therapy_number,$session_number,$user_id,$therapist_specialty,$therapy_duration,$session_date,$therapy_notes) {
    global $conn;
    $sql = "INSERT INTO datos_simulados (first_name,last_name,email,gender,ip_address,NHS_Number,user_name,password,therapist,therapy_number,session_number,user_id,therapist_specialty,therapy_duration,session_date,therapy_notes) 
    VALUES ('$first_name', '$last_name' ,'$email' ,'$gender' , '$ip_address' , '$NHS_Number' , '$user_name' , '$password' , '$therapist', '$therapy_number','$session_number', '$user_id', '$therapist_specialty' , '$therapy_duration' , '$session_date' , '$therapy_notes')";

    if ($conn->query($sql) === TRUE) {
        echo "New Register Proper.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


function updateDatafunction($id, $first_name, $last_name, $email, $gender, $ip_address, $NHS_Number, $user_name, $password, $therapist, $therapy_number, $session_number, $user_id, $therapist_specialty, $therapy_duration, $session_date, $therapy_notes) {
    global $conn;
    $sql = "UPDATE datos_simulados 
            SET first_name='$first_name', 
                last_name='$last_name', 
                email='$email', 
                gender='$gender', 
                ip_address='$ip_address', 
                NHS_Number='$NHS_Number', 
                user_name='$user_name', 
                password='$password', 
                therapist='$therapist', 
                therapy_number='$therapy_number', 
                session_number='$session_number', 
                user_id='$user_id', 
                therapist_specialty='$therapist_specialty', 
                therapy_duration='$therapy_duration', 
                session_date='$session_date', 
                therapy_notes='$therapy_notes' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


function deleteData($id) {
    global $conn;
    $sql = "DELETE FROM datos_simulados WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted sucessfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
