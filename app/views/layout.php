<nav class="Navbar navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Blog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($data['user'])): ?>
                    <li><a href="/user/logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="/user/login">Login</a></li>
                    <li><a href="/user/register">Register</a></li>
                <?php endif ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<section class="Content container">
    <?php
    require_once '../app/views/' . $view . '.php';
    ?>
</section>

<footer class="Footer">
    <div class="container">
        <p class="text-muted">Created by Piotr Paściak.</p>
    </div>
</footer>
