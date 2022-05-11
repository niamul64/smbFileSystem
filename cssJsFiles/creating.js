
// $("#submit_form").on("submit", function(e){ // submit for folder/file creating 
//     e.preventDefault(); // prevent form submit to php file

//     let reloadUrl='';   // variable to keep path after root
//     var formData = new FormData(this); // grab the form value
//     $.ajax({
//         type: "POST",                   // send post request to make file or dir
//         url: "fileOrdirectoryCreate.php",
//         data: formData,
//         contentType: false,
//         processData: false,
//         success: function (response) {
//             return response;
//         },
//     }).then(function(response) {        // grab response
//         let queryArry = response.split("|");
//         reloadUrl=queryArry[0];         // grab path after root
//         let directoryExists=parseInt(queryArry[1]); // if directory with same name already exists the value 1
//         let newCreatingFile=parseInt(queryArry[2]); // if file with same name already exists the value 1
//         if (directoryExists && newCreatingFile){    // if file and dir both already exists
//             Swal.fire({
//                 icon: 'warning',
//                 title: 'Oops...',
//                 text: 'The file and directory already exist. Please choose another name and try again.',
               
//               }).then(function(response) {
//                 // let url = 'index.php?reloadPath='+reloadUrl;
//                 // window.location.assign(url);
//             })
//         }else if(directoryExists){                  // if dir already exists
//             Swal.fire({
//                 icon: 'warning',
//                 title: 'Oops...',
//                 text: 'The directory already exists. Please choose another name and try again.',
               
//               }).then(function(response) {
//                 // let url = 'index.php?reloadPath='+reloadUrl;
//                 // window.location.assign(url);
//             })
//         }
//         else if(newCreatingFile){                   // if file already exists
//             Swal.fire({
//                 icon: 'warning',
//                 title: 'Oops...',
//                 text: 'The file already exists. Please choose another name and try again.',
               
//               }).then(function(response) {
//                 // let url = 'index.php?reloadPath='+reloadUrl;
//                 // window.location.assign(url);
//             })
//         }
//         else{                                       // if file or dir created successfully then just reload
        
//             let url = 'index.php?reloadPath='+reloadUrl;
//             window.location.assign(url);
//         }
//     });
// })

