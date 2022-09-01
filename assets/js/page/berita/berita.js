/* swiper carousel connectionwiper */
var swiper2 = new Swiper(".connectionwiper", {
    slidesPerView: "auto",
    spaceBetween: 0,
    pagination: false
});

function get_kategori(property, kategori) {
    const base_kat = document.querySelector(".base_kategori");
    const display_image = document.querySelectorAll("#display_berita .zoom-filter");
    base_kat.querySelector(".active").classList.remove("active");
    property.querySelector(".kategori").classList.add("active");

    display_image.forEach((div) => {
        let display_value = div.getAttribute("data-kategori");
        if ((display_value == 'kategori-' + kategori) || (kategori == "all")) {
            div.classList.remove("hiding");
            div.classList.add("showing");
        } else {
            div.classList.add("hiding");
            div.classList.remove("showing");
        }
    });
}