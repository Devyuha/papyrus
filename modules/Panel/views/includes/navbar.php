 <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <span class="icon-menu"></span>
            </button>
            <div class="logo">Papyrus</div>
        </div>
        <div class="header-right">
            <div class="user-menu">
                <div class="user-avatar" id="userAvatar">
                    <div class="avatar-img navicon">JD</div>
                    <span class="user-name"><?= auth()->user("name") ?></span>
                </div>
                <div class="dropdown-menu" id="userDropdown">
                    <a href="<?= route("panel.profile") ?>" class="dropdown-item">Profile</a>
                    <a href="<?= route("auth.logout") ?>" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
    </header>
