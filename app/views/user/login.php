<div class="container">
    <div class="Login">
        <div class="panel panel-default">

            <div class="panel-heading">
                <p class="Login-heading">Log in</p>
            </div>

            <div class="panel-body" id="session-new">

                <form action="/user/login" method="post">

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
                        <label for="login_username">Username:</label>
                        <input id="login_username" class="form-control" type="text" name="username" required>
                    </div>

                    <div class="form-group field">
                        <label for="login_password">Password:</label>
                        <input id="login_password" class="form-control" type="text" name="password" required>
                    </div>

                    <div class="actions">
                        <input id="login_submit" class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>