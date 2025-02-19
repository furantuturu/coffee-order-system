const coffeeImgs = document.querySelectorAll('.coffee-img')
const coffeeSelect = document.querySelector('#coffee-select')
const prevBtn = document.querySelector('.prev-btn')
const nextBtn = document.querySelector('.next-btn')
const coffeeModal = document.querySelector('.coffee-modal')
const coffeeModalImg = document.querySelector('.coffee-modal img')
const priceValue = document.querySelector('.price-value')
const quantityInp = document.querySelector('#quantity')
let fImg, sImg, price = 0

function selectCoffee(e) {
    e.stopPropagation()
    quantityInp.value = 1

    if (coffeeSelect.value != "") {
        fImg = e.target.options[e.target.selectedIndex].dataset.firstImg
        sImg = e.target.options[e.target.selectedIndex].dataset.secondImg
        price = e.target.options[e.target.selectedIndex].dataset.price

        coffeeImgs[0].src = fImg
        coffeeImgs[0].alt = coffeeSelect.value
        coffeeImgs[1].src = sImg
        coffeeImgs[1].alt = coffeeSelect.value
        priceValue.textContent = price
    }
}

function slide() {
    coffeeImgs[0].classList.toggle('hidden')
    coffeeImgs[1].classList.toggle('hidden')
}

function expandModal(idx) {
    coffeeModal.showModal()
    coffeeModalImg.src = coffeeImgs[idx].src
    coffeeModalImg.alt = coffeeImgs[idx].alt
}

function collapseModal(e) {
    const dialogDimensions = coffeeModal.getBoundingClientRect()
    if (
        e.clientX < dialogDimensions.left ||
        e.clientX > dialogDimensions.right ||
        e.clientY < dialogDimensions.top ||
        e.clientY > dialogDimensions.bottom
    ) {
        coffeeModal.close()
    }
}

function sumPricePerQuantity() {
    if (parseInt(quantityInp.value) < 0 ) {
        priceValue.textContent = 0
        return
    }
    const quantity = parseInt(quantityInp.value)
    priceValue.textContent = (price * quantity).toFixed(2)
}

coffeeSelect.addEventListener('change', selectCoffee)

prevBtn.addEventListener('click', slide)
nextBtn.addEventListener('click', slide)

coffeeImgs[0].addEventListener('click', () => { expandModal(0) })
coffeeImgs[1].addEventListener('click', () => { expandModal(1) })

coffeeModal.addEventListener('click', collapseModal)

quantityInp.addEventListener('change', sumPricePerQuantity)

