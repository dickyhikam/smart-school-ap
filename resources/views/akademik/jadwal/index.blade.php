@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<style>
    .scroll-container {
        overflow-x: auto;
        /* Enables horizontal scrolling */
        -webkit-overflow-scrolling: touch;
        /* Smooth scrolling on mobile */
        padding: 10px 0;
        /* Optional: Adds vertical space around the nav */
    }

    .scroll-container::-webkit-scrollbar {
        height: 8px;
        /* Sets the height of the scrollbar */
    }

    .scroll-container::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.3);
        /* Custom color for the scrollbar thumb */
        border-radius: 10px;
    }

    .scroll-container::-webkit-scrollbar-track {
        background-color: rgba(0, 0, 0, 0.1);
        /* Custom color for the scrollbar track */
    }
</style>
<div class="page-container">

    <!-- Tabel Data Orang Tua/Wali -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-column py-2">
                <div class="d-flex justify-content-between w-100 mb-3">
                    <!-- Tombol Kiri -->
                    <a id="prev-btn" class="btn btn-outline-info {{ $tahun_ajaran_prev == '' ? 'disabled' : '' }}" data-bs-toggle="tooltip" title="Tahun Ajaran Sebelumnya" href="{{ $tahun_ajaran_prev == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_prev }}">
                        <svg id="prev-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 6l-6 6l6 6v-12" />
                        </svg>
                    </a>

                    <!-- Judul dan Garis Header -->
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <h2 class="font-weight-bold text-uppercase mb-1 {{ $tahun_ajaran_status == 'Aktif' ? 'text-success' : 'text-danger' }}"
                            style="font-size: 40px; letter-spacing: 3px; transition: all 0.3s ease;">
                            {{ $tahun_ajaran }}
                        </h2>
                        <div class="line-header mb-1" style="width: 50px; height: 4px; background-color: <?= $tahun_ajaran_status == 'Aktif' ? '#28a745' : '#dc3545' ?>;">
                        </div>
                        <span class="badge {{ $tahun_ajaran_status == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                            Tahun ajaran sedang {{ $tahun_ajaran_status }}
                        </span>
                    </div>

                    <!-- Tombol Kanan -->
                    <a id="next-btn" class="btn btn-outline-info {{ $tahun_ajaran_next == '' ? 'disabled' : '' }}" data-bs-toggle="tooltip" title="Tahun Ajaran Selanjutnya" href="{{ $tahun_ajaran_next == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_next }}">
                        <svg id="next-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-right">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 18l6 -6l-6 -6v12" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="scroll-container">
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-1 flex-nowrap" role="tablist">
                    @foreach($listSubKelas as $index => $row)
                    <li class="nav-item" role="presentation">
                        <a href="#tableJadwal{{ $index }}" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-3 px-4 py-2 @if($index == 0) active @endif" aria-selected="false" role="tab" tabindex="-1" style="white-space: nowrap; transition: background-color 0.3s ease;">
                            <i class="mdi mdi-home me-2"></i> {{ $row['kelas']['nama'].' '. $row['jurusan']['nama'].' '. $row['nama'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content">
                @foreach($listSubKelas as $index => $row)
                <div class="tab-pane @if($index == 0) active show @endif" id="tableJadwal{{ $index }}" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="mdi mdi-account-group me-2"></i> Data {{ $nama_menu }} {{ $row['kelas']['nama'].' '. $row['jurusan']['nama'].' '. $row['nama'] }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div id="calendar{{ $index }}"></div> <!-- Unique calendar ID -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div><!-- end col-->
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus menu ini <b id="deleteModalName"></b>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('actionDeleteTahunAjaran', ['id' => ':id']) }}" method="POST" id="deleteMenuForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKonfirmStatus" tabindex="-1" aria-labelledby="modalKonfirmStatusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmStatusLabel">Konformasi Status Tahun Ajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="statusMessage"></p>
                </div>
                <div class="modal-footer">
                    <form id="statusChangeForm" method="PUT" action="{{ route('actionEditTahunAjaran', ['id' => '']) }}">
                        @csrf
                        <input type="text" name="th_name" id="th_name" readonly>
                        <input type="text" name="is_active" id="is_active" readonly>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    // Initialize calendars when the page is ready
    var calendars = [];
    $(document).ready(function() {
        // Panggil fungsi untuk tombol
        handleButtonClick('prev-btn', 'prev-icon', `{{ $tahun_ajaran_prev == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_prev }}`);
        handleButtonClick('next-btn', 'next-icon', `{{ $tahun_ajaran_next == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_next }}`);

        // calendarShow();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize calendars when the page is ready
        var calendars = [];

        // Function to initialize the calendar for a specific tab
        function initCalendar(index) {
            var calendarEl = document.getElementById('calendar' + index);

            if (calendarEl && !calendars[index]) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    headerToolbar: false,
                    locale: 'id', // Set the locale to Indonesian
                    buttonText: {
                        today: 'Hari ini',
                        month: 'Bulan',
                        week: 'Minggu',
                        day: 'Hari',
                        list: 'Daftar',
                        prev: 'Sebelumnya',
                        next: 'Selanjutnya'
                    },
                    slotLabelFormat: {
                        hour: '2-digit', // Display hours with 2 digits (e.g., 07:00)
                        minute: '2-digit', // Display minutes with 2 digits (e.g., :00)
                        meridiem: false // Don't show AM/PM
                    },
                    allDaySlot: false, // Disable the all-day slot
                    editable: true, // Allow event editing
                    droppable: true, // Allow dragging and dropping of events
                    selectable: true, // Allow selecting time slots
                    dayHeaderFormat: { // Display only the day of the week (e.g., Senin, Selasa)
                        weekday: 'long', // Show the full weekday name (e.g., Senin)
                    },
                    titleFormat: { // Format the title in the header (week range or just the week name)
                        year: 'numeric', // Show the year
                        month: 'long', // Show the month name
                        day: 'numeric', // Show the day number
                    },
                    events: [{
                            title: "Matematika",
                            start: "2025-05-29T07:00:00",
                            end: "2025-05-29T08:00:00"
                        },
                        {
                            title: "Bahasa Indonesia",
                            start: "2025-05-29T08:00:00",
                            end: "2025-05-29T09:00:00"
                        }
                        // Add more events as needed
                    ],
                    select: function(info) {
                        // Format tanggal dan waktu menggunakan toLocaleString
                        var tmstart = info.start.toLocaleString('id-ID', { // Locale Indonesia
                            weekday: 'long', // Day of the week (e.g., Senin)
                            hour: '2-digit', // Hour in 2-digit format (e.g., 07)
                            minute: '2-digit', // Minute in 2-digit format (e.g., 30)
                            hour12: false // 24-hour format
                        });
                        var tmend = info.end.toLocaleString('id-ID', {
                            weekday: 'long',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false
                        });

                        var stdate = info.start.toLocaleString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        });
                        var endate = info.end.toLocaleString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        });
                        if (stdate == endate) {
                            // Trigger modal when a date range is selected
                            alert(tmstart + '|' + tmend);
                        } else {
                            notif_alert('warning', 'Tanggal yang dipilih tidak valid. Pastikan tanggal yang dipilih harus sama.');
                        }


                    }
                });

                calendar.render();
                calendars[index] = calendar; // Store calendar instance for this tab
            }
        }

        // Initialize the first tab (default active)
        initCalendar(0);

        // Listen to Bootstrap tab shown event to initialize the calendar when tab is activated
        var tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
        tabs.forEach(function(tab, index) {
            tab.addEventListener('shown.bs.tab', function() {
                initCalendar(index); // Initialize the calendar when tab is shown
            });
        });
    });
</script>
@endsection