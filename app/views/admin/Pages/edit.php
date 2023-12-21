<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Изменить страницу
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="<?=ADMIN;?>/pages">Список страниц</a></li>
    <li class="active">Изменить страницу</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form class="articleForm" action="<?=ADMIN;?>/pages/edit" method="post" data-toggle="validator">
          <div class="box-body">
            <div class="form-group has-feedback">
              <label for="title">Наименование страницы (RU)</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Наименование категории" value="<?=$page['title']?>" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
              <label for="title">Назва сторінки (UA)</label>
              <input type="text" name="title_ua" class="form-control" id="title_ua" placeholder="Назва сторінки" value="<?=$page['title_ua']?>" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
              <label for="title">Page name (EN)</label>
              <input type="text" name="title_en" class="form-control" id="title_en" placeholder="Page name" value="<?=$page['title_en']?>" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
              <label for="content">Текст страницы (RU)</label>
              <textarea style="resize: none;" class="text" id="text" name="text" cols="80" rows="10"><?=$page['text']?></textarea>
            </div>

            <div class="form-group has-feedback">
              <label for="content">Текст сторінки (UA)</label>
              <textarea style="resize: none;" class="text" id="text_ua" name="text_ua" cols="80" rows="10"><?=$page['text_ua']?></textarea>
            </div>

            <div class="form-group has-feedback">
              <label for="content">Page content (EN)</label>
              <textarea style="resize: none; " class="text" id="text_en" name="text_en" cols="80" rows="10"><?=$page['text_en']?></textarea>
            </div>

            <div class="form-group form-section-checkboxes form-section-bmt">

              <label class="section-checkbox">
                  <label class="switch">
                      <input type="checkbox" id="status" name="status" <?=$page['status'] == 'visible' ? 'checked' : null;?>>
                      <span class="slider round"></span>
                  </label>
                  <span class="checkbox-text">Показывать</span>
              </label>

            </div>

          </div>
          <div class="box-footer">
            <input type="hidden" name="id" value="<?=$page['id'];?>">
            <button type="submit" class="btn btn-success">Сохранить</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
