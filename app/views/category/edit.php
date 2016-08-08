<div class="container-fluid">
    <div class="col-lg-12">
        <h1 class="page-header">
            Category/edit
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/admin/index">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Category/edit
            </li>
        </ol>
    </div>

    <div class="col-lg-6">
        <form action="/category/edit/<?= $data["category"]["id"] ?>" method="post">
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
                <input id="category_name" class="form-control" type="text" name="name" value="<?= $data["category"]["name"] ?>">
            </div>

            <div class="actions">
                <input id="category_submit" class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>