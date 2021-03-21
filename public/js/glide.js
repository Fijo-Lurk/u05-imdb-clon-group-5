var sliders = document.querySelectorAll(".glide");

for (var i = 0; i < sliders.length; i++) {
    var glide = new Glide(sliders[i], {
        gap: 6,
        perView: 8,
        type: "carousel",
        breakpoints: {
            1200: {
                perView: 7,
                gap: 0,
            },
            1050: {
                perView: 6,
            },
            886: {
                perView: 5,
            },
            750: {
                perView: 4,
            },

            489: {
                perView: 3,
            },
            375: {
                perView: 2,
            },
        },
    });

    glide.mount();
}
