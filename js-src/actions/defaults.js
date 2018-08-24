

const dropdown = e => {
    let dd = e.target;

    do {
        if (dd.classList.contains('dropdown')) {
            break;
        }
        dd = dd.parentElement;
    } while(dd);

    if (! dd) {
        Array.from(document.querySelectorAll('.dropdown.show, .dropdown-menu.show')).forEach(el => {
            el.classList.remove('show')
        })
        return;
    }

    let menu = dd.querySelector('.dropdown-menu')
    if (! menu) {
        return;
    }

    if (dd.classList.contains('show')) {
        dd.classList.remove('show')
        menu.classList.remove('show')
        return;
    }

    Array.from(document.querySelectorAll('.dropdown.show, .dropdown-menu.show'))
                .forEach(el => el.classList.remove('show'));

    dd.classList.add('show')
    menu.classList.add('show')
}



window.addEventListener('click', e => {
    dropdown(e)
})