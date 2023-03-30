const preloader = document.querySelector('#preloader')
if (preloader) {
  window.addEventListener('load', () => {
    preloader.remove()
  })
}

// const redirect = pageurl =>
//   setTimeout(() => $('#load-content').load(pageurl + '.php'), 5)

navBar = document.getElementById('nav-bar')
document.onclick = function (clickEvent) {
  var clickover = clickEvent.target
  //if (!document.getElementById('nav-bar').contains(clickover) && clickover.id != "hamburger") {
  if (clickover.id != 'hamburger' && clickover.id != 'dropdown-link') {
    navBar.classList.remove('nav-active')
    document.body.style.backgroundColor = '#f1f1f1'
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
    if (!navBar.classList.contains('nav-active')) {
      this.classList.toggle('active')
    }
  })
}

hamburger = document.getElementById('hamburger')
hamburger.onclick = function () {
  navBar.classList.add('nav-active')
  document.body.style.backgroundColor = 'rgba(0,0,0,0.4)'
  for (var i = 0; i < navbaractive.length; i++) {
    navbaractive[i].classList.remove('active')
  }
}

function closeNav () {
  navBar.classList.remove('nav-active')
  document.body.style.backgroundColor = '#f1f1f1'
}

const navDropdowns = document.querySelectorAll('.nav-bar .dropdown > a')
navDropdowns.forEach(el => {
  el.addEventListener('click', function (event) {
    if (document.querySelector('.nav-bar.nav-active')) {
      event.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  })
})

const contentDropdowns = document.querySelectorAll('.dropdown-content > li')
contentDropdowns.forEach(el => {
  el.addEventListener('click', function (event) {
    if (document.querySelector('.dropdown-content')) {
      event.preventDefault()
      this.nextElementSibling.classList.toggle('active')
    }
  })
})

const contentDropdownDropdowns = document.querySelectorAll('.content-dropdown > li')
contentDropdownDropdowns.forEach(el => {
  el.addEventListener('click', function (event) {
    if (document.querySelector('.dropdown-content')) {
      event.preventDefault()
      this.nextElementSibling.classList.toggle('active')
    }
  })
})
