<?php
    $disqus_shortname = get_field( 'disqus_shortname', 'options' );
    $disqus_shortname = $disqus_shortname ? $disqus_shortname : 'teste';
    if ($disqus_shortname) :
?>

    <div id="disqus_thread"></div>
    <script>						    
        var disqus_config = function () {
            this.page.url = '<?php echo get_permalink(); ?>';
            // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = '<?php echo get_the_id(); ?>';
            // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };						    
        (function() {  // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');						        
            s.src = '//<?php echo $disqus_shortname ?>.disqus.com/embed.js';						        
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Ative o javascript para visualizar os comentários </noscript>

<?php endif; // if $disqus_shortname ?>