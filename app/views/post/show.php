<div class="container-fluid">

    <div class="col-lg-12">
        <h1 class="page-header">
            Post/show
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/admin/index">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i>Post/show
            </li>
        </ol>
    </div>

    <div class="col-lg-8">
        <h1>Title: <?= $data["post"]["TITLE"] ?></h1>
        <p>
            Author: <a href><?= $data["post"]["USERNAME"] ?></a>
        </p>
        <p>Date: <?= $data["post"]["CREATED_AT"] ?></p>
        <span>Image:</span>
        <img class="img-responsive" src="/images/upload/<?= $data["post"]["IMAGE"] ?>" alt="">
        <p>Text: <?= $data["post"]["TEXT"] ?></p>
    </div>
</div>