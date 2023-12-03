<?php  
    require '../functions.php';
    session_start();
    $keyword = $_GET["keyword"];
?>

<div class="container" id="containerPlace">
        <div class="row">
            <?php 
                $query = mysqli_query($conn,"SELECT * FROM tourism WHERE name LIKE '%$keyword%' OR province LIKE '%$keyword%' OR regency LIKE '%$keyword%'");
                while($data = mysqli_fetch_array($query)):
            ?>
            <div class="col-md-2 mx-3 mt-4">
                <div class="card shadow-lg mb-4 d-flex align-items-stretch" style="width: 15rem; height:100%">
                    <img src="img/place/<?= $data['image'] ?>" class="card-img-top" alt="..."
                        style="width:238.4px; height:135.74px;">
                    <div class="card-body d-flex d-flex justify-content-between flex-column">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title"><?= $data['name'] ?></h5>
                                <div class="d-block">
                                    <?php if($data['rating'] != 0): ?>
                                    <i class="bi bi-star-fill" style="color:#ffc107;"></i>
                                    <p><?= number_format($data['rating'], '1',',') ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p class="card-text"
                                style="max-height:72px; overflow: hidden; text-overflow: ellipsis; display:-webkit-box; -webkit-line-clamp:3;-webkit-box-orient:vertical;">
                                <?= $data['description'] ?></p>
                        </div>
                        <div>
                            <div class="gap-3" style="color: grey;  font-size:12px;"><i
                                    class="bi bi-geo-alt-fill"><?= $data['province'].",".$data['regency'] ?></i></div>
                            <?php if(isset($_SESSION['username'])): ?>
                                <?php if($_SESSION['username'] == 'admin'): ?>
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="edit.php?place=<?=$data['name']?>" class="btn btn-success"
                                            style=" color:white;"><i class="bi bi-pencil-square"></i></a>
                                        <a href="view.php?place=<?=$data['name']?>&?#info" class="btn"
                                            style="background-color: #019bda; color:white; width: 100px;">Visit</a>
                                        <a href="view.php?place=<?=$data['name']?>" class="btn btn-danger"
                                            style=" color:white;"><i class="bi bi-trash3-fill"></i></a>
                                    </div>
                                <?php else:  ?>
                                    <div class="d-flex justify-content-center mt-3">
                                        <a href="view.php?place=<?=$data['name']?>&?#info" class="btn" style="background-color: #019bda; color:white; width: 100px;">Visit</a>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="view.php?place=<?=$data['name']?>&?#info" class="btn" style="background-color: #019bda; color:white; width: 100px;">Visit</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>