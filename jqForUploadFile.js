function uploadFile(tmpName,currentPath,fileName,nextDir){
    Swal.fire({
        title: 'Same file exits. Select a option:',
        text: "Optin 1: keep both files then press the button: 'Keep Both'",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Keep Both<br> ',
        denyButtonText: `Replace`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

        
        } else if (result.isDenied) {
        
        }
        else{
            let url = 'index.php?reloadPath='+nextDir;
            window.location.assign(url);
        }
    })
}


function deletefile(path,file){
    
    Swal.fire({
        title: ` Delete: ${file}`,
        text: "Are You sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
        $.ajax({//AJAX request
            url: "index.php",
            data: {deletePath: path ,fileName:file},
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'File Deleted',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {
                    window.location.reload();
                });
                }
        });
        }
      })      
}