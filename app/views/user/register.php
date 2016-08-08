<div class="container">
    <div class="Register Login">
        <div class="panel panel-default">

            <div class="panel-heading">
                <p class="Login-heading">Register</p>
            </div>

            <div class="panel-body" id="user-new">

                <form action="register" method="post">

                    <?php if (!empty($data["error"]) ): ?>
                    <div class="alert alert-danger">
                        <a href="#" data-dismiss="alert" class="close">×</a>
                        <li>
                            <?= $data["error"] ?>
                        </li>
                    </div>
                    <?php endif ?>

                    <div class="form-group field">
                        <label for="register_email">Email:</label>
                        <input id="register_email" class="form-control" type="email" name="email" required>
                    </div>

                    <div class="form-group field">
                        <label for="register_email">Username:</label>
                        <input id="register_email" class="form-control" type="text" name="username" required>
                    </div>

                    <div class="form-group field">
                        <label for="register_password">Password:</label>
                        <input id="register_password" class="form-control" type="password" name="password" required>
                    </div>

                    <div class="form-group field">
                        <label for="repeat_password">Repeat password:</label>
                        <input id="repeat_password" class="form-control" type="password" name="repeat" required>
                    </div>

                    <div class="actions">
                        <input id="register_submit" class="btn btn-primary" type="submit" value="Submit" required>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>