// var t_category = $('#category-list').html();
// var tS_category = Handlebars.compile(t_category);

// var t_question = $('#listquestion').html();
// var tS_question = Handlebars.compile(t_question);

// var t_subcate = $('#subcate-list').html();
// var tS_subcate = Handlebars.compile(t_subcate);

$(document).ready(function(){
    let endpoint = 'http://'+ $(location).attr('host'); 
    $("body").on("click", ".filter",function(e) {      
        alert("g");
        // var a = $("li[class='filter']");
        // var filter = e.target.firstChild.nodeValue.includes("moinhat") ? 1 : 0    
        // if(filter){
        //     a.innerText = "noibat"
        // }
        // else{
        //     a.innerText = "moinhat"
        // }
    });
    $("body").on("click", ".pagination_ans",function(e) {
        $.ajax({
            type: "GET",
            url: endpoint + '/?controller=api&action=getAnswers&skip='+ e.target.text*5 +'&limit=5',
            contentType: 'application/json',
            success: function(result){
                console.log(result);
                // var html = tS_question({question : result['result']});
                // $( ".listquestion").empty();
                // $( ".listquestion").append(html);
                // $( "#subcate" + e.target.id ).append(html);
            }
        })
    });
});