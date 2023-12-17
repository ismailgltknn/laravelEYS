$(function(){
  $(document).on('click','#deleteBtn',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    
    
    Swal.fire({
      title: 'Silme İşlemi Onayı',
      text: "Silmek istediğinize emin misiniz?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Evet, sil!',
      cancelButtonText: 'İptal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Silindi!',
          'Silme işlemi başarılı.',
          'success'
          )
        }
      }) 
      
      
    });
    $(document).on('click','#approveBtn',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
      
      
      Swal.fire({
        title: 'Onaylama İşlemi',
        text: "Onaylamak istediğinize emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, onayla!',
        cancelButtonText: 'İptal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link
          Swal.fire(
            'Onaylandı!',
            'Onaylama işlemi başarılı.',
            'success'
            )
          }
        }) 
        
        
      });
  });