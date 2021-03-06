<div class="CSSTabel table-list">
<table id="tb1" class="table table-hover">
    <thead>
        <th width="30%">Kode</th>
        <th width="60%">Nama</th>
        <th width="10%">Action</th>
    </thead>
    
    <tbody id="tb_detail">
    <?php foreach($hasil as $row):?>
        <?php echo "<tr>
            <td>$row->Kode</td>
            <td>$row->Nama</td>
            <td>
                <div class='btn-group'>
                    <a class='btn popup' style='padding: 0px 3px;'
                        kode='$row->Kode'
                        nama='$row->Nama'
                        alamat='$row->Alamat'
                        kota='$row->Kota'
                        telp='$row->Telp'
                        telp1='$row->Telp1'
                        fax='$row->Fax'
                        fax1='$row->Fax1'
                 ><i class='icon-pencil'></i></a>"?>
            <?php if ($this->authorization->is_permitted('delete_gudang')) : ?>
                <?php echo "<a class='btn delete' name='$row->Kode' nama='$row->Nama' style='padding: 0px 3px;'><i class='icon-trash'></i></a></div>" ?>
            <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>    
</table>
</div>

<script>
$('#tb1 tbody tr').dblclick(function (e) {
    $(this).find('td .popup').click();
});

$('.popup').click(function(){
    $("#kd").attr('disabled',true);
        
    var kd = $(this).attr("kode");
    var nm = $(this).attr("nama");
    var al = $(this).attr("alamat");
    var kt = $(this).attr("kota");
    var tel = $(this).attr("telp");
    var tel1 = $(this).attr("telp1");
    var fx = $(this).attr("fax");
    var fx1 = $(this).attr("fax1");
    
    $('#kd').val(kd);
    $('#nm').val(nm);
    $('#al').val(al);
    $('#kt').val(kt);
    $('#tl1').val(tel);
    $('#tl2').val(tel1);
    $('#fx1').val(fx);
    $('#fx2').val(fx1);
    
    <?php if ($this->authorization->is_permitted('update_gudang')) : ?>
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>

    jQuery(".hide-con").show(); 
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("name");
    var pr = $(this).attr("nama");
    bootbox.dialog({

        message: "<table><tr><td>Kode </td><td>: <b>"+id+"</b></td></tr><tr><td>Nama Gudang </td><td>: <b>"+pr+"</b></td></tr></table>",
        title: "<img src='<?php echo base_url();?>/assets/img/warning-icon.svg' class='warning-icon'/> Yakin ingin menghapus Data Berikut?",
        buttons: {
            main: {
                label: "Batal",
                className: "pull-left"
            },
            danger: {
                label: "Hapus",
                className: "btn-danger",
                callback: function() {
                    $.ajax({
                        type:'POST',
                        url: "<?php echo base_url();?>index.php/ms_gudang/delete",
                        data :{id:id},
                        success: function(msg){
                            if(msg=="gagal"){
                                bootstrap_alert.warning('<b>Gagal Menghapus</b> terjadi kesalahan');
                            }else{
                                bootstrap_alert.success('Data <b>'+pr+'</b> berhasil dihapus');
                                $('#formID').each(function(){
                                    this.reset();
                                });
                                autogen();
                                load_list();
                            }
                        }
                    });
                }
            }
        }
    });
});

var oTable = $('#tb1').dataTable( {
    "sScrollY": "380px",
    "sScrollYInner": "110%",
    "sScrollX": "100%", //panjang width
    "sScrollXInner": "100%", //overflow dalem
    "bPaginate": true,
    "bLengthChange": true,
    "aaSorting": [[ 4, "desc" ]],
    "oLanguage": {
         "sSearch": "",
         "sLengthMenu": " _MENU_ ",
         "sEmptyTable": "Tidak ada data tersedia",
         "sZeroRecords": "Data tidak ditemukan"
       },
       "sPaginationType": "full_numbers",
    "bInfo": false //Showing 1 to 1 of 1 entries (filtered from 7 total entries)
} );
</script>
