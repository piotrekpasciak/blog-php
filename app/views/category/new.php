<div class="container-fluid">
    <div class="col-lg-12">
        <h1 class="page-header">
            Category/new
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/admin/index">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Category/new
            </li>
        </ol>
    </div>

    <div class="col-lg-6">
        <form action="new" method="post">
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
                <label for="category_name">Name:</label>
                <input id="category_name" class="form-control" type="text" name="name">
            </div>

            <?php if (isset($data["token"])): ?>
                <input type="hidden" name="token" value="<?= $data["token"] ?>">
            <?php endif ?>

            <div class="actions">
                <input id="category_submit" class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>
