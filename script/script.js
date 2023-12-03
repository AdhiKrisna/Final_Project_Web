let search = document.getElementById('search');
let container = document.getElementById('containerPlace');

search.addEventListener('keyup', function(){
    console.log(search.value);  
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200 ){
            container.innerHTML = xhr.responseText;
        }
    }
    xhr.open('GET', 'ajax/data.php?keyword=' + search.value , true);
    xhr.send();

});