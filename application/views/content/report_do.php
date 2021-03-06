<script>
 $(document).ready(function() {
	
	$("#range").hide();

    $("#cetakBatas").click(function() {
        $("#range").hide().eq($(this).index()).show();
    });
    
    $("#cetakAll").click(function() {
        $("#range").hide().eq($(this).index()).hide();
    });
	table();
}); 
 
$("#view").click(function(){
    table();
});


/*Tampilkan jQuery Tanggal*/
$(function() {
    $("#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "id",
        autoclose: true
    }); 
    $("#_tgl2").datepicker({
        changeMonth: true,
        changeYear: true,
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "id",
        autoclose: true
    });  

    $( "#_tgl").datepicker('setValue', new Date()); 
    $( "#_tgl2").datepicker('setValue', new Date());
});

function table(){

	var sel = $('input[name="optionsRadios1"]:checked').val();
	var _tgl = $('#_tgl').val();
	var _tgl2 = $('#_tgl2').val();
	var plg1 = $('#kd_plg1').val();
	var plg2 = $('#kd_plg2').val();
	
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>report/table_do",
    data :{sel:sel,_tgl:_tgl,_tgl2:_tgl2,plg1:plg1,plg2:plg2},
    success:
		function(hh){
			$('#tabpreview').html(hh);
		}
    });
}

function listPelanggan(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/report/view_so_pelanggan",
    data :{},
    success:
    function(hh){
        $('#list_pelanggan').html(hh);
    }
    });   
} 
var filter ="";
function getDetail(filterID){
listPelanggan();
    filter = filterID;
}
function getPelanggan(){
    var x = $('input:radio[name=optionsRadios]:checked').val();
    var k = $('input:radio[name=optionsRadios]:checked').attr('kd');
     var row = filter;
    
     
	
    $('#_pn'+row).val(x);
    $('#kd_plg'+row).val(k);
    
}
</script>
<div class="row-fluid">
    <div class="span3">
      <!--//***MAIN FORM-->
      <form action="<?php echo base_url();?>report/print_report_do" method="post" target="_blank">
      <div class="bar" >
          <p>Report Sales Order</p>
      </div>

      <div id="konten" class="hide-con master-border">
        <table>
          <tr>
            <td>
              <label class="radio">
                <input type="radio" name="optionsRadios1" id="cetakAll" value="Semua" checked>
                  Cetak Semua
              </label>
            </td>
            <td>
              <label class="radio" style="margin-left:5px;">
                <input type="radio" name="optionsRadios1" id="cetakBatas" value="Batas">
                  Cetak Batas
              </label>
            </td>
          </tr>
        </table>
        
        <div id="range">
          <table>
            <tr>
              <td colspan="3"><b>Tanggal Sales Order Mulai</b></td>
            </tr>
            <tr>
              <td>
                <input type="text" id="_tgl" name="_tgl" style="width: 65px;" value=""/>
                s/d
                <input type="text" id="_tgl2" name="_tgl2" style="width: 65px;" value=""/>
              </td>
            </tr>
            <tr>
              <td>
                <b>Pelanggan Mulai</b>
              </td>
            </tr>
            <tr>
              <td>
                <input type="hidden" id="kd_plg1" />
                <div class="input-append">
                  <input type='text' class="span2" disabled="disabled" maxlength="20" id="_pn1" placeholder='Batas Awal' id='appendedInputButton' name='_pn1' style="width: 148px;" onclick="lookup_pelanggan()" onkeydown="lookup_pelanggan()"/>
                  <a href="#modalPelanggan" id="f_plg" style="margin-bottom:4px;" role="button" class="btn" title="Search Pelanggan" data-toggle="modal" onclick="getDetail(1)"><i class="icon-search"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="input-append">
                  <input type="hidden" id="kd_plg2" />
                  <input type='text' class="span2" disabled="disabled"
                            maxlength="20" id="_pn2" id='appendedInputButton' name='_pn2' placeholder='Batas Akhir' style="width: 148px;" onclick="lookup_pelanggan()" onkeydown="lookup_pelanggan()"/>
                  <a href="#modalPelanggan" id="f_plg2" role="button" class="btn" title="Search Pelanggan" data-toggle="modal" style="margin-bottom:4px;" onclick="getDetail(2)"><i class="icon-search"></i></a>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div>
          <!--<input role="button" type="button" class="btn btn-primary"  id="print" value="Print"> -->
          <?php if ($this->authorization->is_permitted('print_report_sales')) : ?>
		        <input role="button" type="submit" class="btn btn-primary"  value="Print">
          <?php endif;?>
          <input role="button" type="button" class="btn"  id="view" value="Preview">  
        </div>
      </div>
      </form>
    </div>

    <div class="span9">
      <div id="tabpreview"></div>
    </div>
</div>


<div id="modalPelanggan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">List Pelanggan <input type="text" id="SearchPelanggan" placeholder="Search"></h3>
  </div>
  <div class="modal-body">
    <div id="list_pelanggan"></div>
  </div>
  <div class="modal-footer">
    <a href="#modalNewPelanggan" role="button" class="btn btn-info" data-toggle="modal" onclick="addPelanggan()">Create Pelanggan</a>
  </div>
</div>