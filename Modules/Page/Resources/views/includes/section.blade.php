<section id="todo">
    <div class="container">
        <h2 class="section_title text-center">
            <?php print $post->title;?>
           
            <?php 
            if(isset($post->metadata["sub-headline"])):
                print  "<span>".$post->metadata["sub-headline"]->value."</span>";
            
            endif;?>
        </h2>
        <div class="row text-center">
            <div class="service col-sm-12 col-md-12 wow fadeInUp" data-wow-offset="100" style="visibility: hidden; animation-name: none;">
            <?php print $post->description;?>
            </div>
        </div>
    </div>
</section>