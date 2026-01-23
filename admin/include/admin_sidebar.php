<aside id="admin-sidebar"> 
    <img id="admin-logo" src="../../Images/logo.png" alt="website logo">
    <nav>
        <ul>
            <li><a href="/admin/admin_dashboard.php" class="admin-sidebar-element <?=  $selectedSide === "dashboard" ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="/admin/admin_products.php" class="admin-sidebar-element <?=  $selectedSide === "products" ? 'active' : '' ?>">Products</a></li>
            <li><a href="/admin/admin_categories.php" class="admin-sidebar-element <?=  $selectedSide === "categories" ? 'active' : '' ?>">Categories</a></li>
            <li><a href="/admin/admin_orders.php" class="admin-sidebar-element <?=  $selectedSide === "orders" ? 'active' : '' ?>">Order</a></li>
            <li><a href="/admin/admin_feedback.php" class="admin-sidebar-element <?=  $selectedSide === "feedbacks" ? 'active' : '' ?>">Feedback</a></li>
        </ul>
    </nav>
</aside>