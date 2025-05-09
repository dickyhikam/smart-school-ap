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
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('kategori')">
                    <h4 class="mb-0">
                        Kategori
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-kategori"></i>
                </div>
                <div class="card-body" id="kategori" style="display: none;">
                    <!-- Content for Kategori -->
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('penerbit')">
                    <h4 class="mb-0">
                        Penerbit
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-penerbit"></i>
                </div>
                <div class="card-body" id="penerbit" style="display: none;">
                    <!-- Content for Penerbit -->
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('pengarang')">
                    <h4 class="mb-0">
                        Pengarang
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-pengarang"></i>
                </div>
                <div class="card-body" id="pengarang" style="display: none;">
                    <!-- Content for Pengarang -->
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center" onclick="toggleVisibility('tahun')">
                    <h4 class="mb-0">
                        Tahun Terbit
                    </h4>
                    <i class="fas fa-chevron-down toggle-icon" id="icon-tahun"></i>
                </div>
                <div class="card-body" id="tahun" style="display: none;">
                    <!-- Content for Tahun Terbit -->
                </div>
            </div>

            <!-- Peminjam Card (Borrower Card) -->
            <div class="card peminjam-card border-0 rounded-3 overflow-hidden">
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
            <div class="row">

                <div class="col-sm-4">
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

                <div class="col-sm-4">
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
        </div>
    </div>
</div>
@endsection

@section('javascript_custom')
<script>
    // Custom JavaScript for handling show/hide functionality
    $(document).ready(function() {
        // Any custom JS actions you want to trigger when the page loads
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
</script>
@endsection