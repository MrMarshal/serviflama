<?php
$consumptions = $data['consumptions'];
?>

<section class="container" style="padding-top: 50px;">
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <a href="clients.php" class="btn btn-success btn-icon-anim btn-circle" style="padding-top: 11px;font-weight: bold;"><i class="icon-arrow-left"></i></a>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a class="text-white" href="index.php">Menú</a></li>
                <li>></li>
                <li><a href="clients.php"><span class="text-white">clientes</span></a></li>
                <li>></li>
                <li><a href="#"><span class="text-white">ver</span></a></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default border-panel card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <?php //foreach ($consumptions as $con) { var_dump($con); echo "<br><br>"; } 
                        ?>
                        <div class="invoice-bill-table">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Consumo</th>
                                            <th>Total de consumo</th>
                                            <th>Total con adeudo</th>
                                            <th>Pago</th>
                                            <th>Saldo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $final = 0;
                                        foreach ($consumptions as $con) {
                                            $total = round((float)$con['liters'] * $con['price'], 0, PHP_ROUND_HALF_UP) + $con['admin'];
                                            $pay = isset($con['payment']['amount']) ? $con['payment']['amount'] : 0;
                                            $balance = isset($con['payment']['balance']) ? $con['payment']['balance'] : 0;
                                            if ($con['payment'] == null) {
                                                $final += $total + $con['balance'];
                                            }
                                        ?>
                                            <tr>
                                                <th><?php echo explode(" ", $con['date'])[0]; ?></th>
                                                <th><?php echo round((float)$con['liters'], 2, PHP_ROUND_HALF_UP); ?>lts</th>
                                                <th>$<?php echo $total; ?></th>
                                                <th>$<?php echo $total + $con['balance']; ?></th>
                                                <th><?php echo ($con['payment'] != null ? ("$" . $pay) : "Pendiente"); ?></th>
                                                <th><?php echo ($con['payment'] != null ? ("$" . $balance) : "-"); ?></th>
                                                <th>
                                                    <?php if (empty($con['payment'])) { ?>
                                                        No disponible
                                                        <!-- <a href="" onclick="registerPayment(<?php echo $con['id']; ?>);return false;">
															Registrar pago
														</a> -->
                                                    <?php } else { ?>
                                                        <a href="" onclick="viewDetails(<?php echo $con['id']; ?>);return false;">
                                                            Ver detalles o algo
                                                        </a>
                                                    <?php } ?>
                                                </th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="button-list pull-right">
                                <button type="button" class="btn btn-default btn-outline btn-icon left-icon" onclick="javascript:window.print();">
                                    <i class="fa fa-print"></i><span> Imprimir</span>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</section>


<script type="text/javascript">
    function viewDetails(id) {
        show_payment_detail_modal(id);
    }
</script>

<script type="text/javascript">
    function registerPayment(id) {
        add_payment_modal(id, function(res) {
            location.reload();
        })
        return false;
    }

    $("#total_balance").html("<?php echo $final; ?>");
</script>