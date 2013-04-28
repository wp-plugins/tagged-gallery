$j=jQuery.noConflict();
$j(document).ready(function(){    
  $j('.tg-resizecrop').click(function(event){
    $j(this).tgbox({});
    event.preventDefault(); 
  });
});