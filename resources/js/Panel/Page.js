class Page {
    init() {
        this.generateOrderArray();
        this.handleOrderUpdate();
    }

    generateOrderArray() {
        const form = document.querySelector(".page-order-form");
        if (form) {
            const pagesOrderInput = form.querySelector("input[name=pages_order]");
            let parsedOrderList = pagesOrderInput.value || "{}";
            let orderList = JSON.parse(parsedOrderList);

            const selectOrderInputs = document.querySelectorAll(".page-order-input");
            if (selectOrderInputs.length) {
                selectOrderInputs.forEach((select) => {
                    const selectedValue = select.value;
                    const pageId = select.dataset.page;

                    orderList[pageId] = selectedValue || 0;
                });
            }

            pagesOrderInput.value = JSON.stringify(orderList);
        }
    }

    handleOrderUpdate() {
        const selectOrderInputs = document.querySelectorAll(".page-order-input");
        if (selectOrderInputs.length) {
            selectOrderInputs.forEach((select) => {
                select.addEventListener("change", (e) => {

                    const pagesOrderInput = document.querySelector("input[name=pages_order]");
                    if (!pagesOrderInput) return;

                    let parsedOrderList = pagesOrderInput.value || "{}";
                    let orderList = JSON.parse(parsedOrderList);

                    const selectedValue = e.target.value;
                    const pageId = select.dataset.page;

                    orderList[pageId] = selectedValue || 0;

                    pagesOrderInput.value = JSON.stringify(orderList);
                });
            });
        }
    }
}

export default Page;
