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