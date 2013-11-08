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

/*Tampilkan jQuery Tanggal*/
$(function() {
    $( "#_tgl").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
    $( "#_tgl2").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy",
        showAnim: "blind"
    });
});

function table(){

	var sel = $('input[name="optionsRadios"]:checked').val();
	var _tgl = $('#_tgl').val();
	var _tgl2 = $('#_tgl2').val();
	
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>report/table_sj",
    data :{sel:sel,_tgl:_tgl,_tgl2:_tgl2},
    success:
		function(hh){
			$('#tabpreview').html(hh);
		}
    });
}

$("#view").click(function(){
    table();
});

$("#print").click(function(){

$('#lab1').text("");
	//TANGGAL
	var d = new Date();
	var curr_date = d.getDate();
	var curr_month = d.getMonth() + 1; //Months are zero based
	var curr_year = d.getFullYear();
	var tgl = curr_date + "-" + curr_month + "-" + curr_year;
	
    var data = $('#tabpreview').html();
	
	var mywindow = window.open('', '', '');
	mywindow.document.write('<title>Laporan Surat Jalan '+tgl+'</title>');
	mywindow.document.write('<style>.draggable , .tableLap{border-width: 0 0 1px 1px;border-spacing: 0;border-collapse: collapse;border-style: solid;}.draggable td, .tableLap td, .draggable th, .tableLap th{margin: 0;padding: 2px;border-width: 1px 1px 0 0;border-style: solid;},header{ display:none;}</style>');
	
	mywindow.document.write('');
	mywindow.document.write('<center><h2>Laporan Surat Jalan</h2></center>');
	mywindow.document.write(data); 


	mywindow.print();
	mywindow.close();

	return true;
});

</script>

<div class="row-fluid">
    <div class="span3">
		<!--//***MAIN FORM-->
		<form action="<?php echo base_url();?>report/print_report_sj" method="post" target="_blank">
		<div class="bar">
		    <p>Laporan Surat Jalan <i id="icon" class='icon-chevron-down icon-white'></i></p>
		</div>
		<div id="konten" class="hide-con master-border">
			<table>
				<tr>
					<td>
						<label class="radio">
				  		<input type="radio" name="optionsRadios" id="cetakAll" value="Semua" checked>
				  			Cetak Semua
						</label>
					</td>
					<td>
						<label class="radio" style="margin-left:5px;">
				  		<input type="radio" name="optionsRadios" id="cetakBatas" value="Batas">
				  			Cetak Batas
						</label>
					</td>
				</tr>
			</table>
			
			<div id="range" style="border: 1px solid #C6C6C6; padding: 2px;">
				<p><b>Tanggal Surat Jalan Mulai</b></p>
				<input type="text" id="_tgl" name="_tgl" style="width: 65px;" value="<?php echo date('01-m-Y');?>"/> 
				s/d 
				<input type="text" id="_tgl2" name="_tgl2" style="width: 65px;" value="<?php echo date('d-m-Y');?>"/>
			</div>
			<div style="margin-top: 10px;">
				<input role="button" type="button" class="btn btn-primary"  id="print" value="Print">	
				<!--<input role="button" type="submit" class="btn btn-primary"  value="Print">-->
				<input role="button" type="button" class="btn"  id="view" value="Preview">	
			</div>
		</div>
		</form>
    </div>
    <div class="span9">
      <div id="tabpreview"></div>
    </div>
</div>