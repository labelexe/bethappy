<style>
    .th-left{
        border-right: none!important;
        vertical-align: middle;
    }
    .th-right{
        border-left: none!important;
        text-align: right!important;
    }
    
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12"><?= $this->element('breadcrumbs', array('data' => $this->Breadcrumb->buildFromURI(array(0 => '', 1 => __('Create %s', __($singularName)))))); ?></div>
    </div>
    <div id="page" class="dashboard">
        <?= $this->element('flash_message'); ?>
        <div class="row-fluid ">
            <div class="span12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="table table-custom">
                                    <?= $this->element('tabs'); ?>
                                    <div class="tab-content">
                                        <?= $this->element('slots_form', array('model' => 'Report')); ?>
                                        <?= __('Report will show total GGR for all players. Please set your own date filters.'); ?><br><br>
                                        <?= $datefrom; ?> - <?= $dateto; ?>
                                        <?php if (!empty($data)):  ?>
                                            <?php foreach ($data as $currency => $users) :?>
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th colspan="8" class="th-left"><?= $currency; ?></th>
                                                        <th colspan="4" class="th-right"><button type="button" class="btncol btn btn-info" data-toggle="collapse" data-target=".collapseme<?= $currency; ?>"><?= __('Show/Hide'); ?></button></th>
                                                    </tr>
                                                    <tr>
                                                        <th><?= __('User ID'); ?></th>
                                                        <th><?= __('User name'); ?></th>
                                                        <th><?= __('Balance'); ?></th>
                                                        <th><?= __('Bets'); ?></th>
                                                        <th><?= __('Wins'); ?></th>
                                                        <th><?= __('Refunds'); ?></th>
                                                        <th><?= __('GGR'); ?></th>
                                                        <th><?= __('Bonus'); ?> <?= __('Bets'); ?></th>
                                                        <th><?= __('Bonus'); ?> <?= __('Wins'); ?></th>
                                                        <th><?= __('Bonus'); ?> <?= __('Refunds'); ?></th>
                                                        <th><?= __('Bonus'); ?> <?= __('GGR'); ?></th>
                                                        <th><?= __('Player'); ?> <?= __('GGR'); ?></th>
                                                    </tr>
                                                    <?php
                                                    foreach ($users as $user) :
                                                        if ($user['RealTransactions']['Bets'] || $user['BonusTransactions']['Bets']) :

                                                        $totalbet += $user['RealTransactions']['Bets'];
                                                        $totalwin += $user['RealTransactions']['Wins'];
                                                        $totalrefund += $user['RealTransactions']['Refund'];
                                                        $totalbonusbet += $user['BonusTransactions']['Bets'];
                                                        $totalbonuswin += $user['BonusTransactions']['Wins'];
                                                        $totalbonusrefund += $user['BonusTransactions']['Refund'];
                                                        $totalPLAYERGGR += round(($user['RealTransactions']['Bets']) - $user['RealTransactions']['Wins'] + ($user['BonusTransactions']['Bets']) - $user['BonusTransactions']['Wins'], 2);
                                                        ?>
                                                         <tr class="collapseme<?= $currency; ?>">
                                                                <td><?= $user['id']; ?></td>
                                                                <td><?= $user['username']; ?></td>
                                                                <td><?= number_format($user['balance'], 2, '.', ','); ?></td>
                                                                <td><?= number_format($user['RealTransactions']['Bets'], 2, '.', ','); ?></td>
                                                                <td><?= number_format($user['RealTransactions']['Wins'], 2, '.', ',');?></td> 
                                                                <td><?= number_format($user['RealTransactions']['Refund'], 2, '.', ','); ?></td> 
                                                                <td><?= number_format($user['RealTransactions']['Bets'] - $user['RealTransactions']['Wins'], 2, '.', ','); ?></td> 
                                                                <td><?= number_format($user['BonusTransactions']['Bets'], 2, '.', ','); ?></td> 
                                                                <td><?= number_format($user['BonusTransactions']['Wins'], 2, '.', ','); ?></td> 
                                                                <td><?= number_format($user['BonusTransactions']['Refund'], 2, '.', ','); ?></td> 
                                                                <td><?= number_format($user['BonusTransactions']['Bets'], 2, '.', ',') - number_format($user['BonusTransactions']['Wins'], 2, '.', ','); ?></td> 
                                                                <td><?= number_format($user['RealTransactions']['Bets'] - $user['RealTransactions']['Wins'] + $user['BonusTransactions']['Bets'] - $user['BonusTransactions']['Wins'], 2, '.', ','); ?></td> 
                                                            </tr>
                                                        <?php
                                                        endif;
                                                    endforeach;
                                                    ?>

                                                   <tr>
                                                        <td colspan="3"><b><i><?= __('Totals'); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalbet, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalwin, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalrefund, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalbet - $totalwin, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalbonusbet, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalbonuswin, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalbonusrefund, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= number_format($totalbonusbet - $totalbonuswin, 2, '.', ','); ?></i></b></td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8"><b><i><?= __('Grand'); ?> <?= __('Totals'); ?></i></b></td>
                                                        <td><b><i><?= __('Bets'); ?>: <?= number_format($totalbet + $totalbonusbet, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= __('Wins'); ?>: <?= number_format($totalwin + $totalbonuswin, 2, '.', ','); ?></i></b></td>
                                                        <td><b><i><?= $currency; ?>: <?= number_format(($totalbet - $totalwin) + ($totalbonusbet - $totalbonuswin), 2, '.', ','); ?></i></b></td>
                                                        <td><?= $totalPLAYERGGR; ?></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                $totalPLAYERGGR = $totalrefund = $totalbonusrefund = $totalbet = $totalwin = $totalbonusbet = $totalbonuswin = 0;
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".btncol").click(function () {
        $($(this).data("target")).toggle();
    })
</script>