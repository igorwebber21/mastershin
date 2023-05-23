<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Добавить слово или фразу
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="<?=ADMIN;?>/dictionary">Словарь</a></li>
    <li class="active">Новое слово</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form class="articleForm" action="<?=ADMIN;?>/dictionary/add" method="post" data-toggle="validator">
          <div class="box-body">

            <div class="form-group has-feedback">
              <label for="title">Ключ (содержит только английские символы. Пример: "ShinoMontazh")</label>
              <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Key" pattern = "[a-zA-Z]+" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

              <div class="form-group has-feedback">
                  <label for="title">Слово (фраза) на русском</label>
                  <input type="text" name="ru" class="form-control" id="ru" placeholder="RU" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              </div>

              <div class="form-group has-feedback">
                  <label for="title">Слово (фраза) на украинском</label>
                  <input type="text" name="ua" class="form-control" id="ua" placeholder="UA" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              </div>

              <div class="form-group has-feedback">
                  <label for="title">Слово (фраза) на английском</label>
                  <input type="text" name="en" class="form-control" id="en" placeholder="EN" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
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
