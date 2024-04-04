<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="app.js"></script>
    <title>Order Management</title>
</head>
<body>
    <header>
        <h1>Order Management System</h1>
    </header>
    <main>
        <section id="order-section">
            <h2>Place Order</h2>
            <button id="place-order-btn">Place Order</button>
            <script src="{{ asset('js/app.js') }}"></script>
        </section>
        <section id="preparing-orders-section">
            <h2>Preparing Orders</h2>
            <ul id="preparing-orders-list">
                <!-- Orders in preparation will be dynamically added here -->
            </ul>
        </section>
        <section id="inventory-section">
            <h2>Inventory</h2>
            <h3>Bodega de alimentos</h3>
            <ul id="ingredients-list">
                <!-- Ingredientes y cantidades disponibles en la bodega serán dinámicamente agregados aquí -->
            </ul>
            <h3>Historial de compras en la plaza de alimentos</h3>
            <ul id="shopping-history-list">
                <!-- Historial de compras en la plaza de alimentos será dinámicamente agregado aquí -->
            </ul>
        </section>
        <section id="order-history-section">
            <h2>Order History</h2>
            <ul id="order-history-list">
                <!-- Historial de pedidos realizados a la cocina será dinámicamente agregado aquí -->
            </ul>
        </section>
        <section id="recipes-section">
            <h2>Recipes</h2>
            <ul id="recipes-list">
                <!-- Recetas con ingredientes y cantidades serán dinámicamente agregadas aquí -->
            </ul>
        </section>
    </main>
</body>
</html>
