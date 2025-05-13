@extends('layouts.full')

@section('title', $nama_menu)

@section('content')
<style>
    /* Make the left filter section sticky */
    .col-3 {
        position: -webkit-sticky;
        /* For Safari */
        position: sticky;
        top: 20px;
        /* Adjust the top value to set how far from the top of the viewport the element sticks */
        z-index: 10;
        /* Make sure it stays on top of other elements */
        padding-top: 10px;
        /* Add some padding on top if necessary */
        max-height: calc(100vh - 20px);
        /* Make sure the sidebar doesn't grow too tall */
        overflow-y: auto;
        /* Allow scrolling within the filter section if it's too long */
    }


    /* Adjust the right content to provide some margin */
    .col-9 {
        margin-top: 20px;
        /* Adjust as needed */
    }

    /* Ensure the sticky behavior works well on mobile */
    @media (max-width: 768px) {
        .col-3 {
            position: static;
            /* Reset sticky behavior on smaller screens */
            margin-bottom: 20px;
            /* Add some space below the filter on smaller screens */
        }
    }


    /* Styling for book item layout */
    .book-card-body {
        display: flex;
        padding: 0;
        /* Remove padding from card body */
        overflow: hidden;
        /* Ensure no content overflows the card */
    }

    .book-cover {
        flex: 0 0 35%;
        /* The book cover takes up 35% of the card */
        max-width: 35%;
        height: 100%;
        /* Make the cover image fill the card height */
        object-fit: cover;
        /* Ensure the image covers the area without distorting */
        border-radius: 0;
        /* No rounded corners for the cover */
        box-shadow: none;
        /* Remove shadow from the cover */
    }

    .book-info {
        flex: 1;
        padding: 20px;

        /* Add padding to the text section */
    }

    .book-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .book-text {
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .badge {
        font-size: 0.7rem;
        padding: 5px 15px;
        font-weight: 600;
    }

    .card-book:hover {
        transform: translateY(-5px);
        /* Slight lift on hover */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        /* Enhanced shadow effect on hover */
    }

    .availability-status {
        margin-top: 10px;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .available {
        color: #28a745;
        /* Green color for available status */
    }

    .unavailable {
        color: #dc3545;
        /* Red color for unavailable status */
    }

    .unavailable .book-info {
        opacity: 0.5;
        /* Faded effect for unavailable books */
    }

    .unavailable {
        opacity: 0.5;
    }

    /* Responsive layout adjustments */
    @media (max-width: 768px) {
        .book-card-body {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .book-cover {
            max-width: 80%;
            height: 250px;
            /* Set a fixed height for the cover on smaller screens */
            margin-bottom: 15px;
        }

        .book-info {
            text-align: center;
            padding-left: 0;
        }

        .card-body {
            padding: 15px;
        }
    }

    /* Specific styling for the Peminjam card */

    /* Card Header */
    .peminjam-card .card-header {
        background-color: rgba(0, 123, 255, 0.66);
        /* Blue background for header */
        color: white;
        /* White text color */
        font-weight: bold;
    }

    /* Card Body Styling */
    .peminjam-card .card-body {
        padding: 20px;
    }

    /* Table styling inside Peminjam Card */
    .peminjam-card table {
        width: 100%;
        margin-top: 10px;
    }

    /* Book Image Styling */
    .peminjam-card img {
        border-radius: 5px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .peminjam-card table {
            width: 100%;
            padding: 10px;
        }

        .peminjam-card img {
            width: 80px;
            height: 120px;
        }
    }
</style>

<div class="page-container">
    <div class="row">
        <div class="col-3">
            <!-- Filters -->
            <button type="button" class="btn btn-outline-info rounded-pill btn-sm mb-2 w-100">Filter</button>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('kategori')">
                    <h4 class="mb-0">
                        Kategori
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-kategori"></i>
                </div>
                <div class="card-body row" id="kategori" style="display: none; max-height: 150px; overflow-y: auto;">
                    @foreach($list_category as $row_category)
                    <div class="form-check mb-1 col-sm-6">
                        <input type="checkbox" class="form-check-input" id="kategory{{ $row_category['id'] }}" name="kategory[]" value="{{ $row_category['id'] }}">
                        <label class="form-check-label" for="kategory{{ $row_category['id'] }}">{{ $row_category['nama'] }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('penerbit')">
                    <h4 class="mb-0">
                        Penerbit
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-penerbit"></i>
                </div>
                <div class="card-body" id="penerbit" style="display: none; max-height: 150px; overflow-y: auto;">
                    @foreach($list_penerbit as $row_penerbit)
                    <div class="form-check mb-1 col-sm-6">
                        <input type="checkbox" class="form-check-input" id="penerbit{{ $row_penerbit['id'] }}" name="penerbit[]" value="{{ $row_penerbit['id'] }}">
                        <label class="form-check-label" for="penerbit{{ $row_penerbit['id'] }}">{{ $row_penerbit['nama'] }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('pengarang')">
                    <h4 class="mb-0">
                        Pengarang
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-pengarang"></i>
                </div>
                <div class="card-body" id="pengarang" style="display: none; max-height: 150px; overflow-y: auto;">
                    @foreach($list_pengarang as $row_pengarang)
                    <div class="form-check mb-1 col-sm-6">
                        <input type="checkbox" class="form-check-input" id="pengarang{{ $row_pengarang['id'] }}" name="pengarang[]" value="{{ $row_pengarang['id'] }}">
                        <label class="form-check-label" for="pengarang{{ $row_pengarang['id'] }}">{{ $row_pengarang['nama'] }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('tahun')">
                    <h4 class="mb-0">
                        Tahun Terbit
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-tahun"></i>
                </div>
                <div class="card-body row" id="tahun" style="display: none; max-height: 150px; overflow-y: auto;">
                    @php
                    $currentYear = date('Y'); // Ambil tahun sekarang
                    @endphp

                    @for ($i = $currentYear; $i >= $currentYear - 20; $i--)
                    <div class="form-check mb-1 col-sm-6">
                        <input type="checkbox" class="form-check-input" id="tahun{{ $i }}" name="tahun[]" value="{{ $i }}">
                        <label class="form-check-label" for="tahun{{ $i }}">{{ $i }}</label>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Peminjam Card (Borrower Card) -->
            <div class="card peminjam-card border-0 rounded-3 overflow-hidden" id="page_pinjam" style="display: none;">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        Peminjam: John Doe
                    </h4>
                    <span class="book-count" style="font-size: 1rem; font-weight: bold;">1</span>
                </div>
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <img src="https://cdn.pixabay.com/photo/2015/09/18/19/03/book-944490_960_720.jpg" alt="Book Cover">
                            </td>
                            <td>
                                <h4>The Great Adventure</h4>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-ghost-danger rounded-pill btn-sm">Batal</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary rounded-pill btn-sm">Simpan</button>
                    </div>
                </div>
            </div>
            <!-- Repeat for other filters like Penerbit, Pengarang, Tahun Terbit -->
        </div>

        <div class="col-9">
            <div class="row" id="searchResults">

                <div class="col-sm-4" hidden>
                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden card-book">
                        <div class="card-body book-card-body d-flex">
                            <!-- Book Cover (left side) -->
                            <div class="book-cover me-3" style="flex: 0 0 35%; max-width: 35%;">
                                <img src="https://cdn.pixabay.com/photo/2017/08/30/01/04/book-2695563_960_720.jpg" alt="Mysteries Unveiled" class="img-fluid rounded-3 shadow-sm">
                            </div>

                            <!-- Book Information (right side) -->
                            <div class="book-info" style="flex: 1;">
                                <h5 class="book-title mb-2 text-center fw-bold" style="font-size: 1.25rem;">Mysteries Unveiled</h5>
                                <p class="card-text book-description text-dark mb-3" style="font-size: 0.95rem;">
                                    Delve into a world of secrets and intrigue as hidden truths come to light.
                                </p>
                                <p class="card-text book-text text-muted" style="font-size: 1rem;">John Smith</p>
                                <p class="card-text book-text text-muted" style="font-size: 0.9rem;">Mystery House | 2023</p>
                                <!-- Genre Badges -->
                                <div class="mb-2">
                                    <span class="badge rounded-pill bg-info text-white me-2">Anak-anak</span>
                                    <span class="badge rounded-pill bg-info text-white">Remaja</span>
                                </div>

                                <!-- Availability Status -->
                                <p class="card-text availability-status available" style="font-weight: bold;">
                                    <strong>2 Buku Tersedia</strong>
                                </p>

                                <!-- Pinjam Button (Borrow) -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-soft-primary rounded-pill btn-sm">Pinjam</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4" hidden>
                    <div class="card shadow-lg border-0 rounded-3 overflow-hidden unavailable card-book">
                        <div class="card-body book-card-body d-flex">
                            <!-- Book Cover (left side) -->
                            <div class="book-cover me-3" style="flex: 0 0 35%; max-width: 35%;">
                                <img src="https://cdn.pixabay.com/photo/2017/08/30/01/04/book-2695563_960_720.jpg" alt="Mysteries Unveiled" class="img-fluid rounded-3 shadow-sm">
                            </div>

                            <!-- Book Information (right side) -->
                            <div class="book-info" style="flex: 1;">
                                <h5 class="book-title mb-2 text-center fw-bold" style="font-size: 1.25rem;">Mysteries Unveiled</h5>
                                <p class="card-text book-description text-dark mb-3" style="font-size: 0.95rem;">
                                    Delve into a world of secrets and intrigue as hidden truths come to light.
                                </p>
                                <p class="card-text book-text text-muted" style="font-size: 1rem;">John Smith</p>
                                <p class="card-text book-text text-muted" style="font-size: 0.9rem;">Mystery House | 2023</p>

                                <!-- Genre Badges -->
                                <div class="mb-2">
                                    <span class="badge rounded-pill bg-info text-white me-2">Anak-anak</span>
                                    <span class="badge rounded-pill bg-info text-white">Remaja</span>
                                </div>

                                <!-- Availability Status -->
                                <p class="card-text availability-status unavailable" style="font-weight: bold;">
                                    <strong>2 Buku Tidak Tersedia</strong>
                                </p>

                                <!-- Pinjam Button (Borrow) - Disabled -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-soft-primary rounded-pill btn-sm text-white" disabled>Pinjam</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div id="pagination"></div>
        </div>
    </div>

    <!-- Modal for Book Detail -->
    <div class="modal fade" id="bookDetailModal" tabindex="-1" aria-labelledby="bookDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookDetailModalLabel">Detail Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Book Cover Image -->
                        <div class="col-md-4">
                            <img id="book-cover" src="" class="img-fluid rounded-3 shadow-sm" alt="Book Cover">
                        </div>
                        <!-- Book Info -->
                        <div class="col-md-8">
                            <center>
                                <h3 id="book-title" class="fw-bold"></h3>
                            </center>

                            <p><strong>Pengarang:</strong> <span id="book-author"></span></p>
                            <p><strong>Penerbit:</strong> <span id="book-publisher"></span></p>
                            <p><strong>Tahun Terbit:</strong> <span id="book-year"></span></p>
                            <p><strong>Kategori:</strong> <span id="book-categories"></span></p>
                            <p><strong>Rak:</strong> <span id="book-rak"></span></p>
                            <p><strong>Deskripsi:</strong></p>
                            <p id="book-description"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="borrowBookBtn">Pinjam</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Member Modal for Anggota -->
    <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberModalLabel">Data Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 position-relative">
                        <input type="text" id="cari_anggota" class="form-control" placeholder="Cari anggota" data-bs-toggle="tooltip" title="Masukkan nama/nisn siswa" />
                        <!-- Dropdown hasil pencarian -->
                        <div id="searchResultsAnggota" class="dropdown-menu" style="width: 100%; display: none;"></div>
                    </div>

                    <!-- Tampilan Kartu Anggota -->
                    <div id="anggotaCard" class="mt-3" style="display: none;">
                        <div class="card" style="width: 100%; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <div class="card-body d-flex align-items-center" style="padding: 20px;">

                                <!-- Foto Anggota (di sebelah kiri) -->
                                <div style="margin-right: 40px;">
                                    <img id="anggotaFoto" src="https://via.placeholder.com/100" alt="Foto Anggota" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #f1f1f1;">
                                </div>

                                <!-- Informasi Anggota (di sebelah kanan) -->
                                <div>
                                    <h5 class="card-title" id="anggotaNama" style="font-size: 18px; font-weight: bold; color: #333;"></h5>
                                    <p class="card-text" id="anggotaNisn" style="font-size: 14px; color: #777;">NISN: <span class="text-primary" id="nisnText"></span></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="">
                        <input name="id_anggota" id="id_anggota">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="borrowBookBtn">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('javascript_custom')
<script>
    var selectedAnggotaIds = [];

    // Custom JavaScript for handling show/hide functionality
    $(document).ready(function() {
        listBooks();
        // Any custom JS actions you want to trigger when the page loads

        // Handle 'Enter' key press to trigger search
        $('#search-modal-input').on('keypress', function(event) {
            // Check if the pressed key is the Enter key (key code 13)
            if (event.which === 13) {
                // Capture the search input value
                var searchQuery = $(this).val();

                // Show "Searching..." message
                $('#search-status').text('Mencari buku...').show(); // Display searching message

                // Close the search modal after search is triggered
                $('#searchModal').modal('hide');

                // Call the listBooks function with the current page (default to page 1) and search query
                listBooks(1, searchQuery); // Default to page 1
            }
        });

        // Handle the search modal submit event (optional)
        $('#searchModal form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Capture the search input value
            var searchQuery = $('#search-modal-input').val();

            // Show "Searching..." message
            $('#search-status').text('Mencari buku...').show(); // Display searching message

            // Close the modal
            $('#searchModal').modal('hide');

            // Call the listBooks function with the search query
            listBooks(1, searchQuery); // Default to page 1
        });

        // Tangani event keyup pada input anggota
        $('#cari_anggota').on('keyup', function() {
            var query = $(this).val(); // Ambil nilai input

            // Jika input kosong, tidak melakukan pencarian dan menutup dropdown
            if (query.length < 0 || query.length == 0) {
                $('#searchResultsAnggota').html('').hide(); // Kosongkan hasil pencarian dan sembunyikan dropdown
                return;
            }

            // Mengirimkan request ke API untuk mencari anggota berdasarkan query
            $.ajax({
                url: '{{ env("API_URL") . "/api/perpustakaan/anggota" }}', // Ganti dengan URL API yang sesuai
                method: 'GET',
                data: {
                    search: query
                },
                headers: {
                    'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
                },
                success: function(response) {
                    // Misalnya, API mengembalikan array anggota
                    var results = response.data.items.filter(function(anggota) {
                        // Periksa apakah nama pengguna ada dan tidak null atau kosong
                        if (anggota.pengguna && anggota.pengguna.nama && anggota.is_anggota_perpus) {
                            // Menyaring hasil pencarian jika sudah ada anggota yang dipilih
                            return !selectedAnggotaIds.includes(anggota.nama);
                        }
                        return false; // Jika nama pengguna tidak valid (null atau kosong), anggota tidak dimasukkan
                    });


                    // Jika ada hasil pencarian
                    if (results.length > 0) {
                        var resultsHtml = '';

                        // Loop melalui hasil pencarian dan buat elemen dropdown
                        results.forEach(function(anggota) {
                            resultsHtml += '<a href="javascript:void(0)" class="dropdown-item" onclick="selectAnggotaResult(\'' + anggota.id + '\', \'' + anggota.pengguna_type + '\', \'' + anggota.pengguna.nama + '\', \'' + anggota.pengguna.nama + '\')">' + anggota.pengguna.nama + '</a>';
                        });

                        // Menampilkan hasil pencarian di dropdown
                        $('#searchResultsAnggota').html(resultsHtml).show();
                    } else {
                        // Jika tidak ada hasil, sembunyikan dropdown
                        $('#searchResultsAnggota').html('<a href="javascript:void(0)" class="dropdown-item">Tidak ada hasil yang ditemukan</a>').show();
                    }
                },
                error: function() {
                    // Menangani jika terjadi error pada saat request
                    $('#searchResultsAnggota').html('<a href="javascript:void(0)" class="dropdown-item">Terjadi kesalahan, coba lagi</a>').show();
                }
            });
        });
    });

    function toggleVisibility(id) {
        var cardBody = $("#" + id);
        var icon = $("#icon-" + id);

        // Toggle visibility of the card body
        cardBody.toggle();

        // Change the icon based on visibility
        if (cardBody.is(":visible")) {
            icon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
        } else {
            icon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
        }
    }

    // Fungsi untuk mengambil nilai yang dipilih
    function getSelectedCategories() {
        var selectedCategories = [];
        // Ambil semua checkbox yang memiliki name "kategory[]"
        var checkboxes = document.querySelectorAll('input[name="kategory[]"]:checked');
        checkboxes.forEach(function(checkbox) {
            selectedCategories.push(checkbox.value); // Masukkan value ke dalam array
        });

        // Tampilkan hasil di console (bisa disesuaikan)
        console.log(selectedCategories);

        // Anda bisa mengembalikan nilai ini jika perlu diproses lebih lanjut
        return selectedCategories;
    }

    function listBooks(page = 1, searchQuery = '') {
        // Show loading indicator
        $('#searchResults').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>').show();


        // Mengirimkan request ke API untuk mendapatkan data buku yang sesuai dengan query
        $.ajax({
            url: '{{ env("API_URL") . "/api/perpustakaan/buku" }}', // API URL diambil dari .env
            method: 'GET',
            data: {
                page: page, // Send the page parameter to the API
                search: searchQuery
            },
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                // Hide loading spinner
                $('#searchResults').html(''); // Remove the loading spinner

                // Render the pagination
                renderPagination(response.data);

                // Jika ada hasil pencarian
                if (response.data.items.length > 0) {
                    var resultsHtml = '';

                    // Loop melalui hasil pencarian dan buat elemen dropdown
                    response.data.items.forEach(function(buku) {
                        var images, count_data, btn_data;
                        if (buku.gambar || buku.gambar === null) {
                            images = '{{ env("APP_URL") . "/assets/images/cover-book.png" }}';
                        } else {
                            images = buku.gambar;
                        }

                        //check avilable data
                        if (buku.jumlah_tersedia == 0) {
                            count_data = 'unavailable';
                            btn_data = 'disabled text-white';
                        } else {
                            count_data = 'available';
                            btn_data = '';
                        }

                        // Limit the text of the description
                        var keterangan = buku.keterangan ?? '-';
                        var descriptionLimit = 35; // Set the character limit
                        if (keterangan.length > descriptionLimit) {
                            keterangan = keterangan.substring(0, descriptionLimit) + '...'; // Add ellipsis
                        }

                        // Serialize the buku object
                        var bookString = encodeURIComponent(JSON.stringify(buku));

                        resultsHtml += `
                            <div class="col-sm-4">
                                <div class="card shadow-lg border-0 rounded-3 overflow-hidden ${count_data} card-book">
                                    <div class="card-body book-card-body d-flex">
                                        <!-- Book Cover (left side) -->
                                        <div class="book-cover me-3" style="flex: 0 0 35%; max-width: 35%;">
                                            <img src="${images}" alt="${buku.judul}" class="img-fluid rounded-3 shadow-sm">
                                        </div>

                                        <!-- Book Information (right side) -->
                                        <div class="book-info" style="flex: 1;">
                                            <h5 class="book-title mb-2 text-center fw-bold" style="font-size: 1.25rem;">${buku.judul}</h5>
                                            <p class="card-text book-description text-dark mb-3" style="font-size: 0.95rem;">
                                                ${keterangan ?? 'Tidak ada deskripsi.'}
                                            </p>
                                            <p class="card-text book-text" style="font-size: 1rem; color: black;"><b>Rak :</b> ${buku.rak_kode}</p>
                                            <p class="card-text book-text text-muted" style="font-size: 1rem;">${buku.pengarang.nama}</p>
                                            <p class="card-text book-text text-muted" style="font-size: 0.9rem;">${buku.penerbit.nama} | ${buku.tahun_terbit}</p>

                                            <!-- Genre Badges -->
                                            <div class="mb-2">
                                                ${buku.kategori_buku.map(function(kategori) {
                                                    return `<span class="badge rounded-pill bg-info text-white me-2">${kategori.nama}</span>`;
                                                }).join('')}
                                            </div>

                                            <!-- Availability Status -->
                                            <p class="card-text availability-status ${count_data}" style="font-weight: bold;">
                                                <strong>${buku.jumlah_tersedia} Buku Tersedia</strong>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Pinjam Button (Borrow) -->
                                    <div class="d-flex justify-content-between p-2">
                                        <button type="button" class="btn btn-soft-info rounded-pill btn-sm ${btn_data} w-100 me-2" data-book="${bookString}">Detil</button>
                                        <button type="button" class="btn btn-soft-primary rounded-pill btn-sm ${btn_data} w-100 btn-pinjam" data-book-id="${buku.id}">Pinjam</button>
                                    </div>
                                </div>
                            </div>`;
                    });

                    // After rendering the HTML, attach the event listener
                    // For button detail
                    $(document).on('click', '[data-book]', function() {
                        var bookString = $(this).data('book'); // Get the encoded book string from the data-book attribute
                        var decodedBook = decodeURIComponent(bookString); // Decode the book string
                        showBookDetail(decodedBook); // Pass the decoded string to the showBookDetail function
                    });
                    // For button peminjaman
                    $(document).on('click', '.btn-pinjam', function() {
                        const bookId = $(this).data('book-id'); // Get the book ID from the data attribute
                        borrowBook(bookId);
                    });

                    // Menampilkan hasil pencarian di dropdown
                    $('#searchResults').html(resultsHtml).show();
                } else {
                    // Hide loading spinner
                    $('#searchResults').html('');

                    // Jika tidak ada hasil, sembunyikan dropdown
                    $('#searchResults').html('<a href="javascript:void(0)" class="dropdown-item">Tidak ada hasil yang ditemukan</a>').show();
                }
            },
            error: function() {
                // Menangani jika terjadi error pada saat request
                $('#searchResults').html('<a href="javascript:void(0)" class="dropdown-item">Terjadi kesalahan, coba lagi</a>').show();
            }
        });
    }

    function renderPagination(pagination) {
        var paginationHtml = `
        <div class="row align-items-center mb-3 mt-2">
            <div class="col-sm-6">
                <div>
                    <p class="fs-14 m-0 text-body text-muted">
                        Menampilkan <span class="text-body fw-semibold">${pagination.from}</span> hingga <span class="text-body fw-semibold">${pagination.to}</span> dari <span class="text-body fw-semibold">${pagination.total}</span> data
                    </p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-end">
                    <ul class="pagination pagination-boxed mb-sm-0">`;

        // Previous Page Button
        if (pagination.current_page > 1) {
            paginationHtml += `
        <li class="page-item">
            <a href="javascript:void(0)" class="page-link" data-page="${pagination.current_page - 1}">
                <i class="ti ti-chevron-left"></i>
            </a>
        </li>
        `;
        }

        // Ellipsis if there are more pages before
        if (pagination.current_page - 2 > 1) {
            paginationHtml += `
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        `;
        }

        // Previous Pages and Current Page
        for (let i = Math.max(1, pagination.current_page - 2); i <= Math.min(pagination.last_page, pagination.current_page + 2); i++) {
            paginationHtml += `
        <li class="page-item ${i === pagination.current_page ? 'active' : ''}">
            <a href="javascript:void(0)" class="page-link" data-page="${i}">${i}</a>
        </li>
        `;
        }

        // Ellipsis if there are more pages after
        if (pagination.current_page + 2 < pagination.last_page) {
            paginationHtml += `
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        `;
        }

        // Next Page Button
        if (pagination.current_page < pagination.last_page) {
            paginationHtml += `
        <li class="page-item">
            <a href="javascript:void(0)" class="page-link" data-page="${pagination.current_page + 1}">
                <i class="ti ti-chevron-right"></i>
            </a>
        </li>
        `;
        }

        paginationHtml += `
                    </ul>
                </div>
            </div>
        </div>`;

        // Insert the pagination into the page (replace '#pagination' with the actual container)
        $('#pagination').html(paginationHtml);

        // Attach click events to pagination links
        $('.page-link').on('click', function() {
            var page = $(this).data('page');
            listBooks(page); // Call listBooks with the clicked page number
        });
    }

    // Function to open the modal and show the book details
    function showBookDetail(bookString) {
        // Parse the decoded JSON string
        const book = JSON.parse(bookString);

        // Populate the modal with the book details
        $('#book-cover').attr('src', book.gambar || '{{ env("APP_URL") . "/assets/images/cover-book.png" }}'); // Default cover if no image
        $('#book-title').text(book.judul);
        $('#book-author').text(book.pengarang.nama);
        $('#book-publisher').text(book.penerbit.nama);
        $('#book-year').text(book.tahun_terbit);
        $('#book-description').text(book.keterangan || 'Tidak ada deskripsi.');
        $('#book-rak').text(book.rak_kode);

        // Create category badges
        let categoriesHtml = '';
        book.kategori_buku.forEach(function(kategori) {
            categoriesHtml += `<span class="badge rounded-pill bg-info text-white me-2">${kategori.nama}</span>`;
        });
        $('#book-categories').html(categoriesHtml);

        // Show the modal
        $('#bookDetailModal').modal('show');
    }

    // Function to check if a session exists (e.g., user logged in)
    function checkSession() {
        // Replace with session or cookie check as needed
        let session = sessionStorage.getItem("userSession"); // Or use cookies

        return session !== null; // Return true if the session exists
    }

    // Function to borrow a book
    function borrowBook(bookId) {
        if (checkSession()) {
            alert('Update Buku');
            // If session exists, proceed with borrowing the book via API
            // $.ajax({
            //     url: '/api/peminjaman', // Replace with your borrowing API endpoint
            //     method: 'POST',
            //     data: {
            //         bookId: bookId, // Book ID to borrow
            //         token: sessionStorage.getItem("userSession") // Session token
            //     },
            //     success: function(response) {
            //         // Handle successful book borrowing
            //         alert("Book borrowed successfully!");
            //     },
            //     error: function(error) {
            //         // Handle error in borrowing
            //         alert("An error occurred. Please try again.");
            //     }
            // });
        } else {
            // If session doesn't exist, show the member modal
            $('#memberModal').modal('show');
        }
    }

    function selectAnggotaResult(id, pengguna_type, nama, nisn, foto) {
        // Pastikan ID anggota tidak sudah ada di kartu
        if (!selectedAnggotaIds.includes(id)) {
            // Menambahkan ID ke dalam selectedAnggotaIds
            selectedAnggotaIds.push(nama);

            // Menampilkan foto dan data anggota yang dipilih dalam kartu
            $('#anggotaFoto').attr('src', foto); // Set Foto Anggota
            $('#anggotaNama').text(nama); // Set Nama Anggota
            $('#anggotaNisn').text("NISN: " + nisn); // Set NISN

            // Menampilkan kartu anggota
            $('#anggotaCard').show();

            // Menyimpan ID anggota yang dipilih ke input hidden (readonly input)
            $('#id_anggota').val(id); // Mengisi input dengan ID anggota yang dipilih

            // Kosongkan input dan sembunyikan dropdown
            $('#cari_anggota').val('');
            $('#searchResultsAnggota').html('').hide();
        }
    }
</script>
@endsection