<?php if (!isset($config_hidden) || $config_hidden['footer'] != true) : ?>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link mt-1 <?= (set_active($this->uri->segment(1), 'home', $this->uri->segment(2), array())) ?>" href="<?= base_url('home'); ?>">
                        <span>
                            <i class="fa-solid fa-house size-18"></i>
                            <span class="nav-text">Beranda</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 <?= (set_active($this->uri->segment(1), 'spp', $this->uri->segment(2), array('index'))) ?>" href="<?= base_url('spp'); ?>">
                        <span>
                            <i class="fa-solid fa-envelope-open-dollar size-18"></i>
                            <span class="nav-text">SPP</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item centerbutton">
                    <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#menumodal" id="centermenubtn">
                        <span class="theme-radial-gradient d-flex justify-content-center align-items-center">
                            <i class="bi bi-columns-gap size-22"></i>
                        </span>
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 <?= (set_active($this->uri->segment(1), 'toko', $this->uri->segment(2), array())) ?>" href="<?= base_url('toko') ?>">
                        <span>
                            <i class="fa-solid fa-shop size-18"></i>
                            <span class="nav-text">Toko</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-1 <?= (set_active($this->uri->segment(1), 'profil', $this->uri->segment(2), array('bantuan', 'laporan_presensi', 'ubah_password'))) ?>" href="<?= base_url('profil') ?>">
                        <span>
                            <i class="fa-solid fa-user size-18"></i>
                            <span class="nav-text">Profil</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
<?php endif; ?>
<div class="modal fade" id="menumodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow position-absolute" style="bottom: 65px;">
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-auto text-center">
                        <a href="<?= base_url('surat'); ?>" class="avatar avatar-60 p-1 shadow-sm shadow-primary rounded-20 bg-primary mb-2 avatar-quicklinks">
                            <div class="circle-bg-top"></div>
                            <div class="circle-bg-bottom"></div>
                            <div class="icons text-purple">
                                <i class="fa-solid fa-envelope-open-text size-28 text-white"></i>
                            </div>
                        </a>
                        <p class="size-13 text-secondary">Surat Ijin</p>
                    </div>

                    <div class="col-auto text-center">
                        <a href="<?= base_url('spp'); ?>" class="avatar avatar-60 p-1 shadow-sm shadow-warning rounded-20 bg-warning mb-2 avatar-quicklinks">
                            <div class="circle-bg-top"></div>
                            <div class="circle-bg-bottom"></div>
                            <div class="icons text-success">
                                <i class="fa-solid fa-envelope-open-dollar size-28 text-white"></i>
                            </div>
                        </a>
                        <p class="size-13 text-secondary">SPP</p>
                    </div>

                    <div class="col-auto text-center">
                        <a href="<?= base_url('kontak'); ?>" class="avatar avatar-60 p-1 shadow-sm shadow-success rounded-20 bg-success mb-2 avatar-quicklinks">
                            <div class="circle-bg-top"></div>
                            <div class="circle-bg-bottom"></div>
                            <div class="icons text-success">
                                <i class="fa-solid fa-phone size-28 text-white"></i>
                            </div>
                        </a>
                        <p class="size-13 text-secondary">Kontak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Loader -->
<div id="parent_loading">
    <div class="modal fade" id="loading_scene" tabindex="-1" aria-labelledby="detailSuratIjinModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content loader" style="border-radius: 0px;">
                <div class="modal-body loader">
                    <div class="row loader">
                        <div class="col-12 loader">
                            <div class="loadingio-spinner-double-ring-x5jbbv5x43o">
                                <div class="ldio-wmpldorvik">
                                    <div></div>
                                    <div></div>
                                    <div>
                                        <div></div>
                                    </div>
                                    <div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <p class="size-20 fw-medium loader"> Loading... </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="modal_preview_all" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content" style="border-radius: 0px; background-color: hsl(0deg 1% 20% / 90%);">
            <div class="modal-header border-0">
                <button type="button" class="btn-close-detailsurat" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <img src="" id="preview_preview_image" style="width : 100%;" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Required jquery and libraries -->

<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

<script>
    var BASE_URL = baseUrl = '<?= base_url(); ?>';
    var API_URL = apiUrl = '<?= API_URL() ?>';
    var loading_scene = new bootstrap.Modal(document.getElementById("loading_scene"), {});
    var css_button = 'btn btn-block btn-md';
    var html_loader = '<div class="row loader">\
                    <div class="col-12 loader">\
                        <div class="loadingio-spinner-double-ring-x5jbbv5x43o">\
                            <div class="ldio-wmpldorvik">\
                                <div></div>\
                                <div></div>\
                                <div>\
                                    <div></div>\
                                </div>\
                                <div>\
                                    <div></div>\
                                </div>\
                            </div>\
                        </div>\
                        <p class="size-20 fw-medium loader"> Loading... </p>\
                    </div>\
                </div>';
</script>
<!-- Customized jquery file  -->
<script src="<?= base_url() ?>assets/js/main.js?v=<?= date('YmdHis'); ?>"></script>
<script src="<?= base_url() ?>assets/js/color-scheme.js"></script>

<!-- PWA app service registration and works -->
<!-- <script src="<?= base_url() ?>assets/js/pwa-services.js"></script> -->

<!-- swiper js script -->
<script src="<?= base_url() ?>assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

<script src="<?= base_url() ?>assets/js/global.js?v=<?= date(' YmdHis'); ?>"></script>

<script src="<?= base_url('assets/js/alert/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/alert/scriptalert.js') . '?v=' . date('YmdHis') ?>"></script>

<script src="<?= base_url('assets/js/page/function.js') . '?v=' . date('YmdHis') ?>"></script>

<!--evo calender-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/evo-calendar/js/evo-calendar.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/evo-calendar/js/evo-calendar.js"></script>


<?php

if (isset($js_add) && is_array($js_add)) {
    foreach ($js_add as $js) {
        echo $js;
    }
} else {
    echo (isset($js_add) && ($js_add != "") ? $js_add : "");
}

?>