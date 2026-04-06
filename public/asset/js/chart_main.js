function getRandomHexColor() {
  return "#" + Math.floor(Math.random() * 16777215).toString(16);
}


function formatRupiah(val) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(Number(val));
}

function formatPercent(val, digit = 2) {
    return Number(val).toLocaleString('id-ID', {
        minimumFractionDigits: digit,
        maximumFractionDigits: digit
    }) + '%';
}

//===================================== Build Pie Chart
var datasets_pie_ex = [
    {
        percent_amount: "20.029666319264795",
        confirmed_amount: "73480666921.0",
        ordertype: "TOP",
        paymenttype: "Cash", 
        label: "Cash",
    },
    {
        percent_amount: "20.029666319264795",
        confirmed_amount: "73480666921.0",
        ordertype: "TOP",
        paymenttype: "Giro", 
        label: "Giro",
        color_label : "#00aba9"
    },
    {
        percent_amount: "20.029666319264795",
        confirmed_amount: "73480666921.0",
        ordertype: "TOP",
        paymenttype: "Transfer",
        label: "Transfer",

    },
] 
var DATA_CONFIG_FORMAT_PIECHART = {

    el: document.getElementById('IDCHART'),
    datasets: datasets_pie_ex,
    key_value: "confirmed_amount",
    label_color: {
        Giro: "#22C55E",
        Transfer: "#3B82F6",
        Cash: "#F59E0B"
    },
    caption_callback : function( data ){
        return [
            'Total : ' + formatRupiah(data.value),
            'Percent of total : ' + formatPercent(data.percent)
        ]
    },
    datalabels: false //true or false
}

function buildPieChart( DATA_CONFIG = DATA_CONFIG_FORMAT_PIECHART ) {


    //Cek dan validasi method callback 
    if ( typeof DATA_CONFIG.caption_callback != "function" ) {
        DATA_CONFIG.caption_callback = function( data ){
            return DATA_CONFIG_FORMAT_PIECHART.caption_callback( data );
        }
    }

    var el = DATA_CONFIG.el;
    var label_color = DATA_CONFIG.label_color || DATA_CONFIG_FORMAT_PIECHART.label_color;

    var data_label = [];
    var data_value = [];
    var data_background = [];



    //Membuat dataset untuk grafik berdasarakkan formatnya
    for (var i = 0; i < DATA_CONFIG.datasets.length; i++) {

        var row_obj = DATA_CONFIG.datasets[i];
        var label = row_obj.label;
        var value_slice = row_obj[DATA_CONFIG.key_value];

        //Menambahkan untuk label setiap slice
        data_label.push(label);

        //Menambahkan nilai slice di chart
        data_value.push(Number(value_slice));

        //Menambahkan warna pada slice
        var color = label_color.hasOwnProperty(label)
        ? label_color[label]
        : getRandomHexColor();

        data_background.push(color);
    }

    

    // Cek apakah semua value = 0
    var isAllZero = data_value.every(val => val === 0);
    if (isAllZero) {
        data_label = ["No Data"];
        data_value = [1];
        data_background = ["#000"];
    }


    // console.log( "DEBUG COLOR DATA" );
    // console.log( data_background );

    // return false;

    // DATA_CONFIG.datalabels = DATA_CONFIG.datalabels ?? false;

    // if (DATA_CONFIG.datalabels) {
    //     Chart.register(ChartDataLabels);
    // }


    new Chart(el, 
    {
        type: "pie",
        data: {
            labels: data_label,
            datasets: [{
                data: data_value,
                backgroundColor: data_background
            }]
        },
        options: {
            plugins: {
                // Untuk setting label saat di hover dan event callback terkait value per slice
                tooltip: {
                    callbacks: {

                        // Judul tooltip (baris atas)
                        title: function (tooltipItems) {
                            return tooltipItems[0].label;
                        },


                        // Konten utama tooltip
                        label: function (context) {
                            var index_row = context.dataIndex;

                            //Akses informasinya dari datasets berdasarkan row index
                            var row_datasets = DATA_CONFIG.datasets[index_row];
                            var value = row_datasets[DATA_CONFIG.key_value];
                            var percent = Number( row_datasets.percent_amount );//Karena dateng dari backend sourcenya itu bentuknya string

                            var data = {
                                value : value,
                                percent : percent,
                            }

                            var caption = DATA_CONFIG.caption_callback( data ); //Ini callback harus mengembalikan array
                            return caption;

                        }
                    }
                }


            }
        }

    });

}