const openMenu = document.querySelector('#open-menu');
const menu = document.querySelector('#menu');

    openMenu.addEventListener('click', function (){
        menu.style.display = 'block'
        const closeMenu = document.querySelector('#close-menu')
        closeMenu.addEventListener('click', function(){
           menu.style.display = 'none' 
        })
    })
