<!-- PageStart -->
<main data-barba="container" data-barba-namespace="home">
    <form action="pay.php" method="POST">
        <div class="container mt-3">
            <div class="card bg-primary">
                <div class="card-header">
                    <h2 class="text-white">
                        <span class="px-2"><i style="font-size: 2rem;"
                                class="fas fa-shopping-cart cart-icon"></i></span>
                        My Order
                    </h2>
                </div>

                <div class="container pb-2">
                    <div class="form-group">
                        <label for="Email">Email address</label>
                        <input type="email" class="form-control" id="Email" Name="Email" aria-describedby="emailHelp"
                            placeholder="Enter email" Required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone Number</label>
                        <input type="text" class="form-control" id="Phone" Name="Phone" placeholder="072 000 1234"
                            Required>
                    </div>
                    <div class="form-group">
                        <label for="orderType">Collect / Deliver:</label>
                        <select class="form-control" name="orderType" id="orderType" onchange="getLocation()" required>
                            <option value="">Please Select</option>
                            <option vlaue="Deliver">Deliver</option>
                            <option value="Collect">Collect</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Terms & Conditions" Required>
                        <label class="form-check-label" for="exampleCheck1">I accept the <a href="terms.php"
                                target="_blank">Terms and Conditions</a>, Check me
                            out</label>
                    </div>
                </div>
                <hr>

                <ul id="cartData" class="list-group list-group-flush">
                    <!-- Per Item -->
                    <!-- 
                        /////////////////////////////////////////////////////////////////////////////////
                        //  Render Cart Page cartManager.js
                        /////////////////////////////////////////////////////////////////////////////////
                    -->
                </ul>
            </div>
            <br>
            <a class="btn  btn-primary" href="index.php">&lt; Back to Shopping</a>
            <button type="submit" class="btn btn-primary float-right">Let's Pay</button>
            <br>
            <hr>
        </div>
    </form>
</main>
<script>
function getLocation() {

    const e = document.getElementById("orderType");
    const type = e.options[e.selectedIndex].value;
    console.log(type);

    if (type === 'Deliver') {
        console.log('add input');

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "location");
        input.setAttribute("id", "location");
        input.setAttribute("class", "form-control");
        input.setAttribute("placeholder", "your address");
        input.setAttribute("required", "required");
        e.after(input);
    } else {
        const e = document.getElementById("location");
        e.parentNode.removeChild(e);
    }
}
</script>