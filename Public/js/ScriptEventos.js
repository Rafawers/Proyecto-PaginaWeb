var swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 15,
        stretch: 0,
        depth: 300,
        modifier: 1,
        slideShadows: true,
    },
    loop: true,
});

var sliderImages = document.querySelectorAll('.swiper-slide');

sliderImages.forEach(function (image, index) {
    image.addEventListener('click', function () {
        var imagePath = image.querySelector('img').src;
        

        var otherPageIndex = findImageIndex(imagePath);

        window.location.href = 'Galeria.html?imagen=' + encodeURIComponent(otherPageIndex);
    });
});

function findImageIndex(imagePath) {
    var otherPageImages = document.querySelectorAll('.tz-gallery img');
    
    for (var i = 0; i < otherPageImages.length; i++) {
        if (otherPageImages[i].src === imagePath) {
            return i;
        }
    }
    return 0;
}
