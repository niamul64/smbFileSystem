let foldersList = document.querySelector('.folders');
foldersList.addEventListener('click', changeDir);

let filesList = document.querySelector('.files');
filesList.addEventListener('click', filesName);


function changeDir(e) {  
    if (e.target.hasAttribute("href")) {
        console.log(e.target.textContent);
        fetch("jquery/index.php",
        {method: 'POST',
        body: JSON.stringify(
            {
                title:e.target.textContent,
            }
            )
        }
        )
    }
}

function filesName(e) {  
    if (e.target.hasAttribute("href")) {
        if (confirm("Are you sure?")){
        console.log(e.target.textContent);
        fetch("jquery/index.php",
        {method: 'POST',
        body: JSON.stringify(
            {
                title:e.target.textContent,
            }
        )
    
        }
        )
    }
    }
}