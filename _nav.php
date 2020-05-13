<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img src="https://via.placeholder.com/1024x1204.png?text=1024x1024 + LOGO" width="30" height="30"
            class="d-inline-block align-top rounded">
        QWEENS ONLINE DELI
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="specials.php">Specials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Orders
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Order History</a>
                    <a class="dropdown-item" href="#">Active Orders</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="search form-inline input-group my-2 my-lg-0 float-right">
        <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="cart">
        <a class="btn  btn-outline-secondary text-white" href="cart.php">
            <i class="fas fa-shopping-cart cart-icon"></i><span class="badge-pill badge-danger cart-notify"
                id="cartCount"></span>
        </a>
    </div>
</nav>