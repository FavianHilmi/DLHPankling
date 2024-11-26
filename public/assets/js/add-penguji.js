$(document).ready(function () {
    let counter = 1;

    $("#add-penguji-btn")
        .off("click")
        .on("click", function () {
            counter++;

            // Duplicate penguji element and modify attributes
            const newPenguji = `
                                <div class="row" id="penguji-container">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="nama_penguji" class="form">Nama Penguji</label>
                                            <input type="text" name="nama_penguji[]" class="form-control" placeholder="Nama Penguji">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="asal_instansi" class="form">Instansi</label>
                                            <input type="text" name="asal_instansi[]" class="form-control" placeholder="Instansi">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label for="upload_file" class="form">Tanda Tangan</label>
                                            <button type="button" class="btn btn-primary">Upload File</button>
                                        </div>
                                    </div>
                                </div>
        `;

            // Append new element to the penguji container
            $("#penguji-container").append(newPenguji);
        });
});
