document.addEventListener("DOMContentLoaded", () => {
    // Add to Cart
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", () => {
            const productId = button.getAttribute("data-product-id");

            fetch("add_to_cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `product_id=${productId}`
            })
            .then(response => response.text())
            .then(alert);
        });
    });

    // View Cart
    document.getElementById("view-cart").addEventListener("click", () => {
        fetch("view_cart.php")
            .then(response => response.json())
            .then(cart => {
                console.log(cart);
                alert("Check the console for cart details!");
            });
    });

    // Complete Order
    document.getElementById("complete-order").addEventListener("click", () => {
        fetch("complete_order.php")
            .then(response => response.text())
            .then(alert);
    });
});
