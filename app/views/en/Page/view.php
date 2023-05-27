

        <div id="pageTitle">
            <div class="container">
                <h1><?=$currPage['title']?></h1>
            </div>
        </div>
        <div id="pageContent">


          <?php $class = ($currPage['alias'] == 'kontakty') ? ' section-bg01': '';?>
            <div class="block<?=$class?>">
                <div class="container">

                  <?=$currPage['text']?>
                </div>
            </div>
        </div>
