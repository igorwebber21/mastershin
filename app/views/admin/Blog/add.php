<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Добавить услугу
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="<?=ADMIN;?>/category">Список услуг</a></li>
    <li class="active">Новая услуга</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form class="articleForm" action="<?=ADMIN;?>/blog/add" method="post" data-toggle="validator">
          <div class="box-body">

            <div class="form-group has-feedback">
              <label for="title">Название услуги (RU)</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Наименование категории" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
              <label for="title">Назва послуги (UA)</label>
              <input type="text" name="name_ua" class="form-control" id="name_ua" placeholder="Назва послуги" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

              <div class="form-group has-feedback">
                  <label for="title">Service name (EN)</label>
                  <input type="text" name="name_en" class="form-control" id="name_en" placeholder="Service name" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              </div>

            <div class="form-group">
              <label>Категория</label>
              <select name="category" id="category" class="form-control">
                  <option value="tires">Шины</option>
                  <option value="disks">Диски</option>
              </select>
            </div>


            <div class="form-group has-feedback">
              <label for="content">Описание услуги (RU)</label>
              <textarea class="text"  id="text" name="text" cols="80" rows="10"></textarea>
            </div>

            <div class="form-group has-feedback">
              <label for="content">Опис послуги (UA)</label>
              <textarea class="text" id="text_ua" name="text_ua" cols="80" rows="10"></textarea>
            </div>

            <div class="form-group has-feedback">
              <label for="content">Service description (EN)</label>
              <textarea class="text" id="text_en" name="text_en" cols="80" rows="10"></textarea>
            </div>


              <div class="form-group form-section-checkboxes form-section-bmt">

                  <label class="section-checkbox">
                      <label class="switch">
                          <input type="checkbox" id="status" name="status">
                          <span class="slider round"></span>
                      </label>
                      <span class="checkbox-text">Показывать</span>
                  </label>

              </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Добавить</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
