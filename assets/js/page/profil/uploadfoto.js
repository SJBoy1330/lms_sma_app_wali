
function previewImage(id_sekolah, id_wali) {
    const photo = document.querySelector('#photo');
    const getPhoto = document.querySelector('#photouser');

    getPhoto.style.display = 'block';

    let file = photo.files[0];
    const oFReader = new FileReader();
    oFReader.readAsDataURL(file);

    let formdata = new FormData();
    formdata.append("id_sekolah", id_sekolah);
    formdata.append("id_wali", id_wali);
    formdata.append("foto", file);

    $.ajax({
        url: BASE_URL + "func_profil/edit_foto/",
        data: formdata,
        processData: false,
        contentType: false,
        method: 'POST',
        dataType: 'json',
        cache: false,
        beforeSend() {
            $('#loading_scene').modal('show');
        },
        success: function (data) {
            $('#loading_scene').modal('hide');
            $('#reload_side_foto').load(BASE_URL + 'profil #side_foto_profil');
            if (data.status == 200) {
                Swal.fire({
                    title: 'PEMBERITAHUAN',
                    text: data.message,
                    icon: 'success',
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: css_button
                    }
                })

            } else {
                Swal.fire({
                    title: 'PERINGATAN',
                    text: data.message,
                    icon: 'warning',
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: css_button
                    }
                })
            }
        }
    })


    oFReader.onload = function (oFREvent) {
        getPhoto.style.backgroundImage = 'url(' + oFREvent.target.result + ')';
    }
}