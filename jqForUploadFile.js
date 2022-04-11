function uploadFile(tmpName,pathValue,fileName,nextDir){


    Swal.fire({
        title: 'Same file exits. Select a option:',
        text: "Optin 1: keep both files then press the button: 'Keep Both'",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Keep Both<br> ',
        denyButtonText: `Replace`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) { // keep both
            fileName='(copy)'.concat(fileName);
            $.ajax({//AJAX request
                type: "POST",
                url: "index_file_up_on_condition.php",
                data: {tmp: tmpName, path:pathValue, fileName:fileName },
                success: function (response) {
                    console.log(response);
                    // let url = 'index.php?reloadPath='+nextDir;
                    // window.location.assign(url);
                    }
            });
        
        } else if (result.isDenied) {
        
        }
        else{
            
            let url = 'index.php?reloadPath='+nextDir;
            window.location.assign(url);
        }
    })
}


