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
                <ul>
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
        hamburger = document.getElementById('hamburger');
        hamburger.onclick = function() {
            navBar.classList.add('active');
            document.body.style.backgroundColor = 'rgba(0,0,0,0.4)';
        }
        function closeNav() {
            navBar.classList.remove('active');
            document.body.style.backgroundColor = '#fefefe';
        }
        let navbarlinks = document.querySelectorAll('li');
        navbarlinks.onclick = function() {
            alert("hi");
        }
//   function navbarlinksActive() {
//     navbarlinks.forEach(navbarlink => {

//       if (!navbarlink.hash) return;

//       let section = document.querySelector(navbarlink.hash);
//       if (!section) return;

//       let position = window.scrollY + 200;

//       if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
//         navbarlink.classList.add('active');
//       } else {
//         navbarlink.classList.remove('active');
//       }
//     })
//   }
    </script>
</body>

</html>