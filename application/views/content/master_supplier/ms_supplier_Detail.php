<div class="table table-hover CSSTabel table-list">
<table id="tb1" style="width: 100%;">
    <thead>
        <th >Kode</th>
        <th >Supplier</th>
        <th >Action</th>
    </thead>
    
    <tbody id="tb_detail">
    <?php foreach($hasil as $row):?>
        <?php 
            $limit = number_format($row->Limit_Kredit,0,",",".");
            echo "<tr>
            <td>$row->Kode</td>
            <td>$row->Perusahaan</td>
            <td>
            <div class='btn-group'>
             <a class='btn edit list-edit'
                    kode='$row->Kode'
                    nama='$row->Nama'
                    perusahaan='$row->Perusahaan'
                    alamat='$row->Alamat1'
                    kota='$row->Kota'
                    telp='$row->Telp'
                    telp1='$row->Telp1'
                    telp2='$row->Telp2'
                    fax='$row->Fax1'
                    fax1='$row->Fax2'
                    limit='$limit'
             ><i class='icon-pencil'></i></a>"?>
             <?php if ($this->authorization->is_permitted('delete_supplier')) : ?>
                <?php echo"<a class='btn delete list-edit' name='$row->Kode' pr='$row->Perusahaan'><i class='icon-trash'></i></a></div>"?>
            <?php endif;?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>    
</table>
</div>

<script>
//Edit TRIGGER 
$('#tb1 tbody tr').dblclick(function (e) {
    $(this).find('td .edit').click();
});

$('.edit').click(function(){ 
    $("#kd").attr('disabled',true);
       
    var kd = $(this).attr("kode"); //atribut sebagai identifier data row
    var pr = $(this).attr("perusahaan");
    var nm = $(this).attr("nama");
    var al = $(this).attr("alamat");
    var lk = $(this).attr("limit");
    var kt = $(this).attr("kota");
    var tel = $(this).attr("telp");
    var tel1 = $(this).attr("telp1");
    var tel2 = $(this).attr("telp2");
    var fx = $(this).attr("fax");
    var fx1 = $(this).attr("fax1");
    
    $('#kd').val(kd);
    $('#pr').val(pr);
    $('#nm').val(nm);
    $('#al').val(al);
    $('#lk').val(lk);
    $('#kt').val(kt);
    $('#tl1').val(tel);
    $('#tl2').val(tel1);
    $('#tl3').val(tel2);
    $('#fx1').val(fx);
    $('#fx2').val(fx1);
    
    <?php if ($this->authorization->is_permitted('update_supplier')) : ?>
        $('#save').attr('mode','edit');
    <?php else: ?>
        $("#save").attr('disabled',true);
    <?php endif; ?>
    jQuery(".hide-con").show();
});

$(".delete").click(function(){
    PlaySound('beep');
    var id = $(this).attr("name");
    var pr = $(this).attr("pr");
    //var r=confirm("Anda yakin ingin menghapus data "+id+" ?");
    bootbox.dialog({
        message: "<table><tr><td>Kode </td><td>: <b>"+id+"</b></td></tr><tr><td>Nama Supplier </td><td>: <b>"+pr+"</b></td></tr></table>",
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
                        url: "<?php echo base_url();?>index.php/ms_supplier/delete",
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
                                loadList();  
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
