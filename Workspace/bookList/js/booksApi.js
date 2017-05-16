/**
 * Created by mc on 15.05.17.

$('document').ready(function(){
    /*
    $.ajax({
        url: "./api/src/books.php",
        data: {},
        type: "GET",
        dataType: "json",
        success: function(data){
            console.log("test");
            console.log(data);
            console.log("test");
            $('#bookContainer').text(data);
        }
    });


    $.get("./api/src/books.php",{dataType: "json"},
        function(data){
        console.log('test');
           var parseJson = JSON.parse(data);
           console.log(parseJson);
        });

})
*/
window.onload =function() {
    new Vue({
        el: '#app',
        data: {
            allBooks: []
        },
        mounted() {
            axios.get("./api/src/books.php").then(response => this.allBooks = response.data);
            }
        })
}

