@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card-anim:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(0, 123, 255, 0.1);
        font-size: 24px;
    }

    .text-blue {
        color: #007bff;
    }

    .text-green {
        color: #28a745;
    }

    .text-orange {
        color: #fd7e14;
    }

    .text-purple {
        color: #6f42c1;
    }
</style>

<div class="page-container">

    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">
        <!-- Tahun Ajaran -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M4 11h16" />
                            <path d="M7 14h.013" />
                            <path d="M10.01 14h.005" />
                            <path d="M13.01 14h.005" />
                            <path d="M16.015 14h.005" />
                            <path d="M13.015 17h.005" />
                            <path d="M7.01 17h.005" />
                            <path d="M10.01 17h.005" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Tahun Ajaran</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-blue">2024/2025</h2>
                    <p class="text-muted mb-0">Tahun Ajaran Saat Ini</p>
                </div>
            </div>
        </div>

        <!-- Guru -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Guru</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-green" data-plugin="counterup">120</h2>
                    <p class="text-muted mb-0">Total Guru</p>
                </div>
            </div>
        </div>

        <!-- Siswa -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Siswa</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-orange" data-plugin="counterup">2,300</h2>
                    <p class="text-muted mb-0">Total Siswa</p>
                </div>
            </div>
        </div>

        <!-- Orang Tua/Wali -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Orang Tua/Wali</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-purple" data-plugin="counterup">4,500</h2>
                    <p class="text-muted mb-0">Total Orang Tua/Wali</p>
                </div>
            </div>
        </div>

    </div><!-- end row -->

    <div class="row">
        <div class="col-xxl-7 col-xl-8">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center border-bottom border-dashed">
                    <h4 class="header-title">Data Siswa Tahunan</h4>
                </div>

                <div class="card-body p-0 pt-1 mb-2">
                    <div dir="ltr" class="px-1">
                        <div id="statistics-chart" class="apex-charts" data-colors="#188ae2"></div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xxl-5 col-xl-4">
            <div class="card" hidden>
                <div class="card-body">
                    <button class="btn btn-primary w-100" id="btn-new-event">
                        <i class="ti ti-plus me-2 align-middle"></i> Create New Event
                    </button>

                    <div id="external-events" class="mt-2">
                        <p class="text-muted">Drag and drop your event or click in the calendar</p>
                        <div class="external-event fc-event bg-success-subtle text-success"
                            data-class="bg-success-subtle">
                            <i class="ti ti-circle-filled me-2"></i>New Event Planning
                        </div>
                        <div class="external-event fc-event bg-info-subtle text-info"
                            data-class="bg-info-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Meeting
                        </div>
                        <div class="external-event fc-event bg-warning-subtle text-warning"
                            data-class="bg-warning-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Generating Reports
                        </div>
                        <div class="external-event fc-event bg-danger-subtle text-danger"
                            data-class="bg-danger-subtle">
                            <i class="ti ti-circle-filled me-2"></i>Create New theme
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->

</div> <!-- container -->

<!-- Add New Event MODAL -->
<div class="modal fade" id="event-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="needs-validation" name="event-form" id="forms-event" novalidate>
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">
                        Create Event
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2">
                                <label class="control-label form-label" for="event-title">Event
                                    Name</label>
                                <input class="form-control" placeholder="Insert Event Name" type="text"
                                    name="title" id="event-title" required />
                                <div class="invalid-feedback">Please provide a valid event name</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label class="control-label form-label"
                                    for="event-category">Category</label>
                                <select class="form-select" name="category" id="event-category"
                                    required>
                                    <option value="bg-primary">Blue</option>
                                    <option value="bg-secondary">Gray Dark</option>
                                    <option value="bg-success">Green</option>
                                    <option value="bg-info">Cyan</option>
                                    <option value="bg-warning">Yellow</option>
                                    <option value="bg-danger">Red</option>
                                    <option value="bg-dark">Dark</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid event category</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button type="button" class="btn btn-danger" id="btn-delete-event">
                            Delete
                        </button>

                        <button type="button" class="btn btn-light ms-auto" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit" class="btn btn-primary" id="btn-save-event">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end modal-content-->
    </div>
    <!-- end modal dialog-->
</div>
<!-- end modal-->

@endsection

