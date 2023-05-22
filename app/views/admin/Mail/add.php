<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Отправить mail
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="<?=ADMIN;?>/mail">Список отправок</a></li>
    <li class="active">Отправить mail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form class="articleForm" action="<?=ADMIN;?>/mail/add" method="post" data-toggle="validator">
          <div class="box-body">
            <div class="form-group has-feedback">
              <label for="title">Получатель</label>
              <input type="email" name="name" class="form-control" id="name" placeholder="Получатель" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
              <label for="keywords">Тема письма</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Тема письма" value="<?=$mail_template['subject']?>">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
              <label for="content">Текст письма</label>
              <textarea id="text" name="text" cols="80" rows="100" style="height: 600px;"><?=$mail_template['message']?></textarea>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Отправить</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->


<style>
    .cke_contents{
        height: 500px!important;
    }
</style>