<!DOCTYPE html>
<html lang="en">

<head>
    @stack('styles')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.components.navbar')


        <!-- Main Sidebar Container -->
        @include('layouts.components.sidebar')


        <!-- Content Wrapper. Contains page content -->
        @yield('contents')
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')

    {{-- <script>
        document.getElementById('nav-chart').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML =
                '<canvas id="myChart" width="400" height="200"></canvas>';
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });

        document.getElementById('nav-table').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                <table class="table table-striped">
                    <tr> Pegawai
                        <th> Nama : </th>
                        <th> Jenis Kelamin : </th>
                        <th> Umur : </th>
                        <th> Divisi : </th>
                    </tr>
                    @foreach ($pegawai as $item)
                    <tr>
                        <td> {{ $item->nama }} </td>
                        <td> {{ $item->jeniskelamin }} </td>
                        <td> {{ $item->umur }} </td>
                        <td> {{ $item->nama_divisi }} </td>
                    </tr>
                    @endforeach
                </table>
                <table class="table table-striped">
                    <tr>
                        <th> Divisi : </th>
                    </tr>
                    @foreach ($divisi as $item)
                    <tr>                        
                        <td> {{ $item->nama }} </td>
                    </tr>
                    @endforeach
                </table>
            `;
        });
    </script> --}}
</body>

</html>
