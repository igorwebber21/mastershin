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
                                <th>Название</th>
                                <th>Алиас (Ссылка)</th>
                                <th>Категория</th>
                                <th>Статус</th>
                                <th>Добавлена</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=count($articles); foreach($articles as $article):?>
                                <tr <?php if($article['status'] == 'hidden') echo 'class="product-hidden"';?> attr-id="<?=$article['id'];?>">
                                    <td><?=$i--;?></td>
                                    <td><a href="<?=ADMIN;?>/blog/edit?id=<?=$article['id'];?>"><?=$article['name'];?></a></td>
                                    <td><?=$article['alias'];?></td>
                                    <td><?=($article['category'] == 'tires') ? 'Шины': 'Диски';?></td>
                                    <td><?=$article['status'] == 'visible' ? 'Активный' : 'Скрытый';?></td>
                                    <td><?=date_point_format($article['date_add']);?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/blog/edit?id=<?=$article['id'];?>">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        <a class="delete" href="<?=ADMIN;?>/blog/delete?id=<?=$article['id'];?>">
                                            <i class="fa fa-fw fa-close text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($articles);?> товаров из <?=$count;?>)</p>
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