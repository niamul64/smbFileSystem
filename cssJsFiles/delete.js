// multiple file delete
$( "#deleteAllSelectedFiles" ).click(function() { // function Execute if clicked on delete button at button group
    var numOfISelectedItems = $('.selected').length;
    if (numOfISelectedItems) // looping through all the file cards
    {
        Swal.fire({
            title: `Are You sure?`,
            text: "Will Delete all the selected files.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {       // if connfirmed
                let currentPath= $("#currentPath").text(); // current directory path
                let pathAfterRoot=currentPath.substring(5,); // path after 'Root//'
                $('.selected').each((index, element) => {
                    let file=$(element).data('filename');

                    $.ajax({                        //AJAX request
                        url: "index.php",           // Get request
                        data: {deletePath: pathAfterRoot ,fileName:file},
                        success: function (response) {
                                $(element).remove();
                            }
                    });
                });
            }
          }) 
    }
});
// multiple file delete end

// single file delete
function deletefile(path,file){ // 'on click' applied on index.php by passing the path after root and folderName
    Swal.fire({
        title: ` Delete: ${file}`,
        text: "Are You sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {       // if connfirmed
        $.ajax({                        //AJAX request
            url: "index.php",           // Get request
            data: {deletePath: path ,fileName:file},
            success: function (response) {
                Swal.fire({             // show success message
                    icon: 'success',
                    title: 'File Deleted',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function() {  // reload 
                    let url = 'index.php?reloadPath='+path;
                    window.location.assign(url);
                });
                }
        });
        }
      })      
}
// single file delete end

// delete dir
function deleteDir(path,folder){ // 'on click' applied on index.php by passing the path after root and folderName 
  Swal.fire({                  // popUP to have user confirmation
      title: ` Delete: ${folder}`,
      text: "Are You sure?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {      
      if (result.isConfirmed) {    // if connfirmed
      $.ajax({                     // AJAX request
          url: "index.php",        // Get request
          data: {deletePath: path,folderName:folder},
          success: function (response) {
              Swal.fire({           // show success message
                  icon: 'success',
                  title: 'Folder Deleted',
                  showConfirmButton: false,
                  timer: 1500
                }).then(function() { // reload 
                  let url = 'index.php?reloadPath='+path;
                  window.location.assign(url);
              });
              }
      });
      }
    })   
}
// delete dir end