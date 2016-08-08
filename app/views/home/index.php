<div class="row">
    <div class="Category col-md-4 pull-right">
            <div class="Category-wrapper">
                    <h4>Category</h4>
                    <?php if (isset($data["categories"])): ?>
                    <div>
                        <?php foreach ($data["categories"] as $category): ?>
                            <a href="/home/index/1/<?= $category[1] ?>" class="Category-wrapper-link
                            <?= ($data["category"] == $category[1])? "Category-wrapper-link--active" : "" ?>
                            " href="#!"><?= $category[1] ?></a>
                        <?php endforeach ?>
                    </div>
                    <?php endif ?>
            </div>
    </div>

    <div class="col-lg-8">
        <h1 class="Blue-text">
            <?php if(isset($_GET["category"])): ?>
                Category: <?= $_GET["category"]; ?>
            <?php endif ?>
        </h1>
        <?php if (isset($data["posts"])): ?>
            <?php foreach ($data["posts"] as $post): ?>
                <div>
                    <h1><?= $post[1] ?></h1>
                    <p>
                        <a href="#"><?= $post[6] ?></a><span> / <?= $post[5] ?></span>
                    </p>
                    <p>Posted at <?= $post[4] ?></p>
                        <img class="img-responsive Home-image" src="/images/upload/<?= $post[3] ?>" alt="">
                    <hr>

                    <p><?= $post[2] ?></p>
                    <hr>
                    <a href="/home/show/<?= $post[0] ?>" class="Blog-button btn btn-primary pull-right">Show more</a>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>

    <div class="col-lg-8 text-center">
        <ul class="pagination">
            <?php
            for($i = 1 ; $i <= $data["pages"] ; $i++ )
            {
                echo "<li><a href='/home/index/" . $i . "/" . $data["category"] . "'>" . $i . "</a></li>";
            }
            ?>
        </ul>
    </div>
</div>
