// sorting option for directories sort
$('#select1').on('change', function() { // folder sort 
    let sortValue= this.value;
    let currentPath= $("#currentPath").text();
    let pathAfterRoot=currentPath.substring(5,);

    if (sortValue==2){
        
    }else{
        let url = 'index.php?reloadPath='+pathAfterRoot;
        window.location.assign(url);
    }
});
// sorting option for directories sort end