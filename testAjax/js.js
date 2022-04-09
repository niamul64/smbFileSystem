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
    $(function(){
        $.ajax({
            type: "HEAD",
            async: true,
            url: "//home/user/Documents/sharef/main.js"
        }).done(function(){
            console.log("found");
        }).fail(function () {
            console.log("not  at all found");
        })
    });

} 



// "/home/user/Documents/abc.txt"