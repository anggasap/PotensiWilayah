<!-- BEGIN PAGE BREADCRUMB -->
<!--

-->
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-pencil-square-o font-blue-chambray"></i>
                    <span class="caption-subject font-blue-chambray bold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="actions">
                    <a class="btn btn-icon-only btn-default btn-sm fullscreen" href="javascript:;" data-original-title="" title="">
                    </a>
                </div>                
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">
                    </span>
                </div>
                <form role="form" method="post" id="id_laporanLabaRugi">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Dari</label>
                                    <input id="id_tanggaldari" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control date-picker input-sm" type="text" name="tanggalAwal" />                                                   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Sampai</label>
                                    <input id="id_tanggalsampai" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control date-picker input-sm" type="text" name="tanggalAkhir" />                                                   
                                </div>
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>		
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" value="1" name="nol" id="id_nol">
                                        Tampilkan Hasil Nol<span></span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" value="1" name="tipe" id="id_tipe">
                                        Hanya akun General<span></span></label>
                                </div>
                            </div>

                        </div>

                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">
                                <a href="javascript:;" class="btn blue btn-medium" onclick="cetak();">
                                    <i class="fa fa-print"></i> Cetak </a>
                                <a href="javascript:;" class="btn green btn-medium" onclick="excel();">
                                    <i class="fa fa-print"></i> Excel </a>
                                <button id="id_btnBatal" type="button" class="btn default">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
</div>
<!-- end <div class="portlet green-meadow box"> -->
<!-- end <div class="col-md-6"> -->
<!--
<div class="col-md-6">
</div>
-->
<!-- end <div class="col-md-6"> -->
</div>
<div class="row">
    <div class="col-md-6">
    </div>
</div>
<!-- END PAGE CONTENT-->
<?php $this->load->view('app.min.inc.php'); ?>
<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
    });
    //Ready Doc
    tglTransStart();
    btnStart();
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });

    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
    });

    function cetak() {
        var tglAwal = $('#id_tanggaldari').val();
        var tglAkhir = $('#id_tanggalsampai').val();
        var nol = $("#id_nol").is(":checked") ? 1 : 0;
        var tipe = $("#id_tipe").is(":checked") ? 1 : 0;
        if (tglAwal == '') {
            alert('Silahkan pilih tanggal Awal');
            return false;
        }
        if (tglAkhir == '') {
            alert('Silahkan pilih tanggal Akhir');
            return false;
        }
//		if(nama == '0'){
//			window.open("<?php echo base_url('laporan/laporan_laba_rugi/cetak/'); ?>/"+tglAwal+"/"+nol, '_blank');
//		}else{
        window.open("<?php echo base_url('laporan/laporan_laba_rugi/cetak/'); ?>/" + tglAwal + "/" + tglAkhir + "/" + nol + "/" + tipe, '_blank');
        //}
    }
    function excel() {
        var tglAwal = $('#id_tanggal').val();
        var nol = $("#id_nol").is(":checked") ? 1 : 0;
        var tipe = $("#id_tipe").is(":checked") ? 1 : 0;
        if (tglAwal == '') {
            alert('Silahkan pilih tanggal Awal');
            return false;
        }
        if (tglAkhir == '') {
            alert('Silahkan pilih tanggal Akhir');
            return false;
        }
        window.open("<?php echo base_url('laporan/laporan_laba_rugi/cetakexcel/'); ?>/" + tglAwal + "/" + tglAkhir + "/" + nol + "/" + tipe, '_blank');
    }

   
</script>


<!-- END JAVASCRIPTS -->