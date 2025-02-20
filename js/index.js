const coffeeImgs = document.querySelectorAll('.coffee-img')
const coffeeSelect = document.querySelector('#coffee-select')
const prevBtn = document.querySelector('.prev-btn')
const nextBtn = document.querySelector('.next-btn')
const coffeeModal = document.querySelector('.coffee-modal')
const coffeeModalImg = document.querySelector('.coffee-modal img')
const priceValue = document.querySelector('.price-value')
const quantityInp = document.querySelector('#quantity')
const addToCartBtn = document.querySelector('.add-to-cart-btn')
const cartContainer = document.querySelector('.cart-container')
const cartInfo = document.querySelector('.cart-info')
const tableBody = document.querySelector('.cart-table tbody')
const totalPriceValue = document.querySelector('.total-price-value')

const coffeeNames = document.querySelector("input[name='coffee-names']")
const coffeeQuantities = document.querySelector("input[name='coffee-quantities']")
const coffeePrices = document.querySelector("input[name='coffee-prices']")
const coffeeTotalPrice = document.querySelector("input[name='coffee-total-price']")

const submitForm = document.querySelector('.submit-form')
const submitOrderBtn = document.querySelector('.submit-order-btn')

const error = document.querySelector('.error')
let fImg, sImg, price = 0, coffeeName

function selectCoffee(e) {
    e.stopPropagation()
    quantityInp.value = 1
    error.textContent = ""


    if (coffeeSelect.value != "") {
        fImg = e.target.options[e.target.selectedIndex].dataset.firstImg
        sImg = e.target.options[e.target.selectedIndex].dataset.secondImg
        price = e.target.options[e.target.selectedIndex].dataset.price

        coffeeImgs[0].src = fImg
        coffeeImgs[0].alt = coffeeSelect.value
        coffeeImgs[1].src = sImg
        coffeeImgs[1].alt = coffeeSelect.value
        priceValue.textContent = price
        coffeeName = coffeeSelect.value
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
    coffeeModalImg.title = coffeeImgs[idx].alt
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
    error.textContent = ""
    if (parseInt(quantityInp.value) < 0 || quantityInp.value === '') {
        error.textContent = "Quantity can't be below 0"
        quantityInp.value = 1
    } else if (parseInt(quantityInp.value) > 10) {
        error.textContent = "Quantity can't be more than 10"
        quantityInp.value = 10
    }

    const quantity = parseFloat(quantityInp.value)
    priceValue.textContent = Math.round(price * quantity * 100) / 100
}

function addToCartClicked() {
    if (coffeeSelect.value === '' || quantityInp.value === '') {
        error.textContent = "Fill up the fields properly"
        return
    }

    cartInfo.classList.add('hidden')

    const tr = document.createElement('tr')

    addToCart(tr)
}

function addToCart(tr) {
    const cartTitles = tableBody.querySelectorAll('.cart-title')

    for (const title of cartTitles) {
        if (title.textContent === coffeeName) {
            tableBody.removeChild(title.parentElement.parentElement)
        }
    }

    tr.innerHTML = 
    /*html*/`
        <tr class="cart-row">
            <th scope="row">
                <img src="${fImg}" alt="${coffeeName}" width="50" height="50">
                <span class="cart-title">${coffeeName}</span>
            </th>
            <td class="cart-quantity">${quantityInp.value}</td>
            <td class="cart-price">$${priceValue.textContent}</td>
            <td><button class="cart-rmv-btn">Remove</button></td>
        </tr>
    `

    tableBody.append(tr)

    cartRmvBtnListeners()
    updateTotalPrice()
    cartData()
}

function cartRmvBtnListeners() {
    const cartRmvBtns = tableBody.querySelectorAll('.cart-rmv-btn')

    for (const rmvBtn of cartRmvBtns) {
        rmvBtn.addEventListener('click', removeCart)
    }
}

function removeCart(e) {
    const btn = e.target
    tableBody.removeChild(btn.parentElement.parentElement)

    if (tableBody.children.length < 1) cartInfo.classList.remove('hidden')
    updateTotalPrice()
    cartData()
}

function updateTotalPrice() {
    const cartPrices = tableBody.querySelectorAll('.cart-price')
    let total = 0

    for (const cartPrice of cartPrices) {
        const price = parseFloat(cartPrice.textContent.replace('$', ''))
        total += price
    }

    totalPriceValue.textContent = `${Math.round(total * 100) / 100}`
}

function cartData() {
    const rows = tableBody.querySelectorAll('tr')

    coffeeNames.value = ''
    coffeeQuantities.value = ''
    coffeePrices.value = ''

    for (const row of rows) {
        const title = row.querySelector('.cart-title')
        const quantity = row.querySelector('.cart-quantity')
        const price = row.querySelector('.cart-price')

        coffeeNames.value += title.textContent + ' '
        coffeeQuantities.value += quantity.textContent + ' '
        coffeePrices.value += price.textContent.replace('$', '') + ' '
    }

    coffeeTotalPrice.value = totalPriceValue.textContent
    console.log({ coffeename: coffeeNames.value, coffeequantity: coffeeQuantities.value, coffeeprices: coffeePrices.value, totalprice: coffeeTotalPrice.value })
}

function submitOrder() {
    submitOrderBtn.setAttribute("disabled", true)
    cartData()
}

coffeeSelect.addEventListener('change', selectCoffee)

prevBtn.addEventListener('click', slide)
nextBtn.addEventListener('click', slide)

coffeeImgs[0].addEventListener('click', () => { expandModal(0) })
coffeeImgs[1].addEventListener('click', () => { expandModal(1) })

coffeeModal.addEventListener('click', collapseModal)

quantityInp.addEventListener('change', sumPricePerQuantity)

addToCartBtn.addEventListener('click', addToCartClicked)

submitForm.addEventListener('submit', submitOrder)
