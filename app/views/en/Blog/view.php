<div id="pageTitle">
    <div class="container">
        <h1><?php echo ($article['category'] == 'tires') ? $dictionary['Tires'][$lang] :  $dictionary['Disks'][$lang];?></h1>
    </div>
</div>
<div id="pageContent">
    <div class="block">
        <div class="container">
            <div class="row service-single">


                <div class="col-12 col-sm-5 col-md-4 service-leftbar">
                    <div class="block-aside-wrapper">

                      <?php if($article['video_url']): ?>
                          <div class="block-aside__wrapper widget block-aside" id="video-block">
                              <h4 class="block-aside__title">Video review</h4>
                              <div class="video-item">
                                  <video width="320" height="240" controls="controls" autoplay="autoplay" loop playsinline muted>
                                      <source src="<?=PATH?>/video/<?=$article['video_url']?>" type="video/mp4">
                                      Your browser does not support the video tag.
                                  </video>
                              </div>
                          </div>
                      <?php endif; ?>

                        <div class="block-aside__wrapper widget block-aside" id="service_menu-3">
                            <h4 class="block-aside__title"><?php echo ($article['category'] == 'tires') ? $dictionary['Tires'][$lang] :  $dictionary['Disks'][$lang];?></h4>
                            <div class="block-aside__content no-indent">
                                <nav class="nav-aside">
                                    <ul>
                                        <?php foreach($services as $service): ?>
                                        <li>
                                            <a href="/en/service/<?=$service['alias']?>" title="<?=$service['name_en']?>">
                                                <!-- <span class="nav-aside__icon icon-car-wheel"></span> -->
                                                <span class="nav-aside_text"><?=$service['name_en']?></span>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="divider-lg hidden-lg hidden-md hidden-sm"></div>
                <div class="col-12 col-sm-7 col-md-8 service-content">

                    <h1><?=$article['name_en']?></h1>
                    <?=$article['text_en']?>

                    <div class="text-center"><a class="btn btn-border btn-invert otzivi-btn" href="/en/prays-list"><span><?=$dictionary['SeeFullPrice'][$lang]?></span> </a></div>

                </div>
            </div>
        </div>
    </div>
</div>


<script>



</script>

