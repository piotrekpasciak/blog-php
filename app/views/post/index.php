<div class="container-fluid">

    <div class="col-lg-12">
        <h1 class="page-header">
            Post/index
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/admin/index">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i>Post/index
            </li>
        </ol>
    </div>

    <div class="col-lg-12">
        <h2>Posts Table</h2>

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
                <?php if (isset($data["posts"])): ?>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Text</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Show</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($data["posts"] as $post): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $post[1] ?></td>
                            <td><?= $post[2] ?></td>
                            <td class="text-center"><img class="Admin-post-image" src="/images/upload/<?= $post[3] ?>" alt="Post image"></td>
                            <td><?= $post[4] ?></td>
                            <td><?= $post[5] ?></td>
                            <td><?= $post[6] ?></td>
                            <td class="text-center"><a href="/post/show/<?= $post[0] ?>" class="btn btn-primary">Show</a></td>
                            <td class="text-center"><a href="/post/edit/<?= $post[0] ?>" class="btn btn-success">Edit</a></td>
                            <td class="text-center">
                                <form class="Delete-form" action='delete/<?= $post[0] ?>' method="post">
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