@section('javascript_custom')
<script>
    class CalendarSchedule {
        constructor() {
            (this.body = document.body),
            (this.modal = new bootstrap.Modal(
                document.getElementById("event-modal"), {
                    backdrop: "static"
                }
            )),
            (this.calendar = document.getElementById("calendar")),
            (this.formEvent = document.getElementById("forms-event")),
            (this.btnNewEvent = document.getElementById("btn-new-event")),
            (this.btnDeleteEvent = document.getElementById("btn-delete-event")),
            (this.btnSaveEvent = document.getElementById("btn-save-event")),
            (this.modalTitle = document.getElementById("modal-title")),
            (this.calendarObj = null),
            (this.selectedEvent = null),
            (this.newEventData = null);
        }
        // onEventClick(e) {
        //     this.formEvent?.reset(),
        //         this.formEvent.classList.remove("was-validated"),
        //         (this.newEventData = null),
        //         (this.btnDeleteEvent.style.display = "block"),
        //         (this.modalTitle.text = "Edit Event"),
        //         this.modal.show(),
        //         (this.selectedEvent = e.event),
        //         (document.getElementById("event-title").value =
        //             this.selectedEvent.title),
        //         (document.getElementById("event-category").value =
        //             this.selectedEvent.classNames[0]);
        // }
        // onSelect(e) {
        //     this.formEvent?.reset(),
        //         this.formEvent?.classList.remove("was-validated"),
        //         (this.selectedEvent = null),
        //         (this.newEventData = e),
        //         (this.btnDeleteEvent.style.display = "none"),
        //         (this.modalTitle.text = "Add New Event"),
        //         this.modal.show(),
        //         this.calendarObj.unselect();
        // }
        init() {
            let e = new Date(),
                a = this;
            var t = document.getElementById("external-events"),
                t = (new FullCalendar.Draggable(t, {
                        itemSelector: ".external-event",
                        eventData: function(e) {
                            return {
                                title: e.innerText,
                                classNames: e.getAttribute("data-class"),
                            };
                        },
                    }),
                    [{
                            title: "Interview - Backend Engineer",
                            start: e,
                            end: e,
                            className: "bg-primary",
                        },
                        {
                            title: "Meeting with CT Team",
                            start: new Date(Date.now() + 13e6),
                            end: e,
                            className: "bg-warning",
                        },
                        {
                            title: "Meeting with Mr. Admin",
                            start: new Date(Date.now() + 308e6),
                            end: new Date(Date.now() + 338e6),
                            className: "bg-info",
                        },
                        {
                            title: "Interview - Frontend Engineer",
                            start: new Date(Date.now() + 6057e4),
                            end: new Date(Date.now() + 153e6),
                            className: "bg-secondary",
                        },
                        {
                            title: "Phone Screen - Frontend Engineer",
                            start: new Date(Date.now() + 168e6),
                            className: "bg-success",
                        },
                        {
                            title: "Buy Design Assets",
                            start: new Date(Date.now() + 33e7),
                            end: new Date(Date.now() + 3308e5),
                            className: "bg-primary",
                        },
                        {
                            title: "Setup Github Repository",
                            start: new Date(Date.now() + 1008e6),
                            end: new Date(Date.now() + 1108e6),
                            className: "bg-danger",
                        },
                        {
                            title: "Meeting with Mr. Shreyu",
                            start: new Date(Date.now() + 2508e6),
                            end: new Date(Date.now() + 2508e6),
                            className: "bg-dark",
                        },
                    ]);
            (a.calendarObj = new FullCalendar.Calendar(a.calendar, {
                plugins: [],
                locale: 'id', // Menggunakan bahasa Indonesia
                slotDuration: "00:30:00",
                slotMinTime: "07:00:00",
                slotMaxTime: "19:00:00",
                themeSystem: "bootstrap",
                bootstrapFontAwesome: !1,
                buttonText: {
                    today: "Hari Ini",
                    // year: "Year",
                    month: "Bulan",
                    // week: "Week",
                    // day: "Day",
                    // list: "List",
                    // prev: "Prev",
                    // next: "Next",
                },
                initialView: "dayGridMonth",
                handleWindowResize: !0,
                height: window.innerHeight - 200,
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth"
                },
                initialEvents: t,
                editable: !0,
                droppable: !0,
                selectable: !0,
                dateClick: function(e) {
                    a.onSelect(e);
                },
                eventClick: function(e) {
                    a.onEventClick(e);
                },
            })),
            a.calendarObj.render(),
                a.btnNewEvent.addEventListener("click", function(e) {
                    a.onSelect({
                        date: new Date(),
                        allDay: !0
                    });
                }),
                a.formEvent?.addEventListener("submit", function(e) {
                    e.preventDefault();
                    var t,
                        n = a.formEvent;
                    n.checkValidity() ?
                        (a.selectedEvent ?
                            (a.selectedEvent.setProp(
                                    "title",
                                    document.getElementById("event-title").value
                                ),
                                a.selectedEvent.setProp(
                                    "classNames",
                                    document.getElementById("event-category").value
                                )) :
                            ((t = {
                                    title: document.getElementById("event-title")
                                        .value,
                                    start: a.newEventData.date,
                                    allDay: a.newEventData.allDay,
                                    className: document.getElementById("event-category")
                                        .value,
                                }),
                                a.calendarObj.addEvent(t)),
                            a.modal.hide()) :
                        (e.stopPropagation(), n.classList.add("was-validated"));
                }),
                a.btnDeleteEvent.addEventListener("click", function(e) {
                    a.selectedEvent &&
                        (a.selectedEvent.remove(),
                            (a.selectedEvent = null),
                            a.modal.hide());
                });
        }
    }
    document.addEventListener("DOMContentLoaded", function(e) {
        new CalendarSchedule().init();
    });

    var colors = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
        dataColors = $("#total-orders-chart").data("colors"),
        options1 = {
            series: [65],
            chart: {
                type: "radialBar",
                height: 81,
                width: 81,
                sparkline: {
                    enabled: !1
                },
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    hollow: {
                        margin: 0,
                        size: "50%"
                    },
                    dataLabels: {
                        name: {
                            show: !1
                        },
                        value: {
                            offsetY: 5,
                            fontSize: "14px",
                            fontWeight: "600",
                            formatter: function(o) {
                                return o + "k";
                            },
                        },
                    },
                },
            },
            grid: {
                padding: {
                    top: -18,
                    bottom: -20,
                    left: -20,
                    right: -20
                }
            },
            colors: (colors = dataColors ? dataColors.split(",") : colors),
        },
        colors =
        (new ApexCharts(
                document.querySelector("#total-orders-chart"),
                options1
            ).render(),
            ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]),
        dataColors = $("#new-users-chart").data("colors"),
        options2 = {
            series: [75],
            chart: {
                type: "radialBar",
                height: 81,
                width: 81,
                sparkline: {
                    enabled: !1
                },
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    hollow: {
                        margin: 0,
                        size: "50%"
                    },
                    dataLabels: {
                        name: {
                            show: !1
                        },
                        value: {
                            offsetY: 5,
                            fontSize: "14px",
                            fontWeight: "600",
                            formatter: function(o) {
                                return o + "k";
                            },
                        },
                    },
                },
            },
            grid: {
                padding: {
                    top: -18,
                    bottom: -20,
                    left: -20,
                    right: -20
                }
            },
            colors: (colors = dataColors ? dataColors.split(",") : colors),
        },
        colors =
        (new ApexCharts(
                document.querySelector("#new-users-chart"),
                options2
            ).render(),
            ["#5b69bc", "#35b8e0", "#10c469", "#fa5c7c", "#e3eaef"]),
        dataColors = $("#data-visits-chart").data("colors"),
        options = {
            chart: {
                height: 277,
                type: "donut"
            },
            series: [65, 14, 10, 45],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7,
            },
            labels: ["Direct", "Social", "Marketing", "Affiliates"],
            colors: (colors = dataColors ? dataColors.split(",") : colors),
            stroke: {
                show: !1
            },
        },
        chart = new ApexCharts(
            document.querySelector("#data-visits-chart"),
            options
        ),
        colors = (chart.render(), ["#5b69bc", "#10c469", "#fa5c7c", "#f9c851"]),
        dataColors = $("#statistics-chart").data("colors"),
        options = {
            series: [{
                name: "Open Campaign",
                type: "bar",
                data: [89.25, 98.58, 68.74, 108.87, 77.54, 84.03, 51.24],
            }, ],
            chart: {
                height: 301,
                type: "line",
                toolbar: {
                    show: !1
                }
            },
            stroke: {
                width: 0,
                curve: "smooth"
            },
            plotOptions: {
                bar: {
                    columnWidth: "20%",
                    barHeight: "70%",
                    borderRadius: 5
                },
            },
            xaxis: {
                categories: [
                    "2019",
                    "2020",
                    "2021",
                    "2022",
                    "2023",
                    "2024",
                    "2025",
                ],
            },
            colors: (colors = dataColors ? dataColors.split(",") : colors),
        },
        colors =
        ((chart = new ApexCharts(
                document.querySelector("#statistics-chart"),
                options
            )).render(),
            ["#5b69bc", "#10c469", "#fa5c7c", "#f9c851"]),
        dataColors = $("#revenue-chart").data("colors"),
        options = {
            series: [{
                    name: "Total Income",
                    data: [82, 85, 70, 90, 75, 78, 65, 50, 72, 60, 80, 70],
                },
                {
                    name: "Total Expenses",
                    data: [30, 32, 40, 35, 30, 36, 37, 28, 34, 42, 38, 30],
                },
            ],
            stroke: {
                width: 3,
                curve: "straight"
            },
            chart: {
                height: 299,
                type: "line",
                zoom: {
                    enabled: !1
                },
                toolbar: {
                    show: !1
                },
            },
            dataLabels: {
                enabled: !1
            },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
            colors: (colors = dataColors ? dataColors.split(",") : colors),
            tooltip: {
                shared: !0,
                y: [{
                        formatter: function(o) {
                            return void 0 !== o ? "$" + o.toFixed(2) + "k" : o;
                        },
                    },
                    {
                        formatter: function(o) {
                            return void 0 !== o ? "$" + o.toFixed(2) + "k" : o;
                        },
                    },
                ],
            },
        };
    (chart = new ApexCharts(
        document.querySelector("#revenue-chart"),
        options
    )).render();
</script>
@endsection