barba.init({
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
            gsap.from(
                data.next.container,
                {
                    duration: 0.5, x: 1000, opacity: 0
                }
            )
        }
    }]
});