<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   Записи на приём
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li class="active">Записи на приём </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-centered">
              <thead>
              <tr>
                <th>ID</th>
                <th style="min-width: 200px;">Заказчик</th>
                <th>Услуга</th>
                <th>Дата</th>
                <th>Авто</th>
                <th>Сообщение</th>
                <th>SMS</th>
                <th>Одобрить</th>
                <th>Удалить</th>
              </tr>
              </thead>
              <tbody>
              <?php   foreach($claims as $claim): ?>
                <tr>
                  <td><?=$claim['id'];?></td>
                  <td>
                      <?=$claim['name']; ?><br/>
                      <?=$claim['phone']; ?>
                  </td>
                  <td><?=$claim['service_name'];?></td>
                  <td><?=str_replace('/', '.', $claim['service_date']);?> <?=$claim['service_time'];?></td>

                  <td><?=$claim['car_model']; ?> <br/>
                    <?=$claim['car_number']; ?>
                  </td>
                  <td><?=$claim['message']; ?></td>

                  <td>
                    <?php if($claim['send_notify'] != 'no'): ?>
                       Отправлено <i class="fa fa-fw fa-check-square-o"></i>
                    <?php else: ?>
                       Не отправлено
                    <?php endif; ?>
                  </td>

                  <td>
                    <?php if($claim['confirm'] == 'no'): ?>
                        <a href="<?=ADMIN;?>/mail/change?id=<?=$claim['id'];?>&status=1" class="btn order-action-btn btn-success btn-xs">Одобрить</a>
                    <?php else: ?>
                        Одобрено
                        <a href="<?=ADMIN;?>/mail/change?id=<?=$claim['id'];?>&status=0" title="Вернуть">
                            <i class="fa fa-fw  fa-undo"></i>
                        </a>
                    <?php endif; ?>
                  </td>
                <!--  <td><?/*=date_point_format($claim['date']);*/?></td>-->
                  <td>
                    <!--<a href="<?/*=ADMIN;*/?>/mail/confirm?id=<?/*=$claim['id'];*/?>">
                      <i class="fa fa-fw  fa-check-square-o"></i>
                    </a>-->
                    <a class="delete" href="<?=ADMIN;?>/mail/delete?id=<?=$claim['id'];?>">
                      <i class="fa fa-fw fa-close text-danger"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
            <div class="text-center">
                <p>(<?=count($claims);?> заявок из <?=$count;?>)</p>
              <?php if($pagination->countPages > 1): ?>
                <?=$pagination;?>
              <?php endif; ?>
            </div>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->