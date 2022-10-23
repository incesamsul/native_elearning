      
function cek_database(){


var id_roleguru = $("#id_roleguru").val();
$.ajax({
type: "GET",
url: 'ajax_perangkat.php',
data:"id_roleguru="+id_roleguru ,
})
.success(function (data) {
var json = data,
obj = JSON.parse(json);

$('#id_guru').val(obj.id_guru);
$('#id_kelas').val(obj.id_kelas);
$('#id_mapel').val(obj.id_mapel);
$('#id_semester').val(obj.id_semester);
$('#id_jurusan').val(obj.id_jurusan);


});
}


// $(document).ready(function(){
// 	$('#saveMapel').click(function() {
// 		var data = $('.form-mapel').serialize();
// 		$.ajax({
// 			type:'POST',
// 			url:'ajax/ajax_mapel.php',
// 			data : data,
// 			success: function(){
// 				load("?page=materi")
// 			}
// 		});
// 	});
// });
//     