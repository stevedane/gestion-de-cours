<?php

include_once('../layouts/main/header.php');
include_once('../includes/connexion.php');

$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
$id = isset($_GET['id']) ? $_GET['id'] : 0;

$courseQuery = $bdd->query("SELECT * FROM cours WHERE ID_CO='$id'");
$course = $courseQuery->fetch();

$name = ($course) ? $course['NOM'] : '';
$description = ($course) ? $course['DESCRIPTION'] : '';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Update course</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update course <?= $name ?></h6>
        
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <form class="user" method="post" action="../includes/service.php">
                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control form-control-user"
                                                id="name" aria-describedby="emailHelp"
                                                placeholder="Enter course name" required value="<?= $name ?>">
                                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="10" required>
                                                <?= $description ?>
                                            </textarea>
                                        </div>
                    </div>
                    <div class="col-md-12">
                    <input type="hidden" name="action" value="update_course">
                    <input type="hidden" name="course_id" value="<?= $id ?>">
                    <input type="hidden" name="teacher_id" value="<?= $userId ?>">
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                    </div>
                </div>
                                        
                                        
                                        
                                    </form>
            </div>
        </div>
    
    </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
include_once('../layouts/main/footer.php');