<div class="row">
    <div class="col-md-12">
        <div class="panel panel-og">
            <div class="panel-heading">
                <h4 class="panel-title pull-left"><?= lang('reg.48'); ?></h4>
                <div class="clearfix"></div>
            </div>

            <div class="panel panel-body" id="add_player_panel_body">

                <ol class="breadcrumb">
                    <li class="active"><?= lang('reg.49'); ?></li>
                    <li class="active"><b><?= lang('reg.50'); ?></b></li>
                    <li class="active"><?= lang('reg.51'); ?></li>
                </ol>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <center> <?= lang('reg.52'); ?> </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="<?= BASEURL . 'online/casino'?>" class="btn btn-hotel btn-xs pull-right"> <?= lang('reg.53'); ?>></a>
                                <h2><b><?= lang('reg.54'); ?>, <?= $player['username'] ?></b></h2>

                                <blockquote>
                                    <?= lang('reg.55'); ?>
                                </blockquote>

                                <blockquote>
                                    <?= lang('reg.56'); ?>
                                </blockquote>

                                <center> <a href="<?= BASEURL . 'smartcashier/makeDeposit/1'?>" class="btn btn-hotel btn-md"><?= lang('reg.57'); ?></a> </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>