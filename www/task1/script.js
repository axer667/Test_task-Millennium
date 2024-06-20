const start = () => {
    getUserdata(2);
};
start();

function getUserdata(userId) {
    const userDataDOM = document.getElementById("user_data");
    userDataDOM.innerHTML = "loading...";

    const url = 'users.php?user_id='+userId;
    const options = {
        method: 'GET',
    };

    setTimeout(
        ()=> {
            fetch(url, options)
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function (body) {
                    if (body.success) {
                        createOrderDom(body.data, userDataDOM);
                    } else {
                        console.log(body.message);
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    userDataDOM.innerHTML = "Не удалось получить данные пользователя"
                });
            }, 2000);
}

function createOrderDom(data, container) {
    const userOrder = document.createElement("div");
    userOrder.classList.add("order");
    let orderDOM = "";
    if (data.userName) {
        orderDOM += "" +
            `Имя пользователя: ${data.userName}` +
            "<div class=\"order\">" +
            "Заказ:";
        if (data?.order.length > 0) {
            orderDOM += "<ul>";
            data.order.forEach(product => {
                orderDOM += "" +
                    "<li>" +
                    `<div>title : ${product.title}</div>` +
                    `<div>price : ${product.price}</div>` +
                    "</li>";
            });
            orderDOM += "</ul>";
        } else {
            orderDOM += "<p>В заказе нет товаров</p>"
        }
    }
    container.innerHTML = orderDOM;
}