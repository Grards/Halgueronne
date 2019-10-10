var $ = require('jquery'); 

global.$ = global.jQuery = $;

require('popper.js');
 
// On utilise ce chemin pour aller chercher le min.js car bootstrap est installé via npm, dans les node_modules et non copié manuellement dans les assets.
require('../../node_modules/bootstrap/dist/js/bootstrap.min.js');

require('../../node_modules/@fortawesome/fontawesome-free/js/all.js');

$(document).ready(function(){
            
    var etat=0;
    
    $('#burger').click(function(){
        $('#burger').toggleClass('change');
        
        if(etat==0){
            $('#menu').stop().animate({'left':'0'},500);
            etat=1;
        }

        else{
            $('#menu').stop().animate({'left':'-100%'},500);
            etat=0;
        }
    });

    var etat2 = 0

    $('#connexion-avatar').click(function(){
       
        if(etat2==0){
            $('#connexion-nav').stop().animate({'width':'202px'},500);
            $('#connexion-nav-list').stop().css({'display':'block'},500);
            etat2=1;
        }

        else{
            $('#connexion-nav').stop().animate({'width':'0'},500);
            $('#connexion-nav-list').stop().css({'display':'none'},500);
            etat2=0;
        }
    });
});