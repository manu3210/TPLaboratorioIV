<?php 

    use Models\User;

    $user = $_SESSION["user"];

?>
<main class="d-flex align-items-center height-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-16">
                <div class="card" style="width: 40rem;">
                    <img src="https://i.pinimg.com/originals/d9/7b/bb/d97bbb08017ac2309307f0822e63d082.jpg" class="card-img-top w-25 rounded mx-auto d-block" alt="avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->getFirstName() ?></h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>