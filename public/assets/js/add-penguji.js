$(document).ready(function () {
    let counter = 0;

    // Tambahkan baris "Penguji" baru
    $("#add-penguji-btn").off("click").on("click", function () {
        counter++;
        // HTML untuk baris "Penguji" baru
        const newPenguji = `
            <div class="row penguji-row" id="penguji-row-${counter}" style="display: flex; align-items: center; gap: 15px;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama_penguji_${counter}" class="form">Nama Penguji</label>
                        <input type="text" name="penguji[${counter}][nama_penguji]" id="nama_penguji_${counter}" class="form-control" placeholder="Nama Penguji">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="instansi_${counter}" class="form">Instansi</label>
                        <input type="text" name="penguji[${counter}][instansi]" id="instansi_${counter}" class="form-control" placeholder="Instansi">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ttd_${counter}" class="form">Tanda Tangan</label>
                        <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                            <button type="button" class="btn btn-primary upload-btn" data-counter="${counter}">
                                Upload File
                            </button>
                            <input type="file" id="ttd_${counter}" name="penguji[${counter}][ttd]" accept="image/*" style="display: none;">
                            <span id="file_name_${counter}" style="font-style: italic;">Tidak ada file dipilih</span>
                            <span id="clear_file_${counter}" style="cursor: pointer; color: red; display: none;" onclick="clearFile(${counter})">X</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-penguji-btn" data-counter="${counter}">
                        Hapus
                    </button>
                </div>
            </div>
        `;
        // Tambahkan elemen ke container
        $("#penguji-container").append(newPenguji);
    });

    // Fungsi untuk menampilkan nama file yang dipilih
    $(document).on("change", 'input[type="file"]', function () {
        const counter = $(this).attr("id").split("_")[1]; // Ambil nomor counter dari ID
        const fileName = this.files[0]?.name || "Tidak ada file dipilih";
        $(`#file_name_${counter}`).text(fileName); // Update teks nama file
        $(`#clear_file_${counter}`).show(); // Tampilkan tombol hapus
    });

    // Fungsi untuk mengunggah file melalui tombol
    $(document).on("click", ".upload-btn", function () {
        const counter = $(this).data("counter");
        $(`#ttd_${counter}`).click();
    });

    // Fungsi untuk menghapus file yang dipilih
    window.clearFile = function (counter) {
        $(`#ttd_${counter}`).val(""); // Reset file input
        $(`#file_name_${counter}`).text("Tidak ada file dipilih"); // Reset nama file
        $(`#clear_file_${counter}`).hide(); // Sembunyikan tombol hapus
    };

    // Hapus baris "Penguji" tertentu
    $(document).on("click", ".remove-penguji-btn", function () {
        const counter = $(this).data("counter");
        $(`#penguji-row-${counter}`).remove();
    });
});
