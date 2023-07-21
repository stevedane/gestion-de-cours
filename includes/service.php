<?php
include_once('connexion.php');

$action = isset($_POST['action']) ? $_POST['action'] : '';


/** Register */

if($action == 'register'){
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if($status == 'teacher'){
        $registerExist = $bdd->query("SELECT * FROM enseignants WHERE EMAIL='$email'");
        $checkExist = $registerExist->fetch();

        if(!is_array($checkExist)){
            $registerSql = $bdd->prepare('INSERT INTO enseignants (NOM,PRENOM,EMAIL,PASSWORD,CREATE_AT,UPDATE_AT) VALUES(:nom,:prenom,:email,:password,:create_at,:update_at)');

            $checkInsert = $registerSql->execute(array(
                'nom'=> $lastName,
                'prenom'=> $firstName,
                'email'=> $email,
                'password'=> sha1($password),
                'create_at'=> date('Y-m-d'),
                'update_at'=> date('Y-m-d'),
            ));
    
            if($checkInsert){
                header('Location:../login/?notif=success');
            }
            else{
                header('Location:../login/?notif=error');
            }
        }
        else{
            header('Location:../login/?notif=error');
        }        
    }
    elseif($status == 'student'){
        $registerExist = $bdd->query("SELECT * FROM etudiants WHERE EMAIL='$email'");
        $checkExist = $registerExist->fetch();

        if(!is_array($checkExist)){
            $registerSql = $bdd->prepare('INSERT INTO etudiants (NOM,PRENOM,EMAIL,PASSWORD,CREATE_AT,UPDATE_AT) VALUES(:nom,:prenom,:email,:password,:create_at,:update_at)');

            $checkInsert = $registerSql->execute(array(
                'nom'=> $lastName,
                'prenom'=> $firstName,
                'email'=> $email,
                'password'=> sha1($password),
                'create_at'=> date('Y-m-d'),
                'update_at'=> date('Y-m-d'),
            ));

            if($checkInsert){
                header('Location:../login/?notif=success');
            }
            else{
                header('Location:../login/?notif=error');
            }
        }
        else{
            header('Location:../login/?notif=error');
        } 
    }
}
elseif($action == 'login'){
   $email = isset($_POST['email']) ? $_POST['email'] : ''; 
   $password = isset($_POST['password']) ? $_POST['password'] : ''; 

   $teacherExist = $bdd->query("SELECT * FROM enseignants WHERE EMAIL='$email'");
   $teacher = $teacherExist->fetch();

   /** Enseignant */
    if(is_array($teacher)){
        $existPassword = $teacher['PASSWORD'];

        /** Test Password */
        if($existPassword == sha1($password)){
            session_start();

            $_SESSION['userId'] = $teacher['ID_EN'];
            $_SESSION['userFirstName'] = $teacher['PRENOM'];
            $_SESSION['userLastName'] = $teacher['NOM'];

            header('Location:../dashboard');
        }
        else{
            header('Location:../login/?notif=error');
        }
    }
    else{
        $studentExist = $bdd->query("SELECT * FROM enseignants WHERE EMAIL='$email'");
        $student = $studentExist->fetch();
        
        /** Etudiant */
        if(is_array($student)){
            $existPassword = $student['PASSWORD'];

            /** Test Password */
            if($existPassword == sha1($password)){
    
            }
            else{
                header('Location:../login/?notif=error');
            }
        }
    }

}