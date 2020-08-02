$("body").on("click", ".btn-remove-data", function (e) {
    e.preventDefault();
    let targetUrl = $(this).attr("href");
    let id = $(this).attr("data-id");
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak bisa dikembalikan lagi!",
        type: 'warning',
        width: 500,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.value) {
            let postData = {};
            postData["id"] = id;
            $.post(targetUrl, postData, () => Swal.fire(
                "dihapus",
                "Data berhasil dihapus!",
                "success",
            ).then(() => location.reload()));
        }
    });
});
