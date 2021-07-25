        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer myfooter">
            <div class="container">
                <div class="copyright text-center">
                <span class="text-white">Copyright &copy; Alfabet Digital 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Modal Kategori -->
<div class="modal fade" id="modalKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Kategori :</h5>
            </div>
            <div class="modal-body">

                @foreach($listKategori as $lk)
                <a href="{{ url('/showcase/'.$lk['kategori']) }}" class="badge badge-success">{{ $lk['kategori'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End Modal Kategori -->

<!-- Modal Tag -->
<div class="modal fade" id="modalTag">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Tag :</h5>
            </div>
            <div class="modal-body">
                @foreach($listTag as $lt)
                <a href="{{ url('/showcase/'.$lt['name']) }}" class="badge badge-success">{{ $lt['name'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tag -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- End of Scroll to Top Button-->

