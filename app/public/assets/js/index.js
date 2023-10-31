//Header script

window.addEventListener('resize', e => {
    if (window.innerWidth >= 801)
    {
        document.querySelector('.nav-area').style.display = 'flex';
    }
});

const openMenu = document.querySelector('.mobile-devices');

openMenu.addEventListener('click', e => {

    const mobileMenu = document.querySelector('.nav-area');

    const mobileMenuState = getComputedStyle(mobileMenu).display;

    switch (mobileMenuState)
    {
        case 'flex':
            mobileMenu.style.display = 'none';
            break;
        
        case 'none':
            mobileMenu.style.display = 'flex';
    }

});