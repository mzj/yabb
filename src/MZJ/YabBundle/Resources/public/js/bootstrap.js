/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    hljs.initHighlightingOnLoad();
    
    $('#coolness div').hover(function(){
          $('#coolness .second').fadeOut(500);
    }, function(){
         $('#coolness .second').fadeIn(1000);
    });
    
    
    
    
});

