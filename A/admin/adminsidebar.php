<div class='nav'>
  <div class='logo'>
    <img src="../image/Icon.png" alt="User Image" id="userImage"/>
    <span><?= $user['full_name']?></span>
  </div>
  <ul>
    <li><i class="bi bi-window-split"></i><a href="adminportal.php">Home</a></li>
    <li class="dropdown">
      <i class="bi bi-receipt-cutoff"></i>
      <a href="#" class="dropbtn" onclick="toggleDropdown(this)"><p>Sales<i class="bi bi-chevron-up"></i></p></a>
      <div class="dropdown-content">
        <div class="dropdown-icons">
          <a href="add_sales.php"><p><i class="bi bi-plus-circle"></i>Add Sales</p></a>
          <a href="update_sales.php"><p><i class="bi bi-pencil-square"></i>Update Sales</p></a>
          <a href="show_sales.php"><p><i class="bi bi-list-check"></i>Show Sales</p></a>
        </div>
      </div>
    </li>
    <li class="dropdown">
      <i class="bi bi-box-seam"></i>
      <a href="#" class="dropbtn" onclick="toggleDropdown(this)"><p>Inventory<i class="bi bi-chevron-up"></i></p></a>
      <div class="dropdown-content">
        <div class="dropdown-icons">
          <a href="add_Inventory.php"><p><i class="bi bi-database-add"></i>Add Inventory</p></a>
          <a href="update_Inventory.php"><p><i class="bi bi-pencil-square"></i>Update Inventory</p></a>
          <a href="show_Inventory.php"><p><i class="bi bi-list-check"></i>Show Inventory</p></a>
        </div>
      </div>
    </li>
    <li><i class="i bi-people"></i><a href="admin_customers.php">Accounts</a></li>
    <li><i class="bi bi-droplet"></i><a href="admin_order.php">Orders</a></li>
    <li class="last"><i class="bi bi-box-arrow-right"></i><a href="../Connection/logout.php">Logout</a></li> <!-- destroy sess-->
  </ul>
</div>
