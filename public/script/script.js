
// **** NAV ****
// =============

let btnLink = document.querySelectorAll('.btn-link-blog')
let section = document.querySelectorAll('.sections-blog')

btnLink.forEach(btnsLink => {
    btnsLink.addEventListener('click', () => {
        let sectionNb = btnsLink.id
        section.forEach(sections => {
            sections.classList.remove('visible')
        })
        document.querySelector(`.${sectionNb}`).classList.add('visible')
    })
})


// **** COPYRIGHT ****
// ===================
var now = new Date();
var year = now.getFullYear();
var copyright = document.querySelector(".copyright");
// year.toString();

copyright.textContent = year;