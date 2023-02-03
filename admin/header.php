<div class="header">
    <header>
        <div class="logo">Go Score</div>
        <div id="hamburger" class="hamburger"></div>
        <nav id="nav-bar" class="nav-bar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul id="nav-link" class="nav-link">
                <li><a href="#">Home</a></li>
                <li class="dropdown"><a href="#"><span>Create</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="#">Tournament</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Player</a></li>
                </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Manage</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="#">Tournament</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Player</a></li>
                </ul>
                </li>
                <li><a href="#">Fixtures</a></li>
                <li><a href="#">Result</a></li>
                <li><a href="#">Report</a></li>
                <li><a href="#">News</a></li>
                <li class="dropdown"><a href="#"><span>admin</span><i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="#">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
                </li>
            </ul>
        </nav>
    </header>
    <script>
        const navDropdowns = document.querySelectorAll('.nav-bar .dropdown > a');
        navDropdowns.forEach(el => {
            el.addEventListener('click', function(event) {
                if (document.querySelector('.nav-bar.active')) {
                    event.preventDefault();
                    this.nextElementSibling.classList.add('dropdown-active');
                }
            })
        });
    </script>
</div>