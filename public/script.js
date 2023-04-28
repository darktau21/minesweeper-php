const field = document.querySelector('.field')

function addFormListener(formSelector, type) {
    field.addEventListener(type, (evt) => {
        evt.preventDefault()
        const target = evt.target.closest('.cell')?.querySelector(formSelector)
        target?.submit()
    })
}

addFormListener('.open', 'click')
addFormListener('.mark', 'contextmenu')