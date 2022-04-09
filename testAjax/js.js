window.onload = function funLoad() { 
    

    // $.ajax({
    //     url: "/home/user/Documents/sharef/abc.txt",
    //     type: 'HEAD',
    //     statusCode: {
    //         404: function () {

    //             console.log("not found");
    //         }
    //     },
    //     success: function () {
    //         console.log('found');

    //     }
    // });
    $.ajax({//AJAX request

        url: "/testAjax/index.php/",
        data: {firstname: 'niamul'},
        success: function (response) {
            window.location.reload();
            }
    });
}

