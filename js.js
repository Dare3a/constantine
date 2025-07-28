let currentImageIndex = 0; // Indeks trenutno prikazane slike

function openLightbox(imageSrc, imageAlt) {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightboxImage");

    lightboxImage.src = imageSrc;
    lightboxImage.alt = imageAlt;
    lightbox.style.display = "flex";
    currentImageIndex = Array.from(document.querySelectorAll(".right-column img")).findIndex(img => img.src === imageSrc); // Pronalaženje indeksa trenutne slike
    showArrows();
}

function closeLightbox() {
    const lightbox = document.getElementById("lightbox");
    lightbox.style.display = "none";
    hideArrows();
}

function changeImage(direction) {
    const images = document.querySelectorAll(".right-column img");
    currentImageIndex += direction;
    if (currentImageIndex < 0) {
        currentImageIndex = images.length - 1;
    } else if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
    }
    const lightboxImage = document.getElementById("lightboxImage");
    lightboxImage.src = images[currentImageIndex].src;
    lightboxImage.alt = images[currentImageIndex].alt;
}

document.addEventListener("keydown", function (event) {
    if (event.key === "ArrowLeft") {
        changeImage(-1); // Pomeranje na prethodnu sliku pritiskom na strelicu levo
    } else if (event.key === "ArrowRight") {
        changeImage(1); // Pomeranje na sledeću sliku pritiskom na strelicu desno
    } else if (event.key === "Escape") {
        closeLightbox(); // Zatvaranje Lightbox galerije pritiskom na Esc
    }
});

document.querySelector(".prev").addEventListener("click", function () {
    changeImage(-1); // Pomeranje na prethodnu sliku klikom na strelicu levo
});

document.querySelector(".next").addEventListener("click", function () {
    changeImage(1); // Pomeranje na sledeću sliku klikom na strelicu desno
});

function showArrows() {
    const prevArrow = document.querySelector(".prev");
    const nextArrow = document.querySelector(".next");
    prevArrow.style.display = "block";
    nextArrow.style.display = "block";
}

function hideArrows() {
    const prevArrow = document.querySelector(".prev");
    const nextArrow = document.querySelector(".next");
    prevArrow.style.display = "none";
    nextArrow.style.display = "none";
}
document.querySelector(".lightbox").addEventListener("mousemove", function (event) {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightboxImage");
    const lightboxRect = lightbox.getBoundingClientRect();
    const x = event.clientX - lightboxRect.left;
    const y = event.clientY - lightboxRect.top;
    const width = lightboxRect.width;

    if (x < width / 3) {
        // Ako je miš levo od trećine širine, pokaži prethodnu sliku
        lightboxImage.style.cursor = "url(left_arrow.cur), auto";
        lightboxImage.onclick = function () { changeImage(-1); };
    } else if (x > (width / 3) * 2) {
        // Ako je miš desno od dve trećine širine, pokaži sledeću sliku
        lightboxImage.style.cursor = "url(right_arrow.cur), auto";
        lightboxImage.onclick = function () { changeImage(1); };
    } else {
        // Ako je miš između ta dva, pokaži običan kursor i omogući zatvaranje Lightbox-a
        lightboxImage.style.cursor = "auto";
        lightboxImage.onclick = function () { closeLightbox(); };
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const lightboxImages = document.querySelectorAll(".right-column img");
    lightboxImages.forEach((img, index) => {
        img.addEventListener("click", function () {
            openLightbox(img.src, img.alt);
        });
    });
});
