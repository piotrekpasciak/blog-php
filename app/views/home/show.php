<div class="row">
    <div class="Category col-md-4 pull-right">
        <div class="Category-wrapper">
            <h4>Kategoria</h4>
            <a href="/home/index/1/<?= "News" ?>" class="Category-wrapper-link"><?= "News" ?></a>
        </div>
    </div>
    <div class="col-lg-8">

            <h1><?= $data["post"]["TITLE"] ?></h1>
            <p>
                <a href="#"><?= $data["post"]["USERNAME"] ?></a>
            </p>
            <p>Zamieszczone <?= $data["post"]["CREATED_AT"] ?></p>
            <img class="img-responsive Home-image" src="/images/upload/<?= $data["post"]["IMAGE"] ?>" alt="">
            <hr>

            <p><?= $data["post"]["TEXT"] ?></p>
            <hr>
    </div>
    <div class="col-lg-6">
        <form action="/comment/create/<?= $data["post"]["ID"] ?>" method="post">
            <?php if (!empty($data["error"]) ): ?>
                <div class="alert alert-danger">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <li>
                        <?= $data["error"] ?>
                    </li>
                </div>
            <?php endif ?>

            <?php if (!empty($data["success"]) ): ?>
                <div class="alert alert-success">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <li>
                        <?= $data["success"] ?>
                    </li>
                </div>
            <?php endif ?>

            <div class="form-group field">
                <label for="post_text">Comment:</label>
                <textarea id="post_text" class="form-control Admin-textarea" name="text"></textarea>
            </div>

            <div class="actions">
                <input id="login_submit" class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>

        <?php if (isset($data["comments"])): ?>
            <?php foreach ($data["comments"] as $comment): ?>
                <div class="Comment">
                    <p>
                        <?php if(!empty($comment[3])): ?>
                            <span class="Comment-username"><?= $comment[3] ?></span>
                        <?php else: ?>
                            <span class="Comment-username Comment-username--anonymous">Anonymous</span>
                        <?php endif ?>

                        <span class="pull-right"><?= $comment[1] ?></span>
                    </p>
                    <p class="Comment-text"><?= $comment[0] ?></p>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>