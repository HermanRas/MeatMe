barba.init({
    cacheIgnore: ['cart.html'],
    prefetchIgnore: '/web_dev/projects/MeatMe/cart.html',
    transitions: [{
        name: 'opacity-transition',
        leave(data) {
            return gsap.to(
                data.current.container,
                {
                    duration: 0.7, x: -1000, opacity: 1,
                }
            )
        }
        , enter(data) {
            // do transision
            gsap.from(
                data.next.container,
                {
                    duration: 0.5, x: 1000, opacity: 0
                }
            );

            // update cart icon
            updateCartCountOnMenu();

            // see if there is any page level script to run
            let path = window.location.pathname;
            let page = path.split("/").pop();
            switch (page) {
                case 'cart.html':
                    pageCart();
                    break;

                default:
                    break;
            }
        }
    }]
});