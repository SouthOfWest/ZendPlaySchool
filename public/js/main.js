jQuery(document).ready(function(){
    jQuery('ul.toggle-background li').click(function(e){
        e.preventDefault();
        name = jQuery(this).attr('title');
        jQuery('body').css('background','url(/public/textures/'+ name +') repeat top left');
    });
});