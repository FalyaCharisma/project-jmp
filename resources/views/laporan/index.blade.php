<!DOCTYPE html>
<html lang="en">

@include('layouts/head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts/sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts/topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                           
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example  
                                <a class="btn btn-primary" href="form.php"> <i class="fas fa-list fa-sm fa-plus mr-2"></i></a> 
                             </h6>
                           
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach($lk as $no => $lk)
                                        <tr>
                                         
                                            <td>1</td>
                                            <td contenteditable="true" class="nominal">{{$lk->nominal}}</td>
                                            <td><button class="btn-sm btn-danger" id="hapus">-</button></td>
                                        
                                            
                                        </tr>
                                        @endforeach
                                        <!-- <tr>
                                        <td>1</td>
                                            <td contenteditable="true" class="nominal"></td>
                                            <td><button class="btn-sm btn-danger" id="hapus">-</button></td>
                                        </tr> -->
                                    </thead>
                             
                                    
                                </table>
                                <button class="btn btn-success" id="tambah">+</button>
                                <button class="btn btn-primary" id="simpan">Simpan</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts/footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts/js')
    <script>
        $(document).ready(function (){
            // console.log({{csrf_token()}});
            let baris = 1

            $(document).on('click', '#tambah', function(){
                baris = baris + 1
                var html = "<tr id='baris'" + baris + ">"
                        html += " <td>" + baris + "</td>"
                        html += " <td contenteditable='true' class='nominal'></td>"
                        html += " <td> <button class='btn btn-danger' data-row='baris'" +baris+">-</button></td>"
                        // html += " <td> <button class='btn btn-danger hapus' data-row='baris'>-</button></td>"
                    html += " </tr>"

                    $('#dataTable').append(html)
            })
        })

        $(document).on('click', '#hapus', function (){
            let hapus = $(this).data('row')
            // $(this).parent().parent().remove();
            $('#' + hapus).remove()
        })

        $(document).on('click', '#simpan', function(){
            let nominal = [];

            $('.nominal').each(function(){
                nominal.push($(this).text());
            })

            $.ajax({
                url : "{{route('simpan')}}",
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: {
                    nominal : nominal,
                    
                },
                success: function (res){
                    console.log(res);
                },error: function (xhr){
                    console.error(xhr);
                }
            })
        })
    </script>

</body>

</html>