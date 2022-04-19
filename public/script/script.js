
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