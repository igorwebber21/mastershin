<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список статей
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список статей</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-centered" id="services-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ключ</th>
                                <th>Русский</th>
                                <th>Украинский</th>
                                <th>Английский</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=count($dictionary); foreach($dictionary as $item):?>
                                <tr>
                                    <td><?=$i--;?></td>
                                    <td><a href="<?=ADMIN;?>/dictionary/edit?id=<?=$item['id'];?>"><?=$item['keyword'];?></a></td>
                                    <td><?=$item['ru'];?></td>
                                    <td><?=$item['ua'];?></td>
                                    <td><?=$item['en'];?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/blog/edit?id=<?=$item['id'];?>">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        <a class="delete" href="<?=ADMIN;?>/blog/delete?id=<?=$item['id'];?>">
                                            <i class="fa fa-fw fa-close text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($dictionary);?> слов из <?=$count;?>)</p>
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