      
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
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
function import_data(){
   var formdata = new FormData();      
   var file = $('#file')[0].files[0];
   formdata.append('file', file);
   $.each($('#modal_upload form').serializeArray(), function(a, b){
      formdata.append(b.name, b.value);
   });
   $.ajax({
      url: 'modul/ujian/upload.php',
      data: formdata,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
           $('#modal_upload').modal('hide');
           document.location = "?page=ujian";
         }else{
            alert(data);
         }
      },
      error: function(data){
         alert('Tidak dapat mengimport data!');
      }
   });
   return false;
}

