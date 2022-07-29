// button tanggal click
let waktu;


$('.filter-btn input').on('click', function () {
    waktu = $(this).attr('value');

    $('.pembungkus-card .card').each(function () {
        let idCard = $(this).attr('id');

        // ambil semua statistik
        // ambil id button pertama
        let idCategory = $('#' + idCard + ' button').attr('value');
        let idChart = $('#' + idCard + ' canvas').attr('id');
        let data = {
            id_category: idCategory,
            wktu: waktu
        };
        $.ajax({
            url: 'http://localhost/estatemanager/dashboard/updateChart',
            method: 'POST',
            data: data,
            type: JSON,
            cache: false,
            success: function (data) {
                // border color chart
                let borderColorChart = 'rgb(240, 68, 56)';
                let fillColorChart = 'rgba(255, 0, 0, 0.1)';

                data = JSON.parse(data);
                // logic persentase turunin persen
                if (waktu == '1hr') {
                    let totalPersen = 100;
                    totalPersen = totalPersen - data.total;
                    $('#' + idCard + ' h3').html(totalPersen + ' %');
                } else if (waktu == '7hr') {
                    let totalPersen = 700;
                    totalPersen = totalPersen - data.total;
                    totalPersen = Math.round(totalPersen / 7);
                    $('#' + idCard + ' h3').html(totalPersen + ' %');
                } else if (waktu == '30hr') {
                    let totalPersen = 3000;
                    totalPersen = totalPersen - data.total;
                    totalPersen = Math.round(totalPersen / 30);
                    $('#' + idCard + ' h3').html(totalPersen + ' %');
                } else {
                    let totalPersen = 36000;
                    totalPersen = totalPersen - data.total;
                    totalPersen = Math.round(totalPersen / 360);
                    $('#' + idCard + ' h3').html(totalPersen + ' %');
                }

                // logic chart
                let jamSekarang1;
                let jamSekarang2;
                let jamSekarang3;
                let jamSekarang4;

                // data untuk chart
                if (waktu == '1hr') {
                    jamSekarang1 = 100 - data.jam_sekarang_1;
                    jamSekarang2 = 100 - data.jam_sekarang_2;
                    jamSekarang3 = 100 - data.jam_sekarang_3;
                    jamSekarang4 = 100 - data.jam_sekarang_4;
                } else if (waktu == '7hr') {
                    jamSekarang1 = 175 - data.jam_sekarang_1;
                    jamSekarang2 = 175 - data.jam_sekarang_2;
                    jamSekarang3 = 175 - data.jam_sekarang_3;
                    jamSekarang4 = 175 - data.jam_sekarang_4;
                } else if (waktu == '30hr') {
                    jamSekarang1 = 750 - data.jam_sekarang_1;
                    jamSekarang2 = 750 - data.jam_sekarang_2;
                    jamSekarang3 = 750 - data.jam_sekarang_3;
                    jamSekarang4 = 750 - data.jam_sekarang_4;
                } else {
                    jamSekarang1 = 9000 - data.jam_sekarang_1;
                    jamSekarang2 = 9000 - data.jam_sekarang_2;
                    jamSekarang3 = 9000 - data.jam_sekarang_3;
                    jamSekarang4 = 9000 - data.jam_sekarang_4;
                }

                // logic untuk merubah chart
                if (waktu == '1hr') {
                    if (jamSekarang1 == 100 && jamSekarang2 == 100 && jamSekarang3 == 100 && jamSekarang4 == 100) {
                        borderColorChart = 'rgb(67, 240, 56)';
                        fillColorChart = 'rgba(35, 240, 9, 0.1)'
                        $('#' + idCard + ' p' + '#' + idCard).remove();
                        $('#' + idCard + ' object').remove();
                    }
                } else if (waktu == '7hr') {
                    if (jamSekarang1 == 175 && jamSekarang2 == 175 && jamSekarang3 == 175 && jamSekarang4 == 175) {
                        borderColorChart = 'rgb(67, 240, 56)';
                        fillColorChart = 'rgba(35, 240, 9, 0.1)'
                        $('#' + idCard + ' p' + '#' + idCard).remove();
                        $('#' + idCard + ' object').remove();
                    }
                } else if (waktu == '30hr') {
                    if (jamSekarang1 == 750 && jamSekarang2 == 750 && jamSekarang3 == 750 && jamSekarang4 == 750) {
                        borderColorChart = 'rgb(67, 240, 56)';
                        fillColorChart = 'rgba(35, 240, 9, 0.1)'
                        $('#' + idCard + ' p' + '#' + idCard).remove();
                        $('#' + idCard + ' object').remove();
                    }
                } else if (waktu == '12bln') {
                    if (jamSekarang1 == 9000 && jamSekarang2 == 9000 && jamSekarang3 == 9000 && jamSekarang4 == 9000) {
                        borderColorChart = 'rgb(67, 240, 56)';
                        fillColorChart = 'rgba(35, 240, 9, 0.1)'
                        $('#' + idCard + ' p' + '#' + idCard).remove();
                        $('#' + idCard + ' object').remove();
                    }
                }


                $('#' + idCard + ' div' + '#' + idCard + ' p').html(data.nama_kontraktor);

                // cek objek chart ada atau tidak, jika tidak destroy
                let ctx = document.getElementById(idChart).getContext('2d');
                var chartExist = Chart.getChart(idChart);
                if (chartExist != undefined) chartExist.destroy();

                let myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [4, 3, 2, 1],
                        datasets: [{
                            label: '',
                            data: [jamSekarang4, jamSekarang3, jamSekarang2, jamSekarang1],
                            fill: {
                                target: "origin", // 3. Set the fill options
                                above: fillColorChart
                            },
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: borderColorChart,
                            borderWidth: 1,
                            pointRadius: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        elements: {
                            line: {
                                tension: 0.5
                            }
                        },
                        scales: {
                            x: {
                                display: false,
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                display: false,
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                    }
                });
            }
        });

    });
});


// initialized data dan chartnya
$(document).ready(function () {
    $('.pembungkus-card .card').each(function () {
        let idCard = $(this).attr('id');

        // ambil semua statistik
        // ambil id button pertama
        let idCategory = $('#' + idCard + ' button').attr('value');
        let idChart = $('#' + idCard + ' canvas').attr('id');
        let data = {
            id_category: idCategory,
            wktu: '1hr'
        };
        $.ajax({
            url: 'http://localhost/estatemanager/dashboard/updateChart',
            method: 'POST',
            data: data,
            type: JSON,
            cache: false,
            success: function (data) {
                // border color chart
                let borderColorChart = 'rgb(240, 68, 56)';
                let fillColorChart = 'rgba(255, 0, 0, 0.1)';

                // turunin persen
                data = JSON.parse(data);
                let totalPersen = 100;
                totalPersen = totalPersen - data.total;
                $('#' + idCard + ' h3').html(totalPersen + ' %');

                // logic persentase per jam
                let jamSekarang1 = 100 - data.jam_sekarang_1;
                let jamSekarang2 = 100 - data.jam_sekarang_2;
                let jamSekarang3 = 100 - data.jam_sekarang_3;
                let jamSekarang4 = 100 - data.jam_sekarang_4;

                if (jamSekarang1 == 100 && jamSekarang2 == 100 && jamSekarang3 == 100 && jamSekarang4 == 100) {
                    borderColorChart = 'rgb(67, 240, 56)';
                    fillColorChart = 'rgba(35, 240, 9, 0.1)'
                    $('#' + idCard + ' p' + '#' + idCard).remove();
                    $('#' + idCard + ' object').remove();
                }

                $('#' + idCard + ' div' + '#' + idCard + ' p').html(data.nama_kontraktor);

                // cek objek chart ada atau tidak, jika tidak destroy
                let ctx = document.getElementById(idChart).getContext('2d');
                var chartExist = Chart.getChart(idChart);
                if (chartExist != undefined) chartExist.destroy();

                let myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [4, 3, 2, 1],
                        datasets: [{
                            label: '',
                            data: [jamSekarang4, jamSekarang3, jamSekarang2, jamSekarang1],
                            fill: {
                                target: "origin", // 3. Set the fill options
                                above: fillColorChart
                            },
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: borderColorChart,
                            borderWidth: 1,
                            pointRadius: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        elements: {
                            line: {
                                tension: 0.5
                            }
                        },
                        scales: {
                            x: {
                                display: false,
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                display: false,
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                    }
                });
            }
        });

    });
});

let idCard;

$('.btn-click').on('click', function () {
    idCard = $(this).attr('value');
});

// ubah data saat dropdown di click
$('li').on('click', function () {
    let id = $(this).attr('value');

    let idChart = $('#' + idCard + ' canvas').attr('id');
    if (waktu == undefined) {
        waktu = '1hr';
    }
    let data = {
        id_category: id,
        wktu: waktu
    };
    console.log(id);
    $.ajax({
        url: 'http://localhost/estatemanager/dashboard/updateChart',
        method: 'POST',
        data: data,
        type: JSON,
        cache: false,
        success: function (data) {

            // border color chart
            let borderColorChart = 'rgb(240, 68, 56)';
            let fillColorChart = 'rgba(255, 0, 0, 0.1)';

            // turunin persen
            data = JSON.parse(data);
            let totalPersen = 100;
            totalPersen = totalPersen - data.total;
            $('#' + idCard + ' h3').html(totalPersen + ' %');

            // ubah nama kategori
            console.log('idcarddddd' + idCard);
            $('.btn-group button#' + idCard).html(data.nama_kategori);

            // ubah value button dropdown ini berdasarkan id dropdown baru
            $('.btn-group button#' + idCard).val(id);


            // ubah nama kontraktor
            $('#' + idCard + ' div' + '#card' + idCard + ' p').html(data.nama_kontraktor);

            // logic persentase per jam
            let jamSekarang1 = 100 - data.jam_sekarang_1;
            let jamSekarang2 = 100 - data.jam_sekarang_2;
            let jamSekarang3 = 100 - data.jam_sekarang_3;
            let jamSekarang4 = 100 - data.jam_sekarang_4;

            if (jamSekarang1 == 100 && jamSekarang2 == 100 && jamSekarang3 == 100 && jamSekarang4 == 100) {
                borderColorChart = 'rgb(67, 240, 56)';
                fillColorChart = 'rgba(35, 240, 9, 0.1)'
                $('#' + idCard + ' p' + '#' + idCard).hide();
                $('#' + idCard + ' object').hide();
            } else {
                $('#' + idCard + ' p' + '#' + idCard).html(totalPersen + '%');
                $('#' + idCard + ' object').html('<object data="<?= BASE_URL; ?>/img/icon/arrow-down.svg"></object>t');
                $('#' + idCard + ' p' + '#' + idCard).show();
                $('#' + idCard + ' object').show();
            }

            $('#' + idCard + ' div' + '#' + idCard + ' p').html(data.nama_kontraktor);

            // cek apakah objek chart sudah pernah dibuat apa belum jika sudah destroy
            let ctx = document.getElementById(idChart).getContext('2d');
            var chartExist = Chart.getChart(idChart); // <canvas> id
            if (chartExist != undefined) chartExist.destroy();

            // initialize char
            let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['4', '3', '2', '1'],
                    datasets: [{
                        label: '',
                        data: [jamSekarang4, jamSekarang3, jamSekarang2, jamSekarang1],
                        fill: {
                            target: "origin", // 3. Set the fill options
                            above: fillColorChart
                        },
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: borderColorChart,
                        borderWidth: 1,
                        pointRadius: 0,
                    }]
                },
                options: {
                    responsive: true,
                    elements: {
                        line: {
                            tension: 0.5
                        }
                    },
                    scales: {
                        x: {
                            display: false,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            display: false,
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                }
            });
        }
    });
})

// tampilkan data chart saat kategori di klik
// $('.btn-click').on('click', function () {
//     const idCard = $(this).attr('value');

//     $('li').on('click', function (event) {
//         let id = $(this).attr('value');
//         let idChart = $('#' + idCard + ' canvas').attr('id');
//         let data = 'id_category=' + id;
//         // console.log(idCard);

//         $.ajax({
//             url: 'http://localhost/estatemanager/dashboard/updateChart',
//             method: 'POST',
//             data: data,
//             type: JSON,
//             cache: false,
//             success: function (data) {
//                 // turunin persen
//                 data = JSON.parse(data);
//                 let totalPersen = 100;
//                 totalPersen = totalPersen - data.total;
//                 // $('#' + idCard + ' h3').html(totalPersen + ' %');

//                 // ubah nama kategori
//                 // $('.btn-group #card' + idCard).html(data.nama_kategori);

//                 // ubah nama kontraktor
//                 $('#' + idCard + ' div' + '#' + idCard + ' p').html(data.nama_kontraktor);

//                 // logic persentase per jam
//                 let jamSekarang1 = 100 - data.jam_sekarang_1;
//                 let jamSekarang2 = 100 - data.jam_sekarang_2;
//                 let jamSekarang3 = 100 - data.jam_sekarang_3;
//                 let jamSekarang4 = 100 - data.jam_sekarang_4;
//                 // console.log(data);

//                 // cek apakah objek chart sudah pernah dibuat apa belum jika sudah destroy
//                 // let ctx = document.getElementById(idChart).getContext('2d');
//                 // var chartExist = Chart.getChart(idChart); // <canvas> id
//                 // if (chartExist != undefined) chartExist.destroy();

//                 // // initialize char
//                 // let myChart = new Chart(ctx, {
//                 //     type: 'line',
//                 //     data: {
//                 //         labels: ['4', '3', '2', '1'],
//                 //         datasets: [{
//                 //             label: '',
//                 //             data: [jamSekarang4, jamSekarang3, jamSekarang2, jamSekarang1],
//                 //             fill: {
//                 //                 target: "origin", // 3. Set the fill options
//                 //                 above: "rgba(255, 0, 0, 0.1)"
//                 //             },
//                 //             backgroundColor: 'rgb(255, 99, 132)',
//                 //             borderColor: 'rgb(240, 68, 56)',
//                 //             borderWidth: 1,
//                 //             pointRadius: 0,
//                 //         }]
//                 //     },
//                 //     options: {
//                 //         responsive: true,
//                 //         elements: {
//                 //             line: {
//                 //                 tension: 0.5
//                 //             }
//                 //         },
//                 //         scales: {
//                 //             x: {
//                 //                 display: false,
//                 //                 grid: {
//                 //                     display: false
//                 //                 }
//                 //             },
//                 //             y: {
//                 //                 display: false,
//                 //                 grid: {
//                 //                     display: false
//                 //                 }
//                 //             }
//                 //         },
//                 //         plugins: {
//                 //             legend: {
//                 //                 display: false
//                 //             }
//                 //         },
//                 //     }
//                 // });
//             }
//         });

//         // $('html[manifest=saveappoffline.appcache]').attr('content', '');
//     });
// });
