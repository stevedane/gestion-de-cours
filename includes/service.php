<?php
include_once('connexion.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';


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
                $_SESSION['userId'] = $student['ID_EN'];
                $_SESSION['userFirstName'] = $student['PRENOM'];
                $_SESSION['userLastName'] = $student['NOM'];

                header('Location:../dashboard');
            }
            else{
                header('Location:../login/?notif=error');
            }
        }
    }

}
elseif($action == 'logout'){
    session_unset();

    session_destroy();

    header('Location:../login');
}
elseif($action == 'create_course'){
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : 0;

    if((int)$teacher_id != 0){
        $courseExist = $bdd->query("SELECT * FROM cours WHERE NOM='$name'");
        $checkExist = $courseExist->fetch();

        if(!is_array($checkExist)){
            $registerSql = $bdd->prepare('INSERT INTO cours (NOM,DESCRIPTION,ID_EN,CREATE_AT,UPDATE_AT) VALUES(:nom,:description,:teacher,:create_at,:update_at)');

            $checkInsert = $registerSql->execute(array(
                'nom'=> $name,
                'description'=> $description,
                'teacher'=> $teacher_id,
                'create_at'=> date('Y-m-d'),
                'update_at'=> date('Y-m-d'),
            ));

            if($checkInsert){
                header('Location:../course/');
            }
            else{
                header('Location:../course/create.php');
            }
        }
    }
}
elseif($action == 'update_course'){
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : 0;
    $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : 0;

    if((int)$teacher_id != 0 && (int)$course_id != 0 ){
        $courseExist = $bdd->query("SELECT * FROM cours WHERE ID_CO='$course_id'");
        $checkExist = $courseExist->fetch();

        if(is_array($checkExist)){
            $registerSql = $bdd->prepare('UPDATE cours SET NOM=:nom ,DESCRIPTION=:description,UPDATE_AT=:update_at WHERE ID_CO='.$course_id);

            $checkInsert = $registerSql->execute(array(
                'nom'=> $name,
                'description'=> $description,
                'update_at'=> date('Y-m-d'),
            ));

            if($checkInsert){
                header('Location:../course/');
            }
            else{
                header('Location:../course/edit.php?id='.$course_id);
            }
        }
    }
}
elseif($action == 'delete_course'){
    $course_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

    $courseExist = $bdd->query("SELECT * FROM cours WHERE ID_CO='$course_id'");
    $checkExist = $courseExist->fetch();

        if(is_array($checkExist)){
            $registerSql = $bdd->prepare('DELETE FROM cours WHERE ID_CO=:id');

            $checkInsert = $registerSql->execute(array(
                'id'=> $course_id,
            ));

            header('Location:../course/');
        }
}