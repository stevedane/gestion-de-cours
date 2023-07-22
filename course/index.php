<?php

include_once('../layouts/main/header.php');
include_once('../includes/connexion.php');

$userId = $_SESSION['userId'];


$courseQuery = $bdd->query("SELECT cours.ID_CO,cours.NOM,cours.DESCRIPTION,enseignants.NOM as NOM_EN,enseignants.PRENOM,cours.CREATE_AT,cours.UPDATE_AT FROM cours INNER JOIN enseignants ON cours.ID_EN = enseignants.ID_EN
WHERE cours.ID_EN='$userId'");
$allCourses = $courseQuery->fetchAll();



?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Courses</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of courses</h6>
        <a href="./create.php" class="btn btn-success mt-2">
            Create
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Teacher</th>
                        <th>Create at</th>
                        <th>Update at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($allCourses && is_array($allCourses)){
                        $i=1;
                            foreach($allCourses as $index => $course){
                     ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $course['NOM'] ?></td>
                        <td><?= $course['DESCRIPTION'] ?></td>
                        <td><?= $course['PRENOM'] .' '.$course['NOM_EN'] ?></td>
                        <td><?= $course['CREATE_AT'] ?></td>
                        <td><?= $course['UPDATE_AT'] ?></td>
                        <td class="text-center">
                            <a href="" class="mr-2">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="./edit.php?id=<?= $course['ID_CO'] ?>" class="mr-2">
                                <i class="fa fa-edit text-secondary"></i>
                            </a>
                            <a href="../includes/service.php?action=delete_course&id=<?= $course['ID_CO'] ?>">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; } } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
include_once('../layouts/main/footer.php');