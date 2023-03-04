<div class="header">
    <header>
        <div class="logo">Go Score</div>
        <div id="hamburger" class="hamburger"></div>
        <nav id="nav-bar" class="nav-bar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul id="nav-link" class="nav-link">
                <li><a href="index.php">Home</a></li>
                <li class="dropdown"><a href="#" id="dropdown-link"><span>Create</span><i id="dropdown-link" class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="addtournament.php">Tournament</a></li>
                    <li><a href="addteam.php">Team</a></li>
                    <li><a href="addplayer.php">Player</a></li>
                </ul>
                </li>
                <li class="dropdown"><a href="#" id="dropdown-link"><span>Manage</span><i id="dropdown-link" class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="managetournament.php">Tournament</a></li>
                    <li><a href="manageteam.php">Team</a></li>
                    <li><a href="#">Player</a></li>
                </ul>
                </li>
                <li><a href="#">Fixtures</a></li>
                <li><a href="#">Result</a></li>
                <li><a href="#">News</a></li>
                <li class="dropdown"><a href="#" id="dropdown-link"><span><?php echo $_SESSION['username']; ?></span><i id="dropdown-link" class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="#">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
                </li>
            </ul>
        </nav>
    </header>
</div>