<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style/style.css" />
</head>

<body>
    <div class="header">
        <header>
            <div class="logo">Go Score</div>
            <div id="hamburger" class="hamburger"></div>
            <nav id="nav-bar" class="nav-bar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <ul id="nav-link">
                    <li><a href="#c1">Home</a></li>
                    <hr>
                    <li><a href="#c2">Contact</a></li>
                    <hr>
                    <li><a href="#">About</a></li>
                    <hr>
                    <li><a href="#">Help</a></li>
                    <hr>
                    <li><a href="#">Address</a></li>
                    <hr>
                </ul>
            </nav>
        </header>
    </div>
    <script>
        navBar = document.getElementById('nav-bar');
        document.onclick = function(clickEvent) {
            var clickover = clickEvent.target;
            // if (!document.getElementById('nav-bar').contains(clickover) && clickover.id != "hamburger") {
            if (clickover.id != "hamburger") {
                navBar.classList.remove('active');
                document.body.style.backgroundColor = '#fefefe';
            }
        }
        navbarlink = document.getElementById('nav-link');
            navbaractive = navbarlink.querySelectorAll('#nav-link a');
            for (var i = 0; i < navbaractive.length; i++) {
                navbaractive[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("active");
                    if (current.length > 0) { 
                        current[0].className = current[0].className.replace("active", "");
                    }
                    this.className += "active";
                });
            }
        hamburger = document.getElementById('hamburger');
        hamburger.onclick = function() {
            navBar.classList.add('active');
            document.body.style.backgroundColor = 'rgba(0,0,0,0.4)';
            for (var i = 0; i < navbaractive.length; i++) {
                navbaractive[i].classList.remove('active');
            }
        }
        function closeNav() {
            navBar.classList.remove('active');
            document.body.style.backgroundColor = '#fefefe';
        }
    </script>
</body>

</html>