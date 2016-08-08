<div class="container-fluid">

    <div class="col-lg-12">
        <h1 class="page-header">
            Category/index
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/admin/index">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Category/index
            </li>
        </ol>
    </div>

    <div class="col-lg-6">
        <h2>Categories Table</h2>

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

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <?php if (isset($data["categories"])): ?>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($data["categories"] as $category): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $category[1] ?></td>
                            <td class="text-center"><a href="/category/edit/<?= $category[0] ?>" class="btn btn-success">Edit</a></td>
                            <td class="text-center">
                                <form class="Delete-form" action='delete/<?= $category[0] ?>' method="post">
                                    <input class="btn btn-danger" type="submit" name="submit" value="Delete">
                                </form
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                <?php endif ?>
            </table>
        </div>
    </div>
</div>