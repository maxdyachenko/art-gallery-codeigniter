<nav class="main-menu navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/main">Art Gallery</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link <?php if ($current_item == 'Home') echo 'active'; ?>" href="/main">Gallery list</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/edit-profile">Edit profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/exit">Exit</a>
            </li>
            <li class="nav-item">
                <div class="user-block">
                    <img src="<?php echo $common_app_data->avatar; ?>" alt="Your avatar" class="user-avatar">
                    <p class="caption">Hello, <?php echo $common_app_data->name; ?></p>
                </div>
            </li>
        </ul>
    </div>
</nav>