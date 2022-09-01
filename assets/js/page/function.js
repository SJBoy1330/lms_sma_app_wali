
function submit_form(element, id_form, num = 0, color = '#FFFFFF') {
    // console.log('ok');
    var text_button = document.getElementById(element.id).innerHTML;
    var url = $(id_form).attr('action');
    var method = $(id_form).attr('method');
    // console.log(url);

    var form = $('form')[num];
    var form_data = new FormData(form);

    // console.log(form);
    $.ajax({
        url: url,
        method: method,
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $('#' + element.id).prop('disabled', true);
            $('#' + element.id).html('<div class="spinner-border" style="color : ' + color + '" role="status">\
                <span class="sr-only"></span>\
</div>');
        },
        success: function (data) {
            // console.log(data);
            // $('input').val('');
            // $('select').prop('selected', false);
            // $('textarea').val('');
            $('.fadedin').remove();
            if (data.load != null) {
                for (var a = 0; a < data.load.length; a++) {
                    $(data.load[a].parent).load(data.load[a].reload);
                }
            }
            $('#' + element.id).prop('disabled', false);
            $('#' + element.id).html(text_button);

            if (data.status == 200 || data.status == true) {
                var icon = 'success';
            } else {
                var icon = 'warning';
            }
            if (data.alert) {
                Swal.fire({
                    title: data.alert.title,
                    text: data.alert.message,
                    icon: icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: css_button
                    }
                }).then(function () {
                    if (data.redirect) {
                        location.href = data.redirect;
                    }
                    if (data.reload == true) {
                        location.reload();
                    }
                    if (data.modal != null) {
                        $(data.modal.id).modal(data.modal.action);
                    }
                });
            } else {
                if (data.required) {
                    const array = data.required.length;
                    for (var i = 0; i < array; i++) {
                        $('#' + data.required[i][0]).append('<span class="text-danger size-12 fadedin">' + data.required[i][1] + '</span>');
                    }
                }
                if (data.redirect) {
                    location.href = data.redirect;
                }
                if (data.modal != null) {
                    $(data.modal.id).modal(data.modal.action);
                }

                if (data.reload == true) {
                    location.reload();
                }
            }
        }
    });

}



// function search(element, id_tabel, property = 'tbody tr') {
//     $(id_tabel + ' ' + property).filter(function () {
//         $(this).toggle($(this).text().toLowerCase().indexOf(element.value.toLowerCase()) > -1);
//     });
// }



function search(element, property = 'tbody tr', backup = null) {
    // $(id_tabel + ' ' + property).filter(function () {
    //     $(this).toggle($(this).text().toLowerCase().indexOf(element.value.toLowerCase()) > -1);
    //     if (backup != null) {
    //         var vector = document.querySelector(backup);
    //         // console.log($(this).text().toLowerCase().indexOf(element.value.toLowerCase()));
    //         var hitung = $('.showing').length;
    //         if ($(this).text().toLowerCase().indexOf(element.value.toLowerCase()) <= -1) {
    //             vector.classList.remove('d-none');
    //         } else {
    //             vector.classList.add('d-none');
    //         }
    //     }
    // });

    let cards = document.querySelectorAll(property)

    let search_query = element.value;

    //Use innerText if all contents are visible
    //Use textContent for including hidden elements
    for (var i = 0; i < cards.length; i++) {
        if (cards[i].textContent.toLowerCase()
            .includes(search_query.toLowerCase())) {
            // cards[i].style.display = "";
            cards[i].classList.remove("hiding");
            cards[i].classList.add("showing");
        } else {
            cards[i].classList.add("hiding");
            cards[i].classList.remove("showing");
        }
    }

    if (backup != null) {
        var vector = document.querySelector(backup);
        let jumlah = document.querySelectorAll(property + '.showing').length;
        console.log(jumlah);
        if (jumlah < 1) {
            vector.classList.remove('hiding');
            vector.classList.add('showing');
        } else {
            vector.classList.remove('showing');
            vector.classList.add('hiding');
        }
    }

    //A little delay
    let typingTimer;
    // let typeInterval = 500;
    let searchInput = document.getElementById(element.id);

    clearTimeout(typingTimer);
    // typingTimer = setTimeout(liveSearch, 0);
}



function preview_image(img) {
    // console.log(img);
    $('#preview_preview_image').attr('src', img);
    $('#modal_preview_all').modal('show');
}