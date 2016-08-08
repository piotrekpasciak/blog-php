<div class="container-fluid">
    <div class="col-lg-12">
        <h1 class="page-header">
            Post/new
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/admin/index">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Post/new
            </li>
        </ol>
    </div>

    <div class="col-lg-6">
        <form action="new" method="post" enctype="multipart/form-data">
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
                <label for="post_title">Title:</label>
                <input id="post_title" class="form-control" type="text" name="title">
            </div>

            <div class="form-group field">
                <label for="post_category">Category:</label>
                <select class="form-control" id="post_category" name="category">
                    <?php if (isset($data["categories"])): ?>
                        <?php foreach ($data["categories"] as $category): ?>
                            <option value="<?= $category[0] ?>"> <?= $category[1] ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>

            <div class="form-group field">
                <label for="post_text">Text:</label>
                <textarea id="post_text" class="form-control Admin-textarea" name="text"></textarea>
            </div>

            <div class="form-group field">
                <label for="post_image">Image:</label>
                <input id="post_image" type="file" name="image">
            </div>

            <?php if (isset($data["token"])): ?>
                <input type="hidden" name="token" value="<?= $data["token"] ?>">
            <?php endif ?>

            <div class="actions">
                <input id="login_submit" class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

<form action="new" method="post" enctype="multipart/form-data">

    <?php if (isset($data["token"])): ?>
        <input type="hidden" name="token" value="<?= $data["token"] ?>">
    <?php endif ?>

</form>
