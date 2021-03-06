$( ".renameFile" ).click(function() { // onclick the rename file icon this function will Execute
    let currentDir = $(this).data('currentdir');
    let oldFileName = $(this).data('oldfilename');
    (async () => { // will take user input for new name file name
        const { value: text } = await Swal.fire({
          title: `Rename: ${oldFileName}`,
          input: 'text',
          inputLabel: 'Enter new name for the file, with extention',
          inputPlaceholder: 'Example: file.txt',
          showCancelButton: true
        })
        if (text) { // grab the user input in 'text'
            console.log(currentDir);
            $.ajax({                        //AJAX request
                url: "allPhpFiles/fileRename.php",           // Get request
                data: {path: currentDir, oldName: oldFileName, newName: text},
                success: function (response) {
                        if (response.trim()=='error'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops. rename unsuccessful',
                                text: 'please choose another name for the file',
                            });    
                        }
                        else{
                            location.reload();
                        }              
                    }
            });
        }
    })()
});