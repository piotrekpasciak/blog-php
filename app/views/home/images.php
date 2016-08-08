<div class="row">
    <div class="col-md-12">


            <?php
            if(isset($_GET['image']))
            {
                //include getcwd() . '/images/upload/' . $_GET['image'];
            }


            if(isset($_GET["filename"])) include $_GET['filename'];
            ?>


    </div>





    <?php
        //echo getcwd() . '/images/upload/' . $_GET['image'];
    ?>
</div>