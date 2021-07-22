var skip = 5;

$(document).ready(function(){
    let endpoint = 'http://'+ $(location).attr('host'); 
    $("body").on("click", ".filter",function(e) {      
        var a = $("li[class='filter']")[0];
        var filter = e.target.firstChild.nodeValue.includes("moinhat") ? 1 : 0    
        if(filter){
            a.innerText = "noibat"
        }
        else{
            a.innerText = "moinhat"
        }
        skip = 0;
        var t_answer = $('#listanswer').html();
        var tS_answer = Handlebars.compile(t_answer);
        var nodeid = location.href.split('&').find((e)=>{return e.includes('id')}) ? location.href.split('&').find((e)=>{return e.includes('id')}).split('=')[1] : null;
        $.ajax({
            type: "GET",
            url: endpoint + '/?controller=api&action=getAnswers&id='+ nodeid +'&skip='+ skip +'&limit=5&noibat='+ !filter,
            contentType: 'application/json',
            success: function(result){
                console.log(result);
                var html = tS_answer({answer : result['result']});
                $(".list_ans").empty();
                $(".list_ans").append(html);
                if(result['result'].length == 0 ){
                    $(".pagination_ans").remove();
                }else{
                    skip = skip + 5;
                }
            }
        })
    });
    $("body").on("click", ".vote",function(e) {      
        var vote = e.target.firstChild.nodeValue.includes("upvote") ? 1 : -1    
        $.ajax({
            type: "GET",
            url: endpoint + '/?controller=api&action=makeVotes&object='+e.target.attributes[1].value+'&vote='+vote,
            contentType: 'application/json',
            success: function(result){
                var a = $("span[data-value='" + e.target.attributes[1].value +"']")[0];
                a.innerText ="upvote "+ result[0]['upvote'];
                var b = $("span[data-value='" + e.target.attributes[1].value +"']")[1];
                b.innerText ="downvote " + result[0]['downvote'];
            }
        })
    });
    $("body").on("click", ".listcategory",function(e) {        
        var t_question = $('#listquestion').html();
        var tS_question = Handlebars.compile(t_question);
        var t_page = $('#pagepagiantion').html();
        var tS_page = Handlebars.compile(t_page);
        $.ajax({
            type: "GET",
            url: endpoint + '/?controller=api&action=getQuestions&category='+e.target.id+'&skip=0&limit=5',
            contentType: 'application/json',
            success: function(result){
                var html = tS_question({question : result['result']});
                var html_page = tS_page({count : [...Array(Math.floor(result['count']/5)).keys()]});
                $( ".list_question").empty();
                $( ".list_question").append(html);
                $( ".page_pagiantion").empty();
                $( ".page_pagiantion").append(html_page);
                window.history.pushState({}, null, '/?controller=landing&action=userindex'+'&category='+e.target.id+'&limit=5&skip=0');
            }
        })
    });
    $("body").on("click", ".page_pagiantion",function(e) {        
        var t_question = $('#listquestion').html();
        var tS_question = Handlebars.compile(t_question);
        var category = location.href.split('&').find((e)=>{return e.includes('category')}) ? location.href.split('&').find((e)=>{return e.includes('category')}).split('=')[1] : 'moinhat';
        var def = '/?controller=api&action=getQuestions&category='+category+'&limit=5&skip='
        $.ajax({
            type: "GET",            
            url: endpoint + def + e.target.text*5,
            contentType: 'application/json',
            success: function(result){
                var html = tS_question({question : result['result']});
                $( ".list_question").empty();
                $( ".list_question").append(html);
                $(location).attr('href');                
                window.history.pushState({}, null, '/?controller=landing&action=userindex'+'&category='+category+'&limit=5&skip=' + e.target.text*5);
            }
        })
    });
    $("body").on("click", ".pagination_ans",function(e) {
        var t_answer = $('#listanswer').html();
        var tS_answer = Handlebars.compile(t_answer);
        var a = $("li[class='filter']")[0].innerText.includes("moinhat") ? 1 : 0
        $.ajax({
            type: "GET",
            url: endpoint + '/?controller=api&action=getAnswers&id='+ e.currentTarget.id +'&skip='+ skip +'&limit=5&noibat='+ a,
            contentType: 'application/json',
            success: function(result){
                console.log(result);
                var html = tS_answer({answer : result['result']});
                // $( ".listanswer").empty();
                $(".list_ans").append(html);
                if(result['result'].length == 0 ){
                    $(".pagination_ans").remove();
                }else{
                    skip = skip + 5;
                }
            }
        })
    });
});