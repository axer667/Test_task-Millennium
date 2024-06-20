const form = document.getElementById("form__products");
form.addEventListener("submit", (e) => {
    e.preventDefault();
    send();
});

document.getElementById("add_product").addEventListener("click", (e) => {
    addProductDOM();
});

function send() {
    const products = Array.from(document.querySelectorAll('.product'));
    let data = []
    products.forEach(productDOM => {
        const product = {
            title : productDOM.querySelector('.product__title').value,
            price : productDOM.querySelector('.product__price').value
        };
        data.push(product);
    });
    createProducts(data);
}

function createProducts(data) {
    const url = 'createProducts.php';
    const formData = new FormData();
    formData.append('data', JSON.stringify(data));

    const options = {
        method: 'POST',
        body: formData
    };

    fetch(url, options)
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (body) {
            if (body.success) {
                console.log("products created");
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}

function addProductDOM() {
    const newProductDOM = document.createElement("div");
    newProductDOM.classList.add("product");
    const productAttributesDOM = "" +
        "<h4>Новый товар:</h4>" +
        "<div class=\"product__label_block\">\n" +
        "  <label>\n" +
        "    <span>\n" +
        "      Название:\n" +
        "    </span>\n" +
        "    <input class=\"product__title\" type=\"text\" required />\n" +
        "      </label>\n" +
        "</div>\n" +
        "<div class=\"product__label_block\">\n" +
        "  <label>\n" +
        "    <span>\n" +
        "      Цена:\n" +
        "    </span>\n" +
        "    <input class=\"product__price\" type=\"number\" step=\"any\" required />\n" +
        "  </label>\n" +
        "</div>";
    newProductDOM.innerHTML = productAttributesDOM;
    const products = document.querySelector(".products");
    products.appendChild(newProductDOM);
}