<!-- PageStart -->
<main data-barba="container" data-barba-namespace="home">
    <div class="container mt-3">
        <div class="card bg-primary">
            <div class="card-header">
                <h2 class="text-white">
                    <span class="px-2"><i style="font-size: 2rem;" class="fas fa-shopping-cart cart-icon"></i></span>
                    My Cart
                </h2>
            </div>
            <ul id="cartData" class="list-group list-group-flush">

                <!-- Per Item -->
                <li class="list-group-item">

                    <div class="row">
                        <div class="col-12 col-md-3">
                            <img style="width: 3rem;" class="rounded" src="img/beef/nek.jpg" alt="nek">
                            <h5 class="ml-1 d-inline text-uppercase">NEK</h5>
                        </div>
                        <div class="col-12 col-md-3">
                            700 <strong>Grams</strong>
                        </div>
                        <div class="col-12 col-md-3">
                            Packed for: 5 <strong>People</strong>
                        </div>
                        <div class="col-12 col-md-3">
                            <button type="button" class="btn btn-outline-secondary mt-1 float-right"> X
                            </button>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
        <!-- added load script for direct access -->
        <script src="js/pageScripts.js"></script>
        <script>pageCart();</script>
        <!-- not applicable if loaded via page load ^^ -->
        <br>
        <hr>
    </div>
</main>

<!-- Page Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/cartManager.js"></script>
<script>updateCartCountOnMenu();</script>