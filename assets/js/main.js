navBar = document.getElementById('nav-bar')
document.onclick = function (clickEvent) {
  var clickover = clickEvent.target
  // if (!document.getElementById('nav-bar').contains(clickover) && clickover.id != "hamburger") {
  if (clickover.id != 'hamburger') {
    navBar.classList.remove('active')
    document.body.style.backgroundColor = '#fefefe'
  }
}
navbarlink = document.getElementById('nav-link')
navbaractive = navbarlink.querySelectorAll('#nav-link a')
for (var i = 0; i < navbaractive.length; i++) {
  navbaractive[i].addEventListener('click', function () {
    var current = document.getElementsByClassName('active')
    if (current.length > 0) {
      current[0].className = current[0].className.replace('active', '')
    }
    this.className += 'active'
  })
}
hamburger = document.getElementById('hamburger')
hamburger.onclick = function () {
  navBar.classList.add('active')
  document.body.style.backgroundColor = 'rgba(0,0,0,0.4)'
  for (var i = 0; i < navbaractive.length; i++) {
    navbaractive[i].classList.remove('active')
  }
}
function closeNav () {
  navBar.classList.remove('active')
  document.body.style.backgroundColor = '#fefefe'
}
