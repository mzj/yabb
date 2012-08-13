/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    
    hljs.initHighlightingOnLoad();
    
    $('#coolness div').hover(function(){
          $('#coolness .second').fadeOut(500);
    }, function(){
         $('#coolness .second').fadeIn(1000).stop(false, true);
    });
    
    
    $(".reply a").click(function() {
        var oldAction = $('#comment-form').attr("action");
        var add = this.className;
        var action = oldAction + '/' + add;
        $("#comment-form").attr("action", action);
        
        console.log($('#comment-form').attr("action"));
    });
    
});

