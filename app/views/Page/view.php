

        <div id="pageTitle">
            <div class="container">
                <h1><?=$currPage['title_ua']?></h1>
            </div>
        </div>
        <div id="pageContent">


          <?php $class = ($currPage['alias'] == 'kontakty') ? ' section-bg01': '';?>
            <div class="block<?=$class?>">
                <div class="container">

                  <?=$currPage['text_ua']?>
                </div>
            </div>
        </div>